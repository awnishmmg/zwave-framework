<?php


if(method()=='POST'):

	$accounts = sanitise(post('accounts'));
	$status = sanitise(post('status'));
	$session_data = Session::get('session_data');
	$user_id = $session_data['user_id'];

	load::model('user/Account');
	$accounts_model = new Account_model();

	if($accounts_model->addRecords(compact(['user_id','accounts','status']))){
		
		set_flash('msg','message',[
			'message' => alert_success(" {$GLOBALS['success']} Account Added "),
		]);

	}else{

		set_flash('msg','message',[
			'message' => alert_danger(" {$GLOBALS['warning']} Accounts Cannot Be Added "),
		]);
	}
else:
	load::php_file('user/views/accounts/create');
endif;
load::php_file('user/views/accounts/create');

?>
