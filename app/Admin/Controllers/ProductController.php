<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Category;
use App\Manufacturer;
use App\Exchangerate;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;


class ProductController extends Controller
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

            $content->header('Product');
            $content->description('List');
            $content->body($this->grid());
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

            $content->header('Product');
            $content->description('Edit');

            $content->body($this->formEdit()->edit($id));
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

            $content->header('Product');
            $content->description('Create New Product');

            $content->body($this->form());
        });
    }


    public function createwithimp()
    {
        return Admin::content(function (Content $content) {

            $content->header('Product');
            $content->description('Create New Product With Imported Price');

            $content->body($this->formwithimp());
        });
    }




    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Product::class, function (Grid $grid) {


            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                $filter->where(function ($query) {

                    $query->whereRaw("`pid` like '%{$this->input}%' OR `barcode` like '%{$this->input}%' OR `name` like '%{$this->input}%' OR `shortcut` like '%{$this->input}%' OR `description` like '%{$this->input}%'");

                    }, 'Keyword(PID,barcode,name,shortcut,description)');


                $categories = Category::getSelectOption();
                $filter->equal('catid')->select($categories);

                $manufacturers = Manufacturer::getSelectOption();
                $filter->equal('mid')->select($manufacturers);
            
            });   


            $grid->model()->with('category');
            $grid->model()->with('manufacturer');
            $grid->model()->orderBy('pid','DESC');
            //$grid->paginate(5);
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            
           
            $grid->pid('ID');
            $grid->barcode('Barcode')->sortable();
            $grid->name('Name')->sortable();           
            $grid->shortcut('Shortcut');
            
            $grid->description('Desc')->limit(20)->ucfirst();
            
            $grid->salepriceunit('UP')->sortable();
            $grid->salepricepack('PP')->sortable();
            $grid->salepricebox('BP')->sortable();
            //$grid->photopath('Photo');
            
            $grid->unitinstock('SU')->sortable();
            $grid->packinstock('SP')->sortable();
            $grid->boxinstock('SB')->sortable();
            $grid->unitperpack('UPP');
            $grid->unitperbox('UPB');
            
            $grid->isdrugs('Drug?')->display(function ($isdrugs) {
                return $isdrugs ? 'YES' : 'NO';
            });       
           
           

            $grid->category()->name('Category');
            $grid->manufacturer()->name('Manuf');

            $script = <<<SCRIPT
$(document).ready(function() {

    $("[name='catid']").select2();
    $("[name='mid']").select2();

    $("[placeholder='Keyword(PID,barcode,name,shortcut,description)']").focus();

    $('th:nth-child(6)').css("background-color", "#ffff99");
    $('th:nth-child(7)').css("background-color", "#ffff99");
    $('th:nth-child(8)').css("background-color", "#ffff99");
    $('th:nth-child(9)').css("background-color", "#ccffcc");
    $('th:nth-child(10)').css("background-color", "#ccffcc");
    $('th:nth-child(11)').css("background-color", "#ccffcc");
    $('th:nth-child(12)').css("background-color", "#66ffcc");
    $('th:nth-child(13)').css("background-color", "#66ffcc");

    $('td:nth-child(6)').css("background-color", "#ffff99");
    $('td:nth-child(7)').css("background-color", "#ffff99");
    $('td:nth-child(8)').css("background-color", "#ffff99");
    $('td:nth-child(9)').css("background-color", "#ccffcc");
    $('td:nth-child(10)').css("background-color", "#ccffcc");
    $('td:nth-child(11)').css("background-color", "#ccffcc");
    $('td:nth-child(12)').css("background-color", "#66ffcc");
    $('td:nth-child(13)').css("background-color", "#66ffcc");
});

