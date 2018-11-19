<?php

namespace App\Admin\Controllers;

use App\Manufacturer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ManufacturerController extends Controller
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

            $content->header('Manufacturer');
            $content->description('List Manufacturers');

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

            $content->header('Manufacturer');
            $content->description('Edit Manufacturer');

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

            $content->header('Manufacturer');
            $content->description('Create New Manufacturer');

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
        return Admin::grid(Manufacturer::class, function (Grid $grid) {


            $grid->filter(function ($filter) {
                $filter->like('name');
            
            });

            $grid->mid('ID')->sortable();
            $grid->name('Name')->sortable();
            $grid->address('Address');
            $grid->tel('Phone');

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
        return Admin::form(Manufacturer::class, function (Form $form) {

            $form->display('mid', 'ID');
            $form->text('name', 'Manufacturer Name')->rules('required');
            $form->textarea('address', 'Address');
            $form->mobile('tel', 'Phone Number');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
