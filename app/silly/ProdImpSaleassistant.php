<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProdImpSaleassistant extends Pivot
{

	protected $primaryKey = ['pid','impid','said'];
    protected $table = 'Productimportersaleassistants';

/*
    public function product()
    {
        return $this->belongsTo('App\Product','pid');
    }
 	public function importer()
    {
        return $this->belongsTo('App\Importer','impid');
    }
    public function saleassistant()
    {
        return $this->belongsTo('App\Saleassistant','said');
    }
*/
    //
}