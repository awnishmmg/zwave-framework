<?php

class Procured_number_model{

	private $tablename = 'tbl_procured_numbers';
	
	private $column_pk 				    = 'id';

	private $column_prefix_code 	    = 'prefix_code';
	private $column_misscall_number 	= 'miscall_numbers';
	private $column_vendor_id 			= 'vendor_id';
	private $column_activation_date 	= 'activation_date';
	private $column_months 	            = 'months';
	private $column_status				= 'status';
	private $column_is_assigned			= 'is_assigned';


	public $last_id;

	private $fillable = [];


	public function __construct(){
		$this->fillable = [$this->column_misscall_number,$this->column_prefix_code,$this->column_vendor_id,
		$this->column_activation_date,$this->column_months];
	}

	public function addNumbers($formdata){
		global $chain;
		$chain = false;
		
		if(insertat($this->tablename, array_combine($this->fillable, $formdata))){
			$this->last_id = last_inserted_id($this->tablename);
			return true;
		}else{
			return false;
		}
	}

	public function getAllnumbers(){
		return getall($this->tablename);
	}

	public function getunAssignedNo(){
		global $chain;
		$chain = true;
		$where = [
			$this->column_is_assigned => " = '0' AND ",
			$this->column_status => " = 'active'"
		];
		
		return fetch_records(where_this(getall($this->tablename),$where));
		

	}

	public function set_status($status,$id){

		if(update($this->tablename,[$this->column_status=>$status],
		[
			$this->column_pk => $id,

		])){
			return true;
		}else{
			return false;
		}
	}

	public static function findVendorByID($vendor_id){
		
		$where = [
			'id'=>$vendor_id,
		];
		return getone('tbl_vendors',$where);
	}

	public function getNumberById($id){
	      global $chain;
	    $chain=false;
		$where = [

			'id'=>$id,
		];
		return getone($this->tablename,$where)['miscall_numbers'];
	}

	public function getNumberDetailsById($id){
	    
	    global $chain;
	    $chain=false;
	    
		$where = [

			'id'=>$id,
		];
		
		return getone($this->tablename,$where);
	}
	
	public function NumbersCounts(){
		return total_rows("SELECT * FROM `tbl_procured_numbers` ");

	}
	// Get Counts
	public function activeNoCounts(){
		return total_rows("SELECT * FROM `tbl_procured_numbers` WHERE status = 'active'");

	}

	public function inactiveNoCounts(){
		return total_rows("SELECT * FROM `tbl_procured_numbers` WHERE status = 'inactive'");

	}

}