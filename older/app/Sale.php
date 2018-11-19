<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sale extends Model
{
	protected $primaryKey = 'saleid';
    //
    public function customer()
    {
        return $this->belongsTo('App\Customer','cusid');
    }


    public static function searchsale($searchkey){

		$where = array();
    	$sql = <<<EOT
Select saleid 
	, total
	, ftotal
	, cusid
	  
From  sales s

	
EOT;
 


    	if (array_key_exists('saleid', $searchkey) ){
    		$where[] = " `s`.`saleid` = " 
    			. $searchkey['saleid'] . " ";	
    	}

		if (array_key_exists('saledate_start', $searchkey) ){
    		$where[] = " `saledate` between '" 
    			. $searchkey['saledate_start'] . "' and '" 
    			. $searchkey['saledate_end'] 	. "' ";	
    	}
    	if (array_key_exists('discount_start', $searchkey) ){
    		$where[] = " `discount` between " 
    			. $searchkey['discount_start'] . " and " 
    			. $searchkey['discount_end'] . " ";	
    	}

		if (array_key_exists('grandtotalrange', $searchkey) ){
    		$where[] = " `ftotal` between " 
    			. $searchkey['grandtotalrange'] . " ";	
    	}

    	if (array_key_exists('cusid', $searchkey) ){
    		$where[] = " `s`.`cusid` = " 
    			. $searchkey['cusid']  . " ";	
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

    	

    	$sales = DB::select($sql);

    	if ( count($sales) > 0){

   			
			$saleids = "( ";
			foreach ($sales as $sale) {
				$saleids .= $sale->saleid . ",";
			}

			$saleids = substr($saleids, 0, strlen($saleids)-1) . ")";

			$sql = <<<EOT
Select pid
	, sum(unitquantity) as sumunit
	, sum(packquantity) as sumpack 
	, sum(boxquantity) as sumbox  
From saleproducts
Where saleid in $saleids
group by pid;
EOT;

			$saleproducts = DB::select($sql);

			$pids = "( ";
            $temp = array();
			foreach ($saleproducts as $product) {
				$pids .= $product->pid . ",";
                $temp[$product->pid] = $product;
			}

            $saleproducts = $temp;

			$pids = substr($pids, 0, strlen($pids)-1) . ")";

			$sql = <<<EOT
Select i.pid
	, buypriceunit
	, buypricepack
	, buypricebox
From inventories i join (Select max(invid) as invid
						From inventories
						Where pid in $pids
						group by pid) as temp
	on i.invid = temp.invid
Order by i.pid;
EOT;
			$productprices = DB::select($sql);

            unset($temp);
            $temp = array();

            foreach ($productprices as $productprice) {
                $temp[$productprice->pid] = $productprice;
            }

            $productprices = $temp;
            unset($temp);

			return array('sales' 		=> $sales 
    				, 'saleproducts' 	=> $saleproducts
    				, 'productprices' 	=> $productprices);

		}

		return false;
    	

    }
}
