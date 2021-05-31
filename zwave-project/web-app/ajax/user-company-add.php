<?php

if(method()=='POST'):
	
	$session_data = session::get('session_data');
	$user_id = $session_data['user_id'];
	$id = sanitise(post('id'));
	$cname = sanitise(post('cname'));
	$ctype = sanitise(post('ctype'));
	$cstatus = sanitise(post('cstatus'));
	load::model('user/Company');
	$company = new Company_model();

if($company->addCompany(compact(['id','user_id','cname','ctype','cstatus']))):
	$data = $company->getlatestRecord();
	json_bind($data,200,'Company Added Successfully',true);
else:
	json_bind([],201,'Record Cannot be Added',false);
endif;
else:
	json_bind([],404,'Invalid Request',false);
endif;


