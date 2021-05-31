<?php

class Xls_converter_model{

private $tablename = 'tbl_xlsconverter';
private $pk ='id';

private $column_conversion_type='conversion_type';
private $column_contact_id = 'contact_id';
private $column_user_id = 'user_id';
private $column_is_processed = 'is_processed';
private $column_is_uploaded = 'is_uploaded';
private $column_is_deleted = 'is_deleted';
private $column_root_path = 'root_path';
private $column_assets_path = 'assets_path';
private $column_uploads = 'uploads';
private $column_archived = 'archived';
private $column_date = 'date';
private $column_uploaded_at = 'uploaded_at';
private $column_processed_at = 'processed_at';
private $column_deleted_at = 'deleted_at';

private $fillable=[];
private $last_id;

public function __construct(){
	$this->fillable = [
	$this->column_conversion_type,
	$this->column_user_id,
	$this->column_contact_id,
	$this->column_is_processed,
	$this->column_is_uploaded,
	$this->column_is_deleted,
	$this->column_root_path,
	$this->column_assets_path,
	$this->column_uploads,
	$this->column_archived,
	$this->column_date,
	$this->column_uploaded_at,
	$this->column_processed_at,
	$this->column_deleted_at,

	];
}


public function create($form_data){
	global $chain;
	$chain = false;

	if(insertat($this->tablename,array_combine($this->fillable,array_values($form_data)))){
		return true;
	}else{
		return false;
	}

}

public function getUploads(){
	global $chain;
	$chain=false;
	return getall($this->tablename);
}

public function getAllUploads(){
	global $chain;
	$chain=false;

	$data = inner_join('tbl_xlsconverter=*|tbl_user=company_name as company|tbl_contacts=name as contact_name',[
		"tbl_user"=>'tbl_user.user_id=tbl_xlsconverter.user_id',
		"tbl_contacts"=>'tbl_contacts.id=tbl_xlsconverter.contact_id'
	]);

	return $data;
}


public function getUploadsById($id){
	global $chain;
	$chain =false;
	return getOne($this->tablename,[$this->pk=>$id]);
}

public function updateOnly($set,$id){
	global $chain;
	$chain = false;

	if(update($this->tablename,$set,[$this->pk=>$id])){
		return true;
	}else{
		return false;
	}
}


}



?>