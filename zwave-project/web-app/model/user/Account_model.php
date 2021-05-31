<?php

class Account_model{

	private $tablename = 'tbl_accounts';

	private $pk = 'id';

	private $column_user_id = 'user_id';
	private $column_accounts = 'accounts';
	private $column_status = 'status';

	private $last_id;
	private $fillable;

	public function __construct(){

		$this->fillable = [
				$this->column_user_id,
				$this->column_accounts,
				$this->column_status,
		];	

	}

	public function getAccountsByUserId($user_id){
		global $chain;
		$chain = true;

		$where = [
			$this->column_user_id => " =' $user_id'",
		];
		return fetch_records(where_this(getAll($this->tablename),$where));

	}

	public static function getAccountNameById($id,$column_name){
		global $chain;
		$chain = false;

		$instance = get_instance(__CLASS__);
		$accounts = getOne($instance->tablename,[$instance->pk => $id]);
		return $accounts[$column_name];

	}

	public function addRecords($form_data){
		global $chain;
		$chain = false;

		if(insertat($this->tablename,array_combine($this->fillable,$form_data))):
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




}