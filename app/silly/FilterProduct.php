<?php

namespace Encore\Admin\Grid;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid\Filter\AbstractFilter;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use ReflectionClass;

/**
 * Class Filter.
 *
 * @method Filter     equal($column, $label = '')
 * @method Filter     like($column, $label = '')
 * @method Filter     gt($column, $label = '')
 * @method Filter     lt($column, $label = '')
 * @method Filter     between($column, $label = '')
 * @method Filter     where(\Closure $callback, $label)
 */
class FilterProduct extends Filter
{
  

    /**
     * Create a new filter instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->equal('pid', 'PID');
        $this->equal('barcode','Barcode');
        $this->like('name','Name');
        $this->like('shortcut','Shortcut');
        $this->equal('catid','Cat.ID');

    }

  
}
