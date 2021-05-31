<?php

class User_sms_api_model{

	private $tablename = 'tbl_sms_api';
	
	private $column_pk 				    = 'id';

	private $column_proc_id 	        = 'proc_id';
	private $user_id                    = 'user_id';
	private $column_service	            = 'sms_id';
	private $column_sender_id 			= 'sender_id';
	private $column_username 	        = 'acc_username';
	private $column_password 	        = 'acc_password';
	private $column_message				= 'message';

	public $last_id;

	private $fillable = [];


	public function __construct(){
		$this->fillable = [$this->user_id,$this->column_proc_id,$this->column_service,$this->column_sender_id,
		$this->column_username,$this->column_password,$this->column_message];
	}

	public function addSmsApi($formdata){
		global $chain;
		$chain = false;
		
		if(insertat($this->tablename, array_combine($this->fillable, $formdata))){
			$this->last_id = last_inserted_id($this->tablename);
			return true;
		}else{
			return false;
		}
	}

	public function getAllApi(){
		return getall($this->tablename);
	}
	
	public function getProcNumberByUserId($user_id){
	    global $chain;
	    $chain = true;
	    
 $data=where_this(inner_join("tbl_assigned_numbers=procured_no_id|tbl_procured_numbers=miscall_numbers",[
	      "tbl_procured_numbers" => 'tbl_assigned_numbers.procured_no_id = tbl_procured_numbers.id'
	      ]),[
	          "tbl_assigned_numbers.user_id" => " = '$user_id'"
	        ]);
	        
	       
	        return fetch_records($data);
	}
	public function getApiProcNumberByUserId($user_id){
	    global $chain;
	    $chain = true;
	    
        $data=where_this(inner_join("tbl_sms_api = * |tbl_procured_numbers=miscall_numbers",[
	      "tbl_procured_numbers" => 'tbl_sms_api.proc_id = tbl_procured_numbers.id'
	      ]),[
	          "tbl_sms_api.user_id" => " = '$user_id'"
	        ]);
	       
	        return fetch_records($data);
	}
		public function getApiByUserId($user_id){
		global $chain;
		$chain = true;
		$where = [
			$this->user_id => " = $user_id"
		];
		
		return fetch_records(where_this(getall($this->tablename),$where));
		

	}

}