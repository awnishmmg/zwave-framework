<?php 
require_once __DIR__.'/session.php';

Class Session{

	public static function start(){
		#Session Will Application Set
		ini_set('session.name',APPSESSION_NAME);
		session_start();    
	}

	public static function set($key=NULL,$value){
		$_SESSION[$key] = $value;
	}

	public static function get($key){

		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	public static function checkSession($key){
		global $session_out_page;
		if(@$_SESSION[$key]==false or empty($_SESSION[$key])){
			if(in_array(Request::get(),array_keys($session_out_page))){
				redirect_to($session_out_page[Request::get()]);
			}
		}
	}

	public static function current(){
		global $session_key;
		$key = isset($session_key[Request::get()])?$session_key[Request::get()]:NULL;
		return [

			'key' => $key,
			'value' => $_SESSION[$key],
			'active' => 'active',
		];
	}


public static function destroy(){
		// Unset all of the session variables.
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        		$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]
    	);
	}
		session_destroy();
	}

public static function all(){
 	return $_SESSION;
}

}

if(!in_array(Request::param(),$session_not_allowed)){
		
       $key = isset($session_key[Request::get()])?$session_key[Request::get()]:NULL;
		Session::start();
		Session::checksession($key);
}
