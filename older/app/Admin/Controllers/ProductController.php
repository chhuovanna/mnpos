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

            $content->body($this->form()->edit($id));
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
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            
           
            $grid->pid('ID');
            $grid->barcode('Barcode');
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
$("[name='catid']").select2();
$("[name='mid']").select2();

$("[placeholder='Keyword(PID,barcode,name,shortcut,description)']").focus();


var ths = document.getElementsByTagName("th");
ths[5].style.backgroundColor = "#f4f442";
ths[6].style.backgroundColor = "#f4f442";
ths[7].style.backgroundColor = "#f4f442";
ths[8].style.backgroundColor = "#b8f441";
ths[9].style.backgroundColor = "#b8f441";
ths[10].style.backgroundColor = "#b8f441";
ths[11].style.backgroundColor = "#41f4f1";
ths[12].style.backgroundColor = "#41f4f1";

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
            $form->text('barcode','Barcode Number')->rules('required')->attribute('pattern','[0-9]+');
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
            $form->select('catid', 'Product Category')->options($categories);
            $manufacturers = Manufacturer::pluck('name','mid');
            $form->select('mid', 'Product Manufacturer')->options($manufacturers);
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



}
