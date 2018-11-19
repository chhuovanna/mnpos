<?php

namespace App\Admin\Controllers;

use App\Saleassistant;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Importer;

class SaleassistantController extends Controller
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

            $content->header('Saleassistant');
            $content->description('List Saleassistants');

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

            $content->header('Saleassistant');
            $content->description('Edit Saleassistant');

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

            $content->header('Saleassistant');
            $content->description('Create New Saleassistant');

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
        return Admin::grid(Saleassistant::class, function (Grid $grid) {



            $grid->filter(function ($filter) {

                
                $importers = Importer::getSelectOption();
                $filter->equal('impid')->select($importers);

                $filter->where(function ($query) {

                        $query->whereRaw("`name` like '%{$this->input}%' OR `tel` like '%{$this->input}%' or `email` like '%{$this->input}%'");

                    }, 'Name or tel or mail');

            
            }); 

            $grid->model()->with('importer');
            
            $grid->said('ID')->sortable();
            $grid->name('Name')->sortable();
            $grid->address('Address');
            $grid->tel('Phone');
            $grid->email('Email');
            $grid->importer()->name('Importer');

            $grid->created_at();
            $grid->updated_at();

            $script = <<<SCRIPT
$("[name='impid']").select2();
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
        return Admin::form(Saleassistant::class, function (Form $form) {

            $form->display('said', 'ID');
            $form->text('name', 'Saleassistant Name')->rules('required');
            $form->textarea('address', 'Address');
            $form->text('tel', 'Phone Number');
            $form->email('email','Email');


            $importers = Importer::pluck('name','impid');
            $form->select('impid', 'Product Importer')->options($importers)->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
