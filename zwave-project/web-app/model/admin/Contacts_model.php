<?php

class Contacts_model{
    
    private $tablename = 'tbl_contacts';
    private $pk = 'id';
    
    private $column_name = 'name';
    private $column_email = 'email';
    private $column_mobile = 'mobile';
    private $column_user_id = 'user_id';

    private $column_date = 'date';
    private $column_time = 'time';

    private $last_id;

    private $fillable = [];

    public function __construct(){
        
        $this->fillable = [
            $this->column_name,
            $this->column_email,
            $this->column_mobile,
            $this->column_user_id,
            //date and time
            $this->column_date,
            $this->column_time,
        ];
        
        
    }
    
    public function getAllRecords(){
        global $chain;
        $chain = false;
        
        return getAll($this->tablename);
    }
    
    
    public function getAllRecordsByUserId($user_id){
        global $chain;
        $chain = true;
        
        $where = [
            $this->column_created_by => " = '$user_id' ",    
        ];
        
        return fetch_records(where_this(getAll($this->tablename),$where));
    }
    
    public function deleteRecordById($id){
        global $chain;
        $chain = false;
        
       if(delete($this->tablename,[$this->pk=>$id])){
           return true;
       }else{
           return false;
       }
    }
    
    public function AddContacts($form_data){
        global $chain;
        $chain = false;
        
        //Intialise the key with values
        $form_data[] = date('Y-m-d');
        $form_data[] = date('H:i:s');
        
        // prx(insertat($this->tablename,array_combine($this->fillable,$form_data)));
        
        if(insertat($this->tablename,array_combine($this->fillable,$form_data))){
            return true;
        }else{
            return false;
        }
    }
    
    public function getAllRecordsById($id){
        global $chain;
        $chain = false;
        return getone($this->tablename,[$this->pk=>$id]);
    }

    public function paginate($limit=1,$offset=10){
        global $chain;
        $chain = true;
        
        $query = limit_by(getAll($this->tablename),$limit,$offset);
        return fetch_records($query);

    }
    
    
    
    public function paginateByUserId($limit=1,$offset=10,$user_id){
        global $chain;
        $chain = true;
        
        $where = [
            $this->column_created_by => " = '$user_id'",    
        ];
        
        return fetch_records(limit_by(where_this(getAll($this->tablename),$where),$limit,$offset));
    }
    
    
     public function updateRecord($form_data,$chatbot_id){
         
        global $chain;
        $chain = false;
        

        
        
        if(update($this->tablename,[
            
            $this->column_company_uname =>$form_data['comp_username'],
            $this->column_company_name => $form_data['comp_name'],
            $this->column_template_name => $form_data['template_name'],
            $this->column_compaign_date => $form_data['compaign_date'],
            $this->column_compaign_text => $form_data['compaign_text'],
            $this->column_base_url => $form_data['base_url'],
            $this->column_encrypted_id => $form_data['encrypted_id'],
            $this->column_short_url => $form_data['short_url'],
            $this->column_compaign_image =>$form_data['image'],
            
            $this->column_created_date =>date('Y-m-d'),
            $this->column_created_time =>date('H:i:s'),
            $this->column_created_by =>$form_data['user_id'],
            
        ],[$this->pk=>$chatbot_id])){
            return true;
        }else{
            return false;
        }
        
    }

    // Return Schema 
    public function getTableName(){
        return $this->tablename;
    }

    public function getColumnCompaignText(){
        return $this->column_compaign_text;
    }

    public function getPrimary(){
        return $this->pk;
    }

    public function createContact($form_data){
        global $chain;
        $chain = false;

        //Intialise the key with values
        $form_data[] = date('Y-m-d');
        $form_data[] = date('H:i:s');


        if(insertat($this->tablename,array_combine($this->fillable,$form_data))){
            return true;
        }else{
            return false;
        }
    }


    public function getCompanyByUserId($userId){
        global $chain;
        $chain = true;
        return 
        fetch_records("SELECT * FROM {$this->tablename} WHERE {$this->column_user_id}='{$userId}'");
       
    
    }


    public function Update($set,$contact_id){
    	global $chain;
    	$chain = false;

    	if(update($this->tablename,$set,[$this->pk=>$contact_id])){
    		return true;
    	}else{
    		return false;
    	}
    }

}