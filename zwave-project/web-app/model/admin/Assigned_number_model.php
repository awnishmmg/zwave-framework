<?php

class Assigned_number_model{

	private $tablename = 'tbl_assigned_numbers';
	private $column_pk = 'assigned_id';
	private $column_procured_no_id = 'procured_no_id';
	private $column_user_id = 'user_id';
	private $column_billing_id = 'billing_id';
	private $column_status = 'status';

	private $fillable = [];
	private $last_id;
	
	public function __construct(){
		$this->fillable =[
			$this->column_procured_no_id,
			$this->column_user_id,
			$this->column_billing_id,
			$this->column_status,
		];

	}

	public function AssignNumbers($formdata){
		
		$formdata['status'] = 'assigned';
		if(insertat($this->tablename, array_combine($this->fillable, $formdata))):
				$this->last_id = last_inserted_id($this->tablename);
			return true;
		else:
			return false;
		endif;
	}


public function getInsertedId(){
	return $this->last_id;
}

public function getAssignedNumbers(){
	return getall($this->tablename);
}


public function getAssignedNumbersByUserId($user_id){

	global $chain;
	$chain = true;

		$query=where_this(getall($this->tablename),[
		$this->column_user_id =>" ='$user_id' AND ",
		$this->column_status =>" ='assigned'",	
	]);
	return fetch_records($query);
}

}
