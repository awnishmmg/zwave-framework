<?php

class Company_model{

	private $tablename = 'tbl_companies';

	// Primary Key
	private $pk = 'id';

	// Columns Set
	private $column_account_id = 'account_id';
	private $column_user_id = 'user_id';
	private $column_company_name = 'company_name';

	private $column_company_type = 'company_type';
	private $column_status = 'status';


	public $last_id;
	private $fillable;

	public function __construct(){

		$this->fillable = [
				$this->column_account_id,
				$this->column_user_id,
				$this->column_company_name,
				$this->column_company_type,
				$this->column_status,
		];	

	}

	public function getCompaniesByID($account_id,$user_id){
		global $chain;
		$chain = true;
		
		$where = [
			$this->column_account_id => " ='$account_id' AND ",
			$this->column_user_id => " ='$user_id'",
			// $this->column_status => " ='active'",

		];

		return fetch_records(where_this(getAll($this->tablename),$where));
		
	}

	

	public function addCompany($form_data){
		global $chain;
		$chain = false;
		
		// prx(insertat($this->tablename,array_combine($this->fillable,$form_data)));

		if(insertat($this->tablename,array_combine($this->fillable,$form_data))):
			$this->last_id = last_inserted_id($this->tablename);
			return true;
		else:
			return false;
		endif;
	}

	public function delete($id){
		global $chain;
		$chain = false;
		if(delete($this->tablename,[$this->pk=>$id])):
			return true;
		else:
		    return false;
		endif;
	}

	public function getlatestRecord(){
		global $chain;
		$chain = false;
		return getOne($this->tablename,[$this->pk=>$this->last_id]);
	}

	public function getActiveCompaniesByID($account_id,$user_id){
		global $chain;
		$chain = true;
		$where = [

			$this->column_account_id => " ='$account_id' AND ",
			$this->column_user_id => " ='$user_id' AND ",
			$this->column_status => " ='active'",

		];

		return fetch_records(where_this(getAll($this->tablename),$where));
		
	}

	public static function get($id,$column){
		global $chain;
		$chain = false;
		$instance = get_instance(__CLASS__);
		
		return getOne($instance->tablename,[$instance->pk=>$id])[$column];
	}

	public function companyBulkDelete($ids_columns){
		global $chain;
		$chain = false;

		if(delete_batch($this->tablename,$this->pk,$ids_columns)):
			return true;
		else:
			return false;
		endif;
	}



}