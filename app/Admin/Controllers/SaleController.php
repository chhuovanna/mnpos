<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Category;
use App\Manufacturer;
use App\Exchangerate;
use App\Customer;
use App\Sale;
use App\SaleProduct;
use App\Inventory;

use Encore\Admin\Form;

use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()    
    {
       return Admin::content(function (Content $content) {

            $content->header('Sale');
            $content->description('List Sale');
            $content->body(view('saleReport'));
            $content->body($this->grid());
            

            //$res = $this->getReport( $grid->model()->eloquent()->get() );

            //$content->body(view('saleReport' ,  [ 'rows' => $res ]));

        });
    }


    public function addSale(Request $request){
        return Admin::content(function (Content $content) use ($request) {

            $content->header('Sale');
            $content->description('Order');
            $content->body($this->formAddSale());


            if ($request){
                $input = $request->all();
                
                
                if (array_key_exists('checkoutstate', $input) && $input['checkoutstate'] === 'success'){
                $script = <<<SCRIPT
$(document).ready(function(){
    toastr.success('Checkout Success');
});
SCRIPT;
                    Admin::script($script);
                }
                
            }

        
        });
    }
    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Sale');
            $content->description('Edit');
            if (Admin::user()->isRole('Administrator')){
                $content->body($this->form()->edit($id));
            }else{
                $content->body("No Permission");
            }
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Sale');
            $content->description('Create New Sale');
            if (Admin::user()->isRole('Administrator')){
                $content->body($this->form());
            }else{
                $content->body("No Permission");
            }
        });
    }

  

    protected function grid()
    {
        return Admin::grid(Sale::class, function (Grid $grid) {




            $grid->disableBatchDeletion();
            $grid->disableRowSelector();

            $grid->disableCreation();
            //$grid->paginate(500);


            $grid->model()->with('customer'); 
            $grid->model()->orderby('saledate','desc');




            $grid->filter(function ($filter) {

                $customers = Customer::getSelectOption();

                $filter->between('saledate','Sale Period')->datetime();
                
                $filter->between('discount', 'Discount%');

                $filter->where(function ($query) {

                        $query->whereRaw("`total` between {$this->input} OR `ftotal` between {$this->input}");

                    }, 'Total or GTD(ex: 1 and 100)');

                $filter->equal('cusid')->select($customers);



            });


            $grid->actions(function ($actions) {


                if (!Admin::user()->isRole('Administrator')){

                    $actions->disableEdit();
                    $actions->disableDelete();
                }

                // append an action.
                $actions->append('<a title="View Orderline" href="' .url('/admin/orderline?&saleid=').$actions->getKey(). '"><i class="fa fa-search"></i></a>');

            });



            $grid->saleid('ID');
            $grid->saledate('Date');
            $grid->customer()->cusid('CID');
            $grid->customer()->name('Customer');           
            $grid->total('Total');            
            $grid->discount('Dis%');
            $grid->ftotal('GTD');
            $grid->exchangerate('ExRate');
            $grid->recievedd('RecUSD');
            $grid->recievedr('RecRiel');


            $script = <<<SCRIPT
$("[name='cusid']").select2();
$("[placeholder='Total or GTD(ex: 1 and 100)']").attr('pattern','([-]?[0-9]+ and [-]?[0-9]+)?');


var ths = document.getElementsByTagName("th");
ths[7].style.backgroundColor = "#f4f442";
ths[9].style.backgroundColor = "#b8f441";

$('.table-hover td:nth-child(5)').css("background-color", "#f4f442");
$('.table-hover td:nth-child(7)').css("background-color", "#b8f441");

SCRIPT;
            Admin::script($script);



            
        });
    }







    public function listSale(){

        return Admin::content(function (Content $content) {

            $content->header('Sale');
            $content->description('List Sale');

            $content->body($this->grid());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Sale::class, function (Form $form) {

            $form->display('saleid', 'Sale ID');
            $form->display('saledate','Date Time');
            
            $customers = Customer::pluck('name','cusid');      
            $form->select('cusid','Customer')->options($customers);


            $form->currency('total', 'Total');
            $form->number('discount','Discount');
            $form->currency('ftotal','Grand Total in USD');
            $form->currency('exchangerate','Exchange Rate');
            $form->currency('recievedd','Recieved in USD');
            $form->currency('recievedr','Recieved in Riel');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
    protected function formAddSale()
    {
        $exchangerate = Exchangerate::where('currentrate',1)->first();
        $products = Product::listWithCatMan();
        $customers = Customer::all();

        return view('productSaleListSearch',[
            'exchangerate' => $exchangerate->amount,
            'products'     => $products,
            'customers'    => $customers
        ] );
        /*$productOption = Product::getSelectOption();
        return view('productSale',[
            'exchangerate' => $exchangerate->amount,
            'products'     => $products,
            'productOption'=> $productOption,
        ] );*/
    }

    public function searchProduct(Request $request){

        $searchKey = $request->input('searchKey');

        if(isset($searchKey)){
            return Product::searchProduct($searchKey);
        }else{
            return null;
        }
    }

    public function searchProductBarcode(Request $request){

        $searchKey = $request->input('searchKey');

        if(isset($searchKey)){
            return Product::searchProductBarcode($searchKey);
        }else{
            return null;
        }
    }



    public function refreshSearchProduct(Request $request){
        return Product::listWithCatMan();
    }

    public function checkout(Request $request){
        

        DB::transaction(function () use ($request){

            $input = $request->all();
            $products = explode(',', $input['products']);
            $size = sizeof($products);
        
            print_r($input);


            $sale = new Sale;
            if ($input['customer'] != 0){
                $sale->cusid = $input['customer'];
            }
            $sale->total        = $input['totald'];
            $sale->discount     = $input['discount'];
            $sale->ftotal       = $input['ftotald'];
            $sale->recievedd    = $input['recievedd'];
            $sale->recievedr    = $input['recievedr'];
            $sale->exchangerate = $input['exchangerate'];
            $sale->save();

            
            
            for ($i = 1; $i < $size ; $i++ ){
                $saleproduct = new SaleProduct;
                $saleproduct->saleid        = $sale->saleid;
                $saleproduct->pid           = $products[$i];
                $saleproduct->unitquantity  = $input[ $products[$i]. "qu"   ];
                $saleproduct->packquantity  = $input[ $products[$i]. "qp"   ];
                $saleproduct->boxquantity   = $input[ $products[$i]. "qb"   ];
                $saleproduct->salepriceunit = $input[ $products[$i]. "up"   ];
                $saleproduct->salepricepack = $input[ $products[$i]. "pp"   ];
                $saleproduct->salepricebox  = $input[ $products[$i]. "bp"   ];
                $saleproduct->subtotal      = $input[ $products[$i]. "stt"  ];
                $saleproduct->stock         = $input[ $products[$i]."tstock"];
                $saleproduct->save();

                $temp  = explode( ',', $input[   $products[$i]. "tstock"  ] );
                $stock = array( 'unitinstock'   => $temp[0]
                                ,'packinstock'  => $temp[1]
                                ,'boxinstock'   => $temp[2] );

                Product::updateStock( $products[$i], $stock );
                Inventory::updateInventory( $products[$i], $stock );
            }
            

        });
        DB::commit();
        $url = strtok(url()->previous(), '?')."?checkoutstate=success";

        return redirect($url);        


    }




    public function addSaleBarcode(Request $request){
        return Admin::content(function (Content $content) use ($request) {

			

            $exchangerate = Exchangerate::where('currentrate',1)->first();
            $customers = Customer::all();

            $content->header('Add Sale');
            $content->description('By Barcode');
            $content->body( view('productSaleBarcode',[
            'exchangerate' => $exchangerate->amount,
            'customers'    => $customers
            
                ] ) 
            ) ;

			if ($request){
				$input = $request->all();
				
				
				if (array_key_exists('checkoutstate', $input) && $input['checkoutstate'] === 'success'){
				$script = <<<SCRIPT
$(document).ready(function(){
	 toastr.success('Checkout Success');
});
SCRIPT;
					Admin::script($script);
				}
				
			}

        });
    }


    public function addSaleBarcodeUnit(Request $request){
        return Admin::content(function (Content $content) use ($request) {

            

            $exchangerate = Exchangerate::where('currentrate',1)->first();
            $customers = Customer::all();

            $content->header('Add Sale');
            $content->description('By Barcode');
            $content->body( view('productSaleBarcodeUnit',[
            'exchangerate' => $exchangerate->amount,
            'customers'    => $customers
            
                ] ) 
            ) ;

            if ($request){
                $input = $request->all();
                
                
                if (array_key_exists('checkoutstate', $input) && $input['checkoutstate'] === 'success'){
                $script = <<<SCRIPT
$(document).ready(function(){
     toastr.success('Checkout Success');
});
SCRIPT;
                    Admin::script($script);
                }
                
            }

        });
    }


    public function getStock(Request $request){

        $products = $request->input('products');

        return Product::getStock($products);
    }



    public function searchsale(Request $request){
        
        $searchKey = $request->all();

        $res = Sale::searchsale($searchKey);

        $report = $this->getReport($res);    
        


        return $report;
    }


/*maynot use*/
    protected function getReport($res)
    {
        $used    = array( 'stotal' => 0, 'sftotal' => 0 );
        $gift    = array( 'stotal' => 0, 'sftotal' => 0 );
        $expired = array( 'stotal' => 0, 'sftotal' => 0 );
        $lost    = array( 'stotal' => 0, 'sftotal' => 0 );
        $return  = array( 'stotal' => 0, 'sftotal' => 0 );
        $ordinary  = array( 'stotal' => 0, 'sftotal' => 0 );
        $expense = 0;
        $profit  = 0;

        if ($res){
            foreach ($res['sales'] as $row) {
                if ( $row->cusid && $row->cusid < 0 ) {
                    switch ($row->cusid) {
                        case "-1":
                            $expired['stotal']  += $row->total;
                            $expired['sftotal'] += $row->ftotal;
                            break;
                        case "-2":
                            $lost['stotal']  += $row->total;
                            $lost['sftotal'] += $row->ftotal;
                            break;
                        case "-3":
                            $used['stotal']  += $row->total;
                            $used['sftotal'] += $row->ftotal;
                            break;
                        case "-4":
                            $gift['stotal']  += $row->total;
                            $gift['sftotal'] += $row->ftotal;
                            break;
                        case "-5":
                            $return['stotal']  += $row->total;
                            $return['sftotal'] += $row->ftotal;
                            break;
                    }
                }else{
                    $ordinary['stotal']  += $row->total;
                    $ordinary['sftotal'] += $row->ftotal;
                }

            }

            

            foreach ($res['saleproducts'] as $key => $value) {
                $expense += $value->sumunit*$res['productprices'][$key]->buypriceunit
                            + $value->sumpack*$res['productprices'][$key]->buypricepack
                            + $value->sumbox*$res['productprices'][$key]->buypricebox;
            }

            $profit = ( $ordinary['sftotal'] + $return['sftotal']) - $expense; 
        }

        return array( 'Ordinary' => $ordinary
                    , 'Expired'  => $expired
                    , 'Lost'     => $lost
                    , 'Used'     => $used
                    , 'Gift'     => $gift
                    , 'Return'   => $return
                    , 'Expense'  => $expense
                    , 'Profit'   => $profit);
    }
   


}
