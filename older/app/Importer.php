<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importer extends Model
{
    protected $primaryKey = 'impid';

    public function saleassistant()
    {
        return $this->hasMany('App\Saleassistant','impid');
    }

    public static function getSelectOption(){
        $rows = Importer::all();
        $result = [null => 'Select Importer'];
        foreach ($rows as $row) {
            $id       = $row->impid;
            $name     = $row->name;
            $result[$id] = "$id:$name";
        }
        return $result;
    }

/*
    public function product()
    {
        return $this->belongsToMany('App\Product');
    }

    public function productimportersaleassistant()
    {
        return $this->hasMany('App\productimportersaleassistants','impid');
    }

*/  
    //
}
