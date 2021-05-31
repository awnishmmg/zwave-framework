<?php
class Role_model{

	private $tablename = 'tbl_role';

	private $column_id = 'role_id';
	private $role_id;


	public function getRole($id){	
			$where = [
			$this->column_id => $id,
		];
		return getone($this->tablename, $where);
	}

	public function getAllRoles(){
		return getall($this->tablename);
	}
}