<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Exchangerate extends Model
{
     protected $primaryKey = 'exrateid';

     static function setnotcurrentrate($id){

     	$affected = DB::update('update exchangerates set currentrate = 0 where exrateid != ?',[$id]);
     	return $affected;

     }

    //
}
