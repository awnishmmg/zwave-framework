<?php
load::model('common/Menu');

class User_permission_model extends Menu_model{

	private $tablename = 'tbl_permission';

	private $column_pk = 'id';
	private $column_login_id = 'login_id';

	private $fillable;
	private $last_id;

	public function __construct(){

		$this->fillable = [
			$this->column_login_id,
		];
		
	}

	public function assignMenustologInID($menu_label,$login_id){
		$formdata =[
			$this->column_login_id => $login_id,
		];

		foreach (explode(',',$menu_label) as $index => $value) {
			$formdata[$value] = '1'; 
		}

		if(insertat($this->tablename, $formdata)):
		$this->last_id = last_inserted_id($this->tablename);
			return true;
		else:
			return false;
		endif;

	}


	public function getMenusByLoginId($loginId){
		global $chain;
		$chain = false;

		return getOne($this->tablename,[
		 	$this->column_login_id=>$loginId
		]);
	}




}


