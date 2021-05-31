<?php

class User_model{

	private $tablename = 'tbl_user';
	private $column_pk = 'user_id';
	private $column_name = 'name';
	private $column_company_name = 'company_name';
	private $column_email = 'email';
	private $column_mobile_no = 'mobile_no';
	private $column_landline = 'landline';

	private $column_company_description = 'company_description';
	private $column_bd_id = 'bd_id';

	private $last_id;
	private $fillable;

	public function __construct(){

		$this->fillable = [

				$this->column_name,
				$this->column_company_name,
				$this->column_email,
				$this->column_mobile_no,
				$this->column_landline,
				$this->column_company_description,
				$this->column_bd_id,
		];
		// prx($this->fillable);
	}

	public function addUser($formdata){
	
	if(insertat($this->tablename, array_combine($this->fillable,$formdata))):
		$this->last_id = last_inserted_id($this->tablename);
			return true;
		else:
			return false;
	endif;

	}

	public function getNewUserId(){
		return $this->last_id;
	}

	public function getAllUser(){
		global $chain;
		$chain = false;
		return getall($this->tablename);
	}

	public function getUserDetailsById($id){

		$where = [
			$this->column_pk => $id
		];
		return getone($this->tablename, $where);
		
	}

	public function deleteUser($id){
		global $chain;
		$chain = false;

		if(delete($this->tablename,[$this->column_pk => $id])){
			return true;
		}else{
			return false;
		}
	}


	public function getCompany(){
		global $chain;
		$chain = true;

		$data = fetch_records(select_from($this->tablename,'Distinct company_name as company ,user_id as id'));
		return $data;
		
	}

	public function getContactsPersons(){
		global $chain;
		$chain = false;

		$data = inner_join('tbl_user=user_id|tbl_contacts=id as contact_id,name as contact_name',['tbl_contacts'=>'tbl_contacts.id=tbl_user.contact_id']);
		return $data;

	}

	

}