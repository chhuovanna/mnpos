<?php

namespace App\Admin\Controllers;

use App\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CategoryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
/*
        $role = Admin::user()->roles;
     

        if ($role[0]['name'] == "Administrator"){
            echo "lalal";
        }elseif($role[0]['name'] == "Pharmacist"){
            echo "lololo";
        }*/
        return Admin::content(function (Content $content) {

            $content->header('Category');
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

            $content->header('Category');
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

            $content->header('Category');
            $content->description('Create New Category');

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
        return Admin::grid(Category::class, function (Grid $grid) {
			
			$grid->filter(function ($filter) {
				$filter->like('name');
			
			});

            $grid->catid('ID')->sortable();
            $grid->name('name');
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
        return Admin::form(Category::class, function (Form $form) {

            $form->display('catid', 'ID');
            $form->text('name','Category Name')->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
