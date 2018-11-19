<?php

namespace App\Admin\Controllers;

use App\SaleProduct;
use App\Product;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;


class SaleProductController extends Controller
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

            $content->header('Order Line');
            $content->description('List');

            
            $content->body($this->grid());
            $content->body(view('SaleProductReport'));

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

            $content->header('Order Line');
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

            $content->header('Order Line');
            $content->description('Create New Orfer Line');
            if (Admin::user()->isRole('Administrator')){
                $content->body($this->form());
            }else{
                $content->body("No Permission");
            }
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(SaleProduct::class, function (Grid $grid) {

            $grid->disableCreation();
            $grid->disableActions();
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            
            $grid->paginate(20);
                

            $grid->filter(function($filter){

                // Remove the default id filter
                $filter->disableIdFilter();
                $products = Product::getSelectOption();

                $filter->equal('saleid', 'SaleID');

                $filter->between('created_at','Sale Period')->datetime();

                $filter->between('subtotal','SubtotalRange');
                

                $filter->where(function ($query) {

                        $query->whereRaw("`unitquantity` = {$this->input} OR `packquantity` = {$this->input} OR `boxquantity` = {$this->input} ");

                    }, 'Quantity');

                $filter->equal('pid')->select($products);


                

            });



            $grid->model()->with('product');
            $grid->model()->orderby('created_at','desc');


            $grid->saleid('SALEID');
            
            $grid->pid('PID');
            $grid->product()->name('Product');

            $grid->unitquantity('UQ');
            $grid->packquantity('PQ');
            $grid->boxquantity('BQ');

            $grid->salepriceunit('UP');
            $grid->salepricepack('PP');
            $grid->salepricebox('BP');

            $grid->stock('StockUPB');

            $grid->subtotal('Subtotal');

            $grid->created_at();
            $grid->updated_at();


             $script = <<<SCRIPT
$("[name='pid']").select2();
var ths = document.getElementsByTagName("th");
ths[3].style.backgroundColor = "#f4f442";
ths[4].style.backgroundColor = "#f4f442";
ths[5].style.backgroundColor = "#f4f442";
ths[6].style.backgroundColor = "#b8f441";
ths[7].style.backgroundColor = "#b8f441";
ths[8].style.backgroundColor = "#b8f441";
ths[10].style.backgroundColor = "#41f4f1";

$('.table-hover td:nth-child(4)').css("background-color", "#f4f442");
$('.table-hover td:nth-child(5)').css("background-color", "#f4f442");
$('.table-hover td:nth-child(6)').css("background-color", "#f4f442");
$('.table-hover td:nth-child(7)').css("background-color", "#b8f441");
$('.table-hover td:nth-child(8)').css("background-color", "#b8f441");
$('.table-hover td:nth-child(9)').css("background-color", "#b8f441");
$('.table-hover td:nth-child(11)').css("background-color", "#41f4f1");



SCRIPT;
            Admin::script($script);

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('catid', 'ID');
            $form->text('name','Category Name')->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

/*forreport*/


    public function searchsaleproduct(Request $request){

        $searchKey = $request->all();


        return SaleProduct::searchsaleproduct($searchKey);
    }

}
