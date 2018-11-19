<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $primaryKey = 'mid';


    public function products()
    {
        return $this->hasMany('App\Product','mid');
    }


    public static function getSelectOption(){
    	$rows = Manufacturer::all();
        $result = [null => 'Select Manufacturer'];
        foreach ($rows as $row) {
            $id       = $row->mid;
            $name     = $row->name;
            $result[$id] = "$id:$name";
        }
        return $result;
    }
    //
}
