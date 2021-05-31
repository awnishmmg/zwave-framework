<?php

class User_billing_model{

private $tablename = 'tbl_user_billing';

private $column_pk = 'id';

private $column_user_id = 'user_id';
private $column_billing_status = 'billing_status';
private $column_billing_name = 'billing_name';
private $column_activation_date = 'activation_date';
private $column_status = 'status';
private $column_billing_cost = 'billing_cost';
private $column_billing_units = 'billing_units';
private $column_billing_channel_price = 'billing_channel_price';
private $column_billing_channel_units = 'billing_channel_units';
private $column_reseller_type = 'reseller_type';
private $column_billing_address = 'billing_address';
private $column_billing_city = 'city';
private $column_billing_town = 'town';
private $column_billing_state = 'state';
private $column_account_type = 'account_type';
private $column_need_hlr = 'need_hlr';
private $column_hlr_cost = 'hlr_cost';
private $column_hlr_unit = 'hlr_unit';
private $column_gst = 'gst';

private $last_id;

private $fillable = [];

public function __construct(){

	$this->fillable = [
	$this->column_user_id,
	$this->column_billing_status,
	$this->column_activation_date,
	$this->column_need_hlr,
	$this->column_hlr_cost,
	$this->column_hlr_unit,
	$this->column_billing_channel_price,
	$this->column_billing_channel_units,
	$this->column_billing_cost,
	$this->column_billing_units,
	$this->column_account_type,
	$this->column_reseller_type,
	$this->column_status,
	$this->column_gst,
	$this->column_billing_name,
	$this->column_billing_address,
	$this->column_billing_town,
	$this->column_billing_city,
	$this->column_billing_state,
	];
} 

public function AssignNumbertoUser($formdata){
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

public function getBillingDetailsId($id){
	
	$where = [
		$this->column_pk => $id,
	];
	return getone($this->tablename, $where);
}

}