<?php

namespace App;

use Closure;
use Encore\Admin\Exception\Handle;
use Encore\Admin\Grid\Column;
use Encore\Admin\Grid\Displayers\ActionsProduct;
//use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Grid\Displayers\RowSelector;
use Encore\Admin\Grid\Exporter;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid;
//use Encore\Admin\Grid\FilterProduct;
use Encore\Admin\Grid\Model;
use Encore\Admin\Grid\Row;
use Encore\Admin\Grid\Tools;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Eloquent\Model as MongodbModel;

class GridProduct extends Grid
{
   
    /**
     * Options for grid.
     *
     * @var array
     */
    protected $options = [
        'usePagination'     => true,
        'useFilter'         => true,
        'useExporter'       => false,
        'useActions'        => true,
        'useRowSelector'    => true,
        'allowCreate'       => true,
        'allowBatchDelete'  => true,
    ];

    
    /**
     * Setup grid filter.
     *
     * @return void
     */
    protected function setupFilter()
    {
        $this->filter = new Filter($this->model());
    }

   
    /**
     * Add `actions` column for grid.
     *
     * @return void
     */
    protected function appendActionsColumn()
    {
        if (!$this->option('useActions')) {
            return;
        }

        $grid = $this;
        $callback = $this->actionsCallback;
        $column = $this->addColumn('__actions__', trans('admin::lang.action'));

        $column->display(function ($value) use ($grid, $column, $callback) {
            //$actions = new Actions($value, $grid, $column, $this);
            $actions = new ActionsProduct($value, $grid, $column, $this);

            return $actions->display($callback);
        });
    }



   
   
}
