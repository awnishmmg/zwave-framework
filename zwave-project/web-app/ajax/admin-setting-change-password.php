<?php

if(method()=='POST'):
	
$loginID = sanitise(post('login_id'));
$password = sanitise(post('password'));
$encrypted_password = pass_encrypt($password);
load::model('Login');
$login = new Login_model();

if($login->changeUserPassword($loginID,$encrypted_password)){

	json_bind([],200,'Password Changed Successfully',true);
} //Password
else{
	json_bind([],201,'Password Cannot Be Reset',false);
}
else:
	json_bind([],404,'Invalid Request',false);
endif;

