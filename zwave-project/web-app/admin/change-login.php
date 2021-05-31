<?php


// User Redirection Logic being Implemented 
Request::method('user',function(){
    
    global $session_key;
    $auth_id = get('auth');
    load::model('Login');
    
    $login_model = new Login_model();
	$user_data = $login_model->getUserByAuthID($auth_id); 
	$user_data['login_by'] = 'admin';
	if(!isset($user_data['old_session_data'])){
	     $user_data['old_session_data'] = Session::get('session_data');
	}
	
    Session::set($session_key['user'],$auth_id);
    Session::set('session_data',$user_data);
    
    $session_data = Session::get('session_data');
    redirect_to('user/dashboard?_status=login-success&login_by=admin');
});

// Admin Redirection Logic being Implemented

Request::method('admin',function(){
    
    global $session_key;
    $auth_id = get('auth');
    
    load::model('Login');
    
    $login_model = new Login_model();
	$user_data = $login_model->getUserByAuthID($auth_id);
    Session::set($session_key['admin'],$auth_id);
    Session::set('session_data',$user_data);
    
    $session_data = Session::get('session_data');
    redirect_to('admin/dashboard/main?_status=welcome_back');
    
});