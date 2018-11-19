<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'cusid';

    public function sale()
    {
        return $this->hasMany('App\Sale','cusid');
    }

    

    public static function getSelectOption(){
        $rows = Customer::all();
        $result = [null => 'Select Customer'];
        foreach ($rows as $row) {
            $id       = $row->cusid;
            $name     = $row->name;
            $result[$id] = "$id:$name";
        }
        return $result;
    }
  
    //
}
