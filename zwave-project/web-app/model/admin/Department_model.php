<?php

class Department_model{

private $tablename = 'tbl_dept';
private $column_pk = 'id';
private $column_department = 'department';

private $fillable =[];

public function __construct(){
	$this->fillable = [
		$this->column_department,
	];
}

public function addDepartment($formdata){
	if(insertat($this->tablename, array_combine($this->fillable, $formdata))){
		return true;
	}else{
		return false;
	}
} 

public function getAllDepartment(){
	return getall($this->tablename);
}

public function is_unique($deptname){
	if(@doexist($this->tablename, [
		$this->column_department => ['=',$deptname],
	])){
		return false;
	}else{
		return true;
	}
}

// Relationship

public static function having($fk_id,$key){
	
	$where =[
		get_instance(__CLASS__)->column_pk => $fk_id,  
	];
		
	return getone(get_instance(__CLASS__)->tablename,$where)[$key];
}


}
