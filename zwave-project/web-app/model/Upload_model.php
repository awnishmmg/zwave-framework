<?php

class Upload_model{

	private $tablename = 'tbl_uploads';
	private $last_id;

	public function addRawfileData($formdata){
		if(insertat($this->tablename,$formdata)){

			$this->last_id = last_inserted_id($this->tablename);
			return true;
		}else{
			return false;
		}
	}


	public function getAllUploads(){
		global $chain;
		$chain = true;
		$query = order_by(getall($this->tablename), 'date', 'desc');
		return fetch_records($query);


	}
	


}