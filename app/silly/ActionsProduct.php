<?php

namespace Encore\Admin\Grid\Displayers;

use Encore\Admin\Admin;

class ActionsProduct extends Actions
{
   


    protected $allowInventory = true;
  

    /**
     * {@inheritdoc}
     */
    public function display($callback = null)
    {
        if ($callback instanceof \Closure) {
            $callback = $callback->bindTo($this);
            call_user_func($callback, $this);
        }

        $actions = $this->prepends;
        if ($this->allowEdit) {
            array_push($actions, $this->editAction());
        }

        if ($this->allowDelete) {
            array_push($actions, $this->deleteAction());
        }

        if ($this->allowInventory){
            array_push($actions, $this->InventoryAction());
        }

       

        $actions = array_merge($actions, $this->appends);

        return implode('', $actions);
    }



    protected function editAction()
    {
        return <<<EOT
<a title="Edit Product" href="{$this->getResource()}/{$this->getKey()}/edit">
    <i class="fa fa-edit"></i>
</a>
EOT;
    }
    /**
     * Built delete action.
     *
     * @return string
     */
    protected function deleteAction()
    {
        $confirm = trans('admin::lang.delete_confirm');
        
        $script = <<<SCRIPT

$('.grid-row-delete').unbind('click').click(function() {
    
    if(confirm("{$confirm}")) {
        $.ajax({
            method: 'post',
            url: '{$this->getResource()}/' + $(this).data('id'),
            data: {
                _method:'delete',
                _token:LA.token,
            },
            success: function (data) {
                $.pjax.reload('#pjax-container');

                if (typeof data === 'object') {
                    if (data.status) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(xhr.responseText);
            }
        });
    }


});

SCRIPT;





        Admin::script($script);

        return <<<EOT
<a title="Delete Product" href="javascript:void(0);" data-id="{$this->getKey()}" class="grid-row-delete" >
    <i class="fa fa-trash"></i>
</a>
EOT;
    }


    protected function InventoryAction(){
        return <<<EOT
<a title="Add Inventory" href="inventory/create/{$this->getKey()}">
    <i class="fa fa-plus"></i>
</a>
EOT;

    }


}
