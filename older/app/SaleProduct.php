<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SaleProduct extends Model
{
	protected $table = 'saleproducts';
	//protected $primaryKey = null;
	public $incrementing = false;

	public function product()
    {
        return $this->belongsTo('App\Product','pid');
    }

    public static function searchsaleproduct($searchkey){
    	$where = array();
    	$sql = <<<EOT
Select p.pid as PID
	, p.name as Product
	, sum(unitquantity) as sumunit
	, sum(packquantity) as sumpack
	, sum(boxquantity) as sumbox
	, avg(sp.salepriceunit) as avgup
	, avg(sp.salepricepack) as avgpp
	, avg(sp.salepricebox) as avgbp
	, sum(subtotal) as sumstt 
from saleproducts sp join products p on sp.pid = p.pid
	
EOT;



    	if (array_key_exists('saleid', $searchkey) ){
    		$where[] = " `saleid` = " 
    			. $searchkey['saleid'] . " ";	
    	}

		if (array_key_exists('created_at_start', $searchkey) ){
    		$where[] = " sp.created_at between '" 
    			. $searchkey['created_at_start'] . "' and '" 
    			. $searchkey['created_at_end'] 	. "' ";	
    	}
    	if (array_key_exists('subtotal_start', $searchkey) ){
    		$where[] = " `subtotal` between " 
    			. $searchkey['subtotal_start'] . " and " 
    			. $searchkey['subtotal_end'] . " ";	
    	}

		if (array_key_exists('quantity', $searchkey) ){
    		$where[] = " ( `unitquantity` = " 
    			. $searchkey['quantity'] . " OR `packquantity` = "
    			. $searchkey['quantity'] . " OR `boxquantity` = "
    			. $searchkey['quantity'] . " ) ";	
    	}

    	if (array_key_exists('pid', $searchkey) ){
    		$where[] = " sp.pid = " 
    			. $searchkey['pid']  . " ";	
    	}


    	if (sizeof($where) > 0){
    		$sql .= " where ";

    		for ($i = 0 ; $i < sizeof($where) ; $i++){
    			$sql .= $where[$i];

    			if ($i < (sizeof($where) -1)){
    				$sql .= " AND ";
    			}
    		}
    	}

    	
    	$sql .= " group by p.pid, p.name;";
    	return DB::select($sql);
    	//return $sql;

    }

}
