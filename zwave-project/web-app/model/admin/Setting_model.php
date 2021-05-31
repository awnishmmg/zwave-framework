<?php

class Setting_model{
    
    private $tablename = 'tbl_settings';
    private $pk = 'id';
    
    private $column_role_id = 'role_id';
    private $column_title = 'title';
    private $column_name = 'name';
    private $column_description = 'description';
    private $column_options = 'options';
    private $column_value = 'value';
    
    private $last_id;
    
    
    
    private $fillable = [];

    public function __construct(){
        
        $this->fillable = [
            
            $this->column_role_id ,
            $this->column_title ,
            $this->column_name ,
            $this->column_description , 
            $this->column_options ,
            $this->column_value ,
        ];
        
    }

    public function addsettings($form_data){
        global $chain;
        $chain =false;

        prx(insertat($this->tablename,array_combine($this->fillable,$form_data)));
    }

    public function getSettingsByRoleId($role_id){

        global $chain;
        $chain = true;

    $where = [
        $this->column_role_id => " ='$role_id'",
    ];
        $settings = fetch_records(where_this(getAll($this->tablename),$where));
        return $settings;
    }

    public function getAllsettings(){
        global $chain;
        $chain = false;

        return getAll($this->tablename);
    }

    // Update function to update only first setting
    public function setNewSetting($new_value,$setting_id){
        global $chain;
        $chain = false;
        
        if(update($this->tablename,[$this->column_value => $new_value], [$this->pk => $setting_id])):
            return true;
        else:
            return false;
        endif;
    }

    // update function 
    
    
    
}