<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey = 'catid';
    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany('App\Product','catid');
    }

    public static function getSelectOption(){
    	$rows = Category::all();
        $result = [null => 'Select Category'];
        foreach ($rows as $row) {
            $id       = $row->catid;
            $name     = $row->name;
            $result[$id] = "$id:$name";
        }
        return $result;
    }
}

