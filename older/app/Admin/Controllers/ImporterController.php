<?php

namespace App\Admin\Controllers;

use App\Importer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ImporterController extends Controller
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

            $content->header('Importer');
            $content->description('List Importers');

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

            $content->header('Importer');
            $content->description('Edit Importer');

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

            $content->header('Importer');
            $content->description('Create New Importer');

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
        return Admin::grid(Importer::class, function (Grid $grid) {

            $grid->impid('ID')->sortable();
            $grid->name('Name')->sortable();
            $grid->address('Address');
            $grid->tel('Phone');
            $grid->email('Email');

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
        return Admin::form(Importer::class, function (Form $form) {

            $form->display('impid', 'ID');
            $form->text('name', 'Importer Name')->rules('required');
            $form->textarea('address', 'Address');
            $form->mobile('tel', 'Phone Number');
            $form->email('email','Email');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
