<?php

class Vendor_model{

	private $tablename = 'tbl_vendors';
	
	private $column_pk 				= 'id';

	private $column_vendor_name 	= 'vendors_name';
	private $column_description 	= 'description';
	private $column_since 			= 'since';

	private $last_id;

	public function addVendors($formdata){

		$formdata = [
			$this->column_vendor_name => $formdata['vendor_name'],
			$this->column_description => $formdata['description'],
			$this->column_since => $formdata['since'],
		];

		if(insertat($this->tablename, $formdata)){
			$this->last_id = last_inserted_id($this->tablename);
			return true;
		}else{
			return false;
		}
	}

	public function getAllVendors(){
		return getall($this->tablename);
	}



	public function getAllDistinctVendors(){

		global $chain;
		$chain=true;
		
		return fetch_records(distinct(getall($this->tablename),'vendors_name'));
	}

}