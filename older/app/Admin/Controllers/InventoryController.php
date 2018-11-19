<?php

namespace App\Admin\Controllers;

use App\Inventory;
use App\Product;
use App\Importer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;


class InventoryController extends Controller
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

            $content->header('Inventory');
            $content->description('List Inventory');

            $content->body($this->grid());

            $content->body(view('inventoryReport'));

            
            
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

            $content->header('Inventory');
            $content->description('Edit Inventory');
            if (Admin::user()->isRole('Administrator')){
                $content->body($this->formEdit()->edit($id));
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

            $content->header('Inventory');
            $content->description('Create New Inventory');

            $content->body($this->formCreate());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Inventory::class, function (Grid $grid) {


           
     

            if (!Admin::user()->isRole('Administrator')){
                $grid->disableActions();
            }

            $grid->disableBatchDeletion();
            $grid->disableRowSelector();

            

            $grid->filter(function ($filter) {

                $products = Product::getSelectOption();
                $importers = Importer::getSelectOption();

                $filter->equal('pid')->select($products);
                $filter->equal('impid')->select($importers);
                $filter->equal('finish')->select([ '1' => 'Finish' , '0' => 'Not finish']);
                $filter->between('importdate', 'Period')->datetime();

            });




            $grid->model()->with('product');
            $grid->model()->with('importer');
            $grid->model()->orderby('invid','desc');

            $grid->invid('Inv.ID');
            $grid->product()->pid('Prod.ID');
            $grid->product()->name('Prod.Name');
            //$grid->importer()->impid('Impo.ID');
            $grid->importer()->name('Impo.Name');
                        
            $grid->importunit('ImpU');
            $grid->importpack('ImpP');
            $grid->importbox('ImpB');
            $grid->buypriceunit('IUP');
            $grid->buypricepack('IPP');
            $grid->buypricebox('IBP');
            $grid->amount('Total Amount');  
            
            $grid->unitinstock('SU');
            $grid->packinstock('SP');
            $grid->boxinstock('SB');
            $grid->finish('Finish?')->display(function ($finish) {
                return $finish ? 'YES' : 'NO';
            }); 
            
            $grid->importdate('Impo.Date');
            $grid->mfg('MFG');
            $grid->exp('EXP');
            $grid->shelf('Shelf');
            
            $script = <<<SCRIPT
$("[name='pid']").select2();
$("[name='impid']").select2();

var ths = document.getElementsByTagName("th");
ths[4].style.backgroundColor = "#f4f442";
ths[5].style.backgroundColor = "#f4f442";
ths[6].style.backgroundColor = "#f4f442";
ths[7].style.backgroundColor = "#b8f441";
ths[8].style.backgroundColor = "#b8f441";
ths[9].style.backgroundColor = "#b8f441";
ths[10].style.backgroundColor = "#41f4f1";
ths[11].style.backgroundColor = "#f4f442";
ths[12].style.backgroundColor = "#f4f442";
ths[13].style.backgroundColor = "#f4f442";
SCRIPT;
            Admin::script($script);
            //$grid->created_at();
            //$grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function formCreate()
    {
        return Admin::form(Inventory::class, function (Form $form) {

            $form->display('invid', 'ID');

            $products = Product::getSelectOption();
            $form->select('pid', 'Product')->options($products)->rules('required');

            $importers = Importer::pluck('name','impid');
            $form->select('impid', 'Importer')->options($importers)->rules('required');


            $attribute = array("pattern"=>"^\d+$","style"=>"width: 100px; color: #0762f2", "autocomplete"=>"off");
            $form->text('importunit','Number of Imported Unit')->attribute($attribute)->value(0);
            $form->text('importpack','Number of Imported Pack')->attribute($attribute)->value(0);
            $form->text('importbox','Number of Imported Box')->attribute($attribute)->value(0);
            $form->currency('buypriceunit','Imported Unit Price')->rules('required');
            $form->currency('buypricepack','Imported Pack Price')->rules('required');
            $form->currency('buypricebox','Imported Box Price')->rules('required');
            $form->currency('amount', 'Total')->rules('required');

            $form->text('unitinstock','Number of Unit in Stock')->attribute($attribute)->value(0);
            $form->text('packinstock','Number of Pack in Stock')->attribute($attribute)->value(0);
            $form->text('boxinstock','Number of Box in Stock')->attribute($attribute)->value(0);
            $form->switch('finish', 'Finished?')->value(0);
            
            
            
            $form->date('importdate','Imported Date');
            $form->date('mfg','Manufactured Date');
            $form->date('exp','Expired Date');
            $form->text('shelf', 'Shelf');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $script = <<<SCRIPT

$(document).off('keyup','#importunit'   );
$(document).off('keyup','#importpack'   );
$(document).off('keyup','#importbox'    );
$(document).off('keyup','#buypriceunit' );
$(document).off('keyup','#buypricepack' );
$(document).off('keyup','#buypricebox'  );

$(document).on('keyup','#importunit'    ,getTotal);
$(document).on('keyup','#importpack'    ,getTotal);
$(document).on('keyup','#importbox'     ,getTotal);
$(document).on('keyup','#buypriceunit'  ,getTotal);
$(document).on('keyup','#buypricepack'  ,getTotal);
$(document).on('keyup','#buypricebox'   ,getTotal);


function getTotal(){
    var total   = new Decimal(0);
    var impup   ;
    var imppp   ;
    var impbp   ;
   
    if ($('#buypriceunit').val()){
        impup   = new Decimal($('#buypriceunit').val());
    }else{
        impup   = new Decimal(0);
    }

    if ($('#buypricepack').val()){
        imppp   = new Decimal($('#buypricepack').val());
    }else{
        imppp   = new Decimal(0);
    }

    if ($('#buypricebox').val()){
        impbp   = new Decimal($('#buypricebox').val());
    }else{
        impbp   = new Decimal(0);
    }

    total       = total.add(    impup.mul(  $('#importunit').val()  )   );
    total       = total.add(    imppp.mul(  $('#importpack').val()  )   );
    total       = total.add(    impbp.mul(  $('#importbox').val()  )   );
    $('#amount').val(total);
    $('#unitinstock').val(  $('#importunit').val()  );
    $('#packinstock').val(  $('#importpack').val()  );
    $('#boxinstock').val(   $('#importbox').val()   );
}

SCRIPT;
            Admin::script($script);


            $form->saved(function (Form $form) {
                Inventory::updatestock($form->model()->pid);
            });
        });
    }


    protected function formEdit()
    {

        
        return Admin::form(Inventory::class, function (Form $form) {

            $form->display('invid', 'ID');

            $products = Product::getSelectOption();
            $form->select('pid', 'Product')->options($products)->rules('required');

            $importers = Importer::pluck('name','impid');
            $form->select('impid', 'Importer')->options($importers)->rules('required');


            $attribute = array("pattern"=>"^\d+$","style"=>"width: 100px; color: #0762f2", "autocomplete"=>"off");
            $form->text('importunit','Number of Imported Unit')->attribute($attribute)->value(0);
            $form->text('importpack','Number of Imported Pack')->attribute($attribute)->value(0);
            $form->text('importbox','Number of Imported Box')->attribute($attribute)->value(0);
            $form->currency('buypriceunit','Imported Unit Price')->rules('required');
            $form->currency('buypricepack','Imported Pack Price')->rules('required');
            $form->currency('buypricebox','Imported Box Price')->rules('required');
            $form->currency('amount', 'Total')->rules('required')->value(0);

            $form->text('unitinstock','Number of Unit in Stock')->attribute($attribute)->value(0);
            $form->text('packinstock','Number of Pack in Stock')->attribute($attribute)->value(0);
            $form->text('boxinstock','Number of Box in Stock')->attribute($attribute)->value(0);
            $form->switch('finish', 'Finished?');
            
            
            
            $form->date('importdate','Imported Date');
            $form->date('mfg','Manufactured Date');
            $form->date('exp','Expired Date');
            $form->text('shelf', 'Shelf');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $script = <<<SCRIPT

$(document).off('keyup','#importunit'   );
$(document).off('keyup','#importpack'   );
$(document).off('keyup','#importbox'    );
$(document).off('keyup','#buypriceunit' );
$(document).off('keyup','#buypricepack' );
$(document).off('keyup','#buypricebox'  );


$(document).on('keyup','#importunit'    ,getTotal);
$(document).on('keyup','#importpack'    ,getTotal);
$(document).on('keyup','#importbox'     ,getTotal);
$(document).on('keyup','#buypriceunit'  ,getTotal);
$(document).on('keyup','#buypricepack'  ,getTotal);
$(document).on('keyup','#buypricebox'   ,getTotal);


function getTotal(){
    var total   = new Decimal(0);
    var impup   ;
    var imppp   ;
    var impbp   ;
   
    if ($('#buypriceunit').val()){
        impup   = new Decimal($('#buypriceunit').val());
    }else{
        impup   = new Decimal(0);
    }

    if ($('#buypricepack').val()){
        imppp   = new Decimal($('#buypricepack').val());
    }else{
        imppp   = new Decimal(0);
    }

    if ($('#buypricebox').val()){
        impbp   = new Decimal($('#buypricebox').val());
    }else{
        impbp   = new Decimal(0);
    }

    total       = total.add(    impup.mul(  $('#importunit').val()  )   );
    total       = total.add(    imppp.mul(  $('#importpack').val()  )   );
    total       = total.add(    impbp.mul(  $('#importbox').val()  )   );
    $('#amount').val(total);
}

SCRIPT;
            Admin::script($script);


            $form->saved(function (Form $form) {
                Inventory::updatestock($form->model()->pid);
            });
        });
        
    }

    protected function productInventoryForm($product)
    {
        return Admin::form(Inventory::class, function (Form $form) use ($product) {

            $form->display('invid', 'ID');


            $sp = Product::find($product);
            

            $form->select('pid', 'Product')->options([$sp->pid=>$sp->name])->value($product);

            $importers = Importer::pluck('name','impid');
            $form->select('impid', 'Importer')->options($importers)->rules('required');


            $attribute = array("pattern"=>"^\d+$","style"=>"width: 100px; color: #0762f2", "autocomplete"=>"off");
            $form->text('importunit','Number of Imported Unit')->attribute($attribute)->value(0);
            $form->text('importpack','Number of Imported Pack')->attribute($attribute)->value(0);
            $form->text('importbox','Number of Imported Box')->attribute($attribute)->value(0);
            

            $importedprices = Inventory::where('pid', '=' , $product)->orderBy('invid','desc')->first();
            if ($importedprices){
                $form->currency('buypriceunit','Imported Unit Price')->value($importedprices->buypriceunit)->rules('required');
                $form->currency('buypricepack','Imported Pack Price')->value($importedprices->buypricepack)->rules('required');
                $form->currency('buypricebox','Imported Box Price')->value($importedprices->buypricebox)->rules('required');
            }else{
                $form->currency('buypriceunit','Imported Unit Price')->rules('required');
                $form->currency('buypricepack','Imported Pack Price')->rules('required');
                $form->currency('buypricebox','Imported Box Price')->rules('required');
            }



            $form->currency('amount', 'Total')->rules('required')->value(0);

            $form->text('unitinstock','Number of Unit in Stock')->attribute($attribute)->value(0);
            $form->text('packinstock','Number of Pack in Stock')->attribute($attribute)->value(0);
            $form->text('boxinstock','Number of Box in Stock')->attribute($attribute)->value(0);
            $form->switch('finish', 'Finished?')->value(0);
            
            
            
            $form->date('importdate','Imported Date');
            $form->date('mfg','Manufactured Date');
            $form->date('exp','Expired Date');
            $form->text('shelf', 'Shelf');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $script = <<<SCRIPT

$(document).off('keyup','#importunit'   );
$(document).off('keyup','#importpack'   );
$(document).off('keyup','#importbox'    );
$(document).off('keyup','#buypriceunit' );
$(document).off('keyup','#buypricepack' );
$(document).off('keyup','#buypricebox'  );


$(document).on('keyup','#importunit'    ,getTotal);
$(document).on('keyup','#importpack'    ,getTotal);
$(document).on('keyup','#importbox'     ,getTotal);
$(document).on('keyup','#buypriceunit'  ,getTotal);
$(document).on('keyup','#buypricepack'  ,getTotal);
$(document).on('keyup','#buypricebox'   ,getTotal);


function getTotal(){
    var total   = new Decimal(0);
    var impup   ;
    var imppp   ;
    var impbp   ;
   
    if ($('#buypriceunit').val()){
        impup   = new Decimal($('#buypriceunit').val());
    }else{
        impup   = new Decimal(0);
    }

    if ($('#buypricepack').val()){
        imppp   = new Decimal($('#buypricepack').val());
    }else{
        imppp   = new Decimal(0);
    }

    if ($('#buypricebox').val()){
        impbp   = new Decimal($('#buypricebox').val());
    }else{
        impbp   = new Decimal(0);
    }

    total       = total.add(    impup.mul(  $('#importunit').val()  )   );
    total       = total.add(    imppp.mul(  $('#importpack').val()  )   );
    total       = total.add(    impbp.mul(  $('#importbox').val()  )   );
    $('#amount').val(total);
    $('#unitinstock').val(  $('#importunit').val()  );
    $('#packinstock').val(  $('#importpack').val()  );
    $('#boxinstock').val(   $('#importbox').val()   );
}

SCRIPT;
            Admin::script($script);


            $form->saved(function (Form $form) {
                Inventory::updatestock($form->model()->pid);
            });
        });
    }

    protected function productInventory($product){

        return Admin::content(function (Content $content) use ($product) {

            $content->header('Product');
            $content->description('Add Inventory');           
    
            $content->body($this->productInventoryForm($product));
        });
    }
    public function update($id)
    {
        return $this->formEdit()->update($id);
    }

    public function store()
    {

        
        return $this->formCreate()->store();
    }

    public function destroy($id)
    {

        if (Admin::user()->isRole('Administrator')){
            $inventory = Inventory::where('invid',$id)->first();
            if ($this->formEdit()->destroy($id)) {
                Inventory::updatestock($inventory->pid);
                return response()->json([
                    'status'  => true,
                    'message' => trans('admin::lang.delete_succeeded'),
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => trans('admin::lang.delete_failed'),
                ]);
            }
        }
    }

/*

use for inventory report
*/

    public function searchinventory(Request $request){

        $searchKey = $request->all();

        return Inventory::searchinventory($searchKey);
    }

}
