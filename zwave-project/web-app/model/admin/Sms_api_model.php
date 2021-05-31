<?php

class Sms_api_model{

	private $tablename = 'tbl_sms';
	
	private $column_pk 			= 'id';

	private $column_api_name 	= 'api_name';
	private $column_base_url 	= 'base_url';
	private $column_api_params 	= 'api_params';
	private $column_status 		= 'status';

	private $last_id;
	private $fillable = [];
	
	public function __construct(){
	    
	    $this->fillable = [
	        
	        $this->column_api_name,
	        $this->column_base_url,
	        $this->column_api_params,
	        $this->column_status,
	        
	   ];
	    
	}
	
	public function addSendApi($form_data){
	    global $chain;
	    
	    $chain = false;
	    
	    if(insertat($this->tablename,array_combine($this->fillable,array_values($form_data)))):
	        return true;
	    else:
	        return false;
	    endif;
	}

	public function getAllSmsApi(){
	    global $chain;
	    $chain=false;
	    
		return getall($this->tablename);
	}

    public static function getSmsNameById($sms_id){
        global $chain;
        $chain = false;
        $data = getone(get_instance(__CLASS__)->tablename,[
            get_instance(__CLASS__)->column_pk => $sms_id,
        ]);
       
       return $data['api_name'];
    }

}