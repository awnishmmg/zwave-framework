<?php

class Duplicate_download_model{

private $tablename = 'tbl_duplicate_downloads';
private $pk ='id';

private $column_dup_id='dup_id';

private $column_type='type';
private $column_downloaded_path = 'downloaded_path';
private $column_date = 'date';
private $column_time = 'time';
private $column_is_deleted = 'is_deleted';

private $fillable=[];
private $last_id;

public function __construct(){

	$this->fillable = [

		$this->column_dup_id,
		$this->column_type,
		$this->column_downloaded_path,
		$this->column_date,
		$this->column_time,
		$this->column_is_deleted,
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

public function getDownloads(){
	global $chain;
	$chain=false;
	return getall($this->tablename);
}

public function getAllDownloads(){
	global $chain;
	$chain=false;

	$data = inner_join('tbl_xlsconverter=*|tbl_user=company_name as company|tbl_contacts=name as contact_name',[
		"tbl_user"=>'tbl_user.user_id=tbl_xlsconverter.user_id',
		"tbl_contacts"=>'tbl_contacts.id=tbl_xlsconverter.contact_id'
	]);

	return $data;
}



}

?>