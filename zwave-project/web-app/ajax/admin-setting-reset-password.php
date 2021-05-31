<?php

if(method()=='POST'):
$loginID = sanitise(post('login_id'));
load::model('Login');
$login = new Login_model();

load::php_file('functions/user/settings');
$password = setting_reset_password(2); //for user Reset Password 
// prx($password);
$encrypted_password = pass_encrypt($password);
// prx($password);

#prx($login->changeUserPassword($loginID,$password));

if($login->changeUserPassword($loginID,$encrypted_password)){

	json_bind([],200,'Password Reset to Default Password',true);
} //Password
else{
	json_bind([],201,'Password Cannot Be Reset',false);
}
else:
	json_bind([],404,'Invalid Request',false);
endif;

