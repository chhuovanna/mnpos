<?php

namespace App\Admin\Controllers;

use App\Exchangerate;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ExchangerateController extends Controller
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

            $content->header('Exchange Rate');
            $content->description('List Exchange Rate');

            

            $exchangerate = Exchangerate::where('currentrate',1)->first();
            $content->body( view('moneyConvertor', ['exchangerate' => $exchangerate->amount]) );

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

            $content->header('Exchange Rate');
            $content->description('Edit Exchange Rate');
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

            $content->header('Exchange Rate');
            $content->description('Create Exchange Rate');

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
        return Admin::grid(Exchangerate::class, function (Grid $grid) {


            $grid->filter(function ($filter) {
                
                $filter->between('created_at', 'Created at')->datetime();
                $filter->equal('currentrate')->select([ '1' => 'Current' , '0' => 'Not Current']);

                
            });

            if (!Admin::user()->isRole('Administrator')){
                $grid->disableBatchDeletion();
                $grid->disableRowSelector();
            }

            $grid->model()->orderBy('updated_at','desc');
            $grid->exrateid('ID')->sortable();
            $grid->amount('Rate')->sortable();

            $grid->currentrate('Current Rate?')->display(function ($currentrate) {
                return $currentrate ? 'YES' : 'NO';
            });  

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Exchangerate::class, function (Form $form) {

            $form->display('exrateid', 'ID');
            $form->number('amount', 'Rate in Riel')->rules('required');
            $form->switch('currentrate', 'Is Current Rate?')->value(1);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            

            $form->saved(function (Form $form) {
                if ($form->currentrate == 'on' ){

                    if ($form->model()->exrateid){
                        Exchangerate::setnotcurrentrate($form->model()->exrateid);
                    }  
                }
            });
        });
    }

/*     public function destroy($id)
    {
        $ids = explode(',', $id);

        foreach ($ids as $id) {
            if (empty($id)) {
                continue;
            }
            $this->deleteFilesAndImages($id);
            $this->model->find($id)->delete();
        }

        return true;
    }

 */   
}