SCRIPT;
            Admin::script($script);



            $grid->actions(function ($actions) {

                // append an action.
                $actions->append('<a title="Add Inventory" href="inventory/create/' .$actions->getKey(). '"><i class="fa fa-plus"></i></a>');

            });


        });
    }
   
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Product::class, function (Form $form) {

            $exchangerate = Exchangerate::where('currentrate',1)->first();

            $form->display('pid', 'Product ID');
            
            
            $form->text('barcode','Barcode Number')->rules('required|unique:products,barcode')->attribute('pattern','[0-9]+');
            //$form->text('barcode','Barcode Number')->rules('required|regex:[0-9]+|unique:products,barcode');
            
            $form->text('name','Product Name')->rules('required');
            $form->text('shortcut','Shortcut Name');
            $form->textarea('description', 'Description');

            $attribute = array('pattern'=>'[0-9]+', "autocomplete"=>"off", "style"=>"width: 200px");
            
            $form->text('exchangerate','Exchange Rate')->readOnly();
            $form->currency('salepriceunit','Sale Pice Per Unit')->rules('required');
            $form->text('spur','In Riel')->readOnly();
            $form->currency('salepricepack','Sale Pice Per Pack')->rules('required');
            $form->text('sppr','In Riel')->readOnly();
            $form->currency('salepricebox','Sale Pice Per Box')->rules('required');
            $form->text('spbr','In Riel')->readOnly();
            $form->text('unitperpack','Number of Units Per Pack')->rules('required')->attribute($attribute);
            $form->text('unitperbox','Number of Units Per Box')->rules('required')->attribute($attribute);
            
            $form->switch('isdrugs', 'Is Drug?');

            $categories = Category::pluck('name','catid');
            $form->select('catid', 'Product Category')->options($categories)->value(-1);
            $manufacturers = Manufacturer::pluck('name','mid');
            $form->select('mid', 'Product Manufacturer')->options($manufacturers)->value(-1);
            /*$form->select('mid', 'Product Manufacturer')->options(Product::getSelectOption());*/

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $script = <<<SCRIPT
$(document).off('keyup','#salepriceunit');
$(document).on('keyup','#salepriceunit',function(){
    var amount = new Decimal( $('#salepriceunit').val() );
    $('#spur').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricepack');
$(document).on('keyup','#salepricepack',function(){
    var amount = new Decimal( $('#salepricepack').val() );
    $('#sppr').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricebox');
$(document).on('keyup','#salepricebox',function(){
    var amount = new Decimal( $('#salepricebox').val() );
    $('#spbr').val(amount.mul( $('#exchangerate').val() ));
});
$('#exchangerate').val("{$exchangerate->amount}");
SCRIPT;
            Admin::script($script);







        });
    }



    protected function formwithimp()
    {
        return Admin::form(Product::class, function (Form $form) {

            $exchangerate = Exchangerate::where('currentrate',1)->first();

            $form->display('pid', 'Product ID');
            
            
            $form->text('barcode','Barcode Number')->rules('required|unique:products,barcode')->attribute('pattern','[0-9]+');
            //$form->text('barcode','Barcode Number')->rules('required|regex:[0-9]+|unique:products,barcode');
            
            $form->text('name','Product Name')->rules('required');
            $form->text('shortcut','Shortcut Name');
            $form->textarea('description', 'Description');

            $attribute = array('pattern'=>'[0-9]+', "autocomplete"=>"off", "style"=>"width: 200px");

            $style = ["style"=>"width:115px"];
            
            $form->text('exchangerate','Exchange Rate')->readOnly()->attribute($style);
            $form->currency('salepriceunit','Sale Pice Per Unit')->rules('required');
            $form->text('spur','In Riel')->readOnly()->attribute($style);
            $form->currency('salepricepack','Sale Pice Per Pack')->rules('required');
            $form->text('sppr','In Riel')->readOnly()->attribute($style);
            $form->currency('salepricebox','Sale Pice Per Box')->rules('required');
            $form->text('spbr','In Riel')->readOnly()->attribute($style);


            $form->currency('importpriceunit','Import Pice Per Unit')->rules('required');
            $form->text('ipur','In Riel')->readOnly()->attribute($style);
            $form->currency('importpricepack','Import Pice Per Pack')->rules('required');
            $form->text('ippr','In Riel')->readOnly()->attribute($style);
            $form->currency('importpricebox','Import Pice Per Box')->rules('required');
            $form->text('ipbr','In Riel')->readOnly()->attribute($style);



            $form->text('unitperpack','Number of Units Per Pack')->rules('required')->attribute($attribute);
            $form->text('unitperbox','Number of Units Per Box')->rules('required')->attribute($attribute);
            
            $form->switch('isdrugs', 'Is Drug?');

            $categories = Category::pluck('name','catid');
            $form->select('catid', 'Product Category')->options($categories)->value(-1);
            $manufacturers = Manufacturer::pluck('name','mid');
            $form->select('mid', 'Product Manufacturer')->options($manufacturers)->value(-1);
            /*$form->select('mid', 'Product Manufacturer')->options(Product::getSelectOption());*/

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->setAction('createwithimp/save');

            $script = <<<SCRIPT
$('#exchangerate').val("{$exchangerate->amount}");
$(document).off('keyup','#salepriceunit');
$(document).on('keyup','#salepriceunit',function(){
    var amount = new Decimal( $('#salepriceunit').val() );
    $('#spur').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricepack');
$(document).on('keyup','#salepricepack',function(){
    var amount = new Decimal( $('#salepricepack').val() );
    $('#sppr').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricebox');
$(document).on('keyup','#salepricebox',function(){
    var amount = new Decimal( $('#salepricebox').val() );
    $('#spbr').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#importpricebox');
$(document).on('keyup','#importpricebox',function(){
    var amount = new Decimal( $('#importpricebox').val() );
    $('#ipbr').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#importpriceunit');
$(document).on('keyup','#importpriceunit',function(){
    var amount = new Decimal( $('#importpriceunit').val() );
    $('#ipur').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#importpricepack');
$(document).on('keyup','#importpricepack',function(){
    var amount = new Decimal( $('#importpricepack').val() );
    $('#ippr').val(amount.mul( $('#exchangerate').val() ));
});

SCRIPT;
            Admin::script($script);







        });
    }


protected function saveformwithimp(Request $request){
    DB::transaction(function () use ($request){

            $input = $request->all();
            return $this->formwithimp()->save();
    });
}


protected function formEdit()
    {
        return Admin::form(Product::class, function (Form $form) {

            $exchangerate = Exchangerate::where('currentrate',1)->first();

            $form->display('pid', 'Product ID');
            
            
            $form->text('barcode','Barcode Number')->rules('required')->attribute('pattern','[0-9]+');
            //$form->text('barcode','Barcode Number')->rules('required|regex:[0-9]+|unique:products,barcode');
            
            $form->text('name','Product Name')->rules('required');
            $form->text('shortcut','Shortcut Name');
            $form->textarea('description', 'Description');

            $attribute = array('pattern'=>'[0-9]+', "autocomplete"=>"off", "style"=>"width: 200px");
            
            $form->text('exchangerate','Exchange Rate')->readOnly();
            $form->currency('salepriceunit','Sale Pice Per Unit')->rules('required');
            $form->text('spur','In Riel')->readOnly();
            $form->currency('salepricepack','Sale Pice Per Pack')->rules('required');
            $form->text('sppr','In Riel')->readOnly();
            $form->currency('salepricebox','Sale Pice Per Box')->rules('required');
            $form->text('spbr','In Riel')->readOnly();
            $form->text('unitperpack','Number of Units Per Pack')->rules('required')->attribute($attribute);
            $form->text('unitperbox','Number of Units Per Box')->rules('required')->attribute($attribute);
            
            $form->switch('isdrugs', 'Is Drug?');

            $categories = Category::pluck('name','catid');
            $form->select('catid', 'Product Category')->options($categories)->value(-1);
            $manufacturers = Manufacturer::pluck('name','mid');
            $form->select('mid', 'Product Manufacturer')->options($manufacturers)->value(-1);
            /*$form->select('mid', 'Product Manufacturer')->options(Product::getSelectOption());*/

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $script = <<<SCRIPT
$(document).off('keyup','#salepriceunit');
$(document).on('keyup','#salepriceunit',function(){
    var amount = new Decimal( $('#salepriceunit').val() );
    $('#spur').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricepack');
$(document).on('keyup','#salepricepack',function(){
    var amount = new Decimal( $('#salepricepack').val() );
    $('#sppr').val(amount.mul( $('#exchangerate').val() ));
});

$(document).off('keyup','#salepricebox');
$(document).on('keyup','#salepricebox',function(){
    var amount = new Decimal( $('#salepricebox').val() );
    $('#spbr').val(amount.mul( $('#exchangerate').val() ));
});
$('#exchangerate').val("{$exchangerate->amount}");
SCRIPT;
            Admin::script($script);







        });
    }



public function update($id)
    {
        return $this->formEdit()->update($id);
    }


}
