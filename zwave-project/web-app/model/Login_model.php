<?php

class Login_model{

	private $tablename = 'tbl_login';
	
	private $column_pk = 'login_id';
	private $column_auth = 'auth_id';
	private $column_pass = 'auth_pass';
	private $column_role_id = 'role_id';
	private $column_user_id = 'user_id';
	private $column_status = 'status';
	private $login_id;

	private $fillable;
	private $last_id;

	public function __construct(){

		$this->fillable = [
			$this->column_auth,
			$this->column_pass,
			$this->column_role_id,
			$this->column_user_id,
		];

	}

	public function addAdmin($auth_id,$auth_pass){
        global $chain;
        $chain = false;
        
		$formdata=[

			$this->column_auth => $auth_id,
			$this->column_pass => $auth_pass, 
		];

		if(insertat($this->tablename, $formdata)){
			$this->login_id = last_inserted_id($this->tablename);  
			return true;
		}else{
			return false;
		}
	}

	public function getAdminAddedID(){
          global $chain;
          $chain = false;
        
		return $this->login_id;
	}

	public function is_valid_user($auth_id, $auth_pass){
		// global $chain;
		// $chain = true;
        global $chain;
        $chain = false;
        
		$where =[
			$this->column_auth =>['=',$auth_id],
			$this->column_pass =>['=',pass_encrypt($auth_pass)],
		];

		if(@doexist($this->tablename, $where)){
			return true;
		}else{
			return false;
		}
	}

	public function getRoleByUserid($username){
	    global $chain;
         $chain = false;
         
		$where = [
			$this->column_auth => $username
		];

		$role_id=getone($this->tablename,$where)['role_id'];
		load::model('Role');
		$role_obj = new Role_model();
		$roles_name=$role_obj->getRole($role_id)['role'];
		return $roles_name;

	}

	public function create_login($formdata){
	     global $chain;
         $chain = false;
         
		if(insertat($this->tablename, array_combine($this->fillable,$formdata))):
		$this->last_id = last_inserted_id($this->tablename);
			return true;
		else:
			return false;
		endif;

	}
	

	public function getNewLoginId(){
	    global $chain;
        $chain = false;
		return $this->last_id;
	}

	public function getLoginDetailsByUserId($user_id){
	     global $chain;
          $chain = false;
			
			$where = [
				$this->column_user_id => $user_id,
			];

			return getone($this->tablename, $where);
	}

	public function getUserByAuthID($auth_id){
	      global $chain;
          $chain = false;
		
		$where = [
			$this->column_auth => $auth_id,
		];

		return getone($this->tablename, $where);
	}		

    public function getUserPasswordById($login_id){
        global $chain;
        $chain=false;
        
        $where = [
            
           $this->column_pk=> $login_id,
        
        ];

        return getone($this->tablename,$where)['auth_pass'];
    }

    public function changeUserPassword($login_id,$password){
        
        global $chain;
        $chain = false;
        
        $set = [
            $this->column_pass => $password,
        ];
        
        $where = [
            $this->column_pk=>$login_id,
        ];
       
       	// prx(update($this->tablename,$set,$where));

        if(update($this->tablename,$set,$where)):
            return true;
        else:
            return false;
        endif;
        
    }

}