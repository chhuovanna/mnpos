<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saleassistant extends Model
{
    protected $primaryKey = 'said';


    public function importer()
    {
        return $this->belongsTo('App\Importer', 'impid');
    }

/*
 	public function product()
    {
        return $this->belongsToMany('App\Product');
    }
  	public function productimportersaleassistant()
    {
        return $this->hasMany('App\productimportersaleassistants','said');
    }
    //
*/
}
