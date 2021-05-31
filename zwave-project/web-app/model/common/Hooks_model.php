<?php

class Hooks_model{

private $tablename = 'tbl_hooks';

private $column_pk = 'id';

private $column_user_id = 'user_id';
private $column_procured_no_id = 'procured_no_id';
private $column_client_ip = 'client_ip';
private $column_caller_id = 'caller_id';
private $column_dispnumber = 'dispnumber';
private $column_start_time = 'start_time';
private $column_end_time = 'end_time';
private $column_billing_type = 'type';
private $column_billing_date = 'date';
private $column_time = 'time';


private $last_id;

private $fillable = [];

public function __construct(){

	$this->fillable = [
	    
    	$this->column_user_id,
        $this->column_procured_no_id,
        $this->column_client_ip,
        $this->column_caller_id,
        $this->column_dispnumber,
        $this->column_start_time,
        $this->column_end_time,
        $this->column_billing_type,
        $this->column_billing_date,
        $this->column_time,
	];
} 

    public function getAllHooksDataByUserID($user_id){
        global $chain;
        $chain = true;
        
       $data = where_this(getAll($this->tablename),[
    
           $this->column_user_id => " = '$user_id'",
                
            ]);
            
        return fetch_records($data);

    }
    
    public function getAllHooksData(){
        global $chain;
        $chain = false;
        
       return getall($this->tablename);
    }
}