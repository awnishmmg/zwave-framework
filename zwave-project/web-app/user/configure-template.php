<?php

if(method()=='POST'):

	$chatbot_id= sanitise(post('modal_hidden'));
	$token = sanitise(post('modal_token'));
	$has_placeholder = sanitise(post('modal_placeholder'));
	$variable = sanitise(post('modal_variable'));
	$variable_keys = sanitise(implode(',',(post('modal_key'))));
    $variable_values = sanitise(implode(',',(post('modal_value'))));
    $http = sanitise(post('modal_http'));

	$text = sanitise(post('modal_text'));
	if($http == 'GET'):

		$query_url = "";
		foreach(post('modal_value') as $index => $value):
				$query_url .="{$value}=[YOUR_VALUE]&";
	 	endforeach;

		$query_url = substr($query_url,0,-1);

	else:
		$query_url = '';
	endif;

	$status = 'active';

	$session_data = Session::get('session_data');
	$user_id = $session_data['user_id'];
	load::model('user/Template');
	$template = new Template_model();
	if($template->addTemplate(compact(['chatbot_id','token','has_placeholder','variable','variable_keys','variable_values','http','query_url','status','user_id']))){
		  #echo 'Record Inserted';
		if($template->updateOldTemplateById(htmlentities($text),$chatbot_id)){

			#echo 'Record Updated Too';
			redirect_to('user/notification-manage?msg=314');

			}else{
				redirect_to('user/notification-manage?msg=315');
			}
		}else{
				redirect_to('user/notification-manage?msg=316');
	}





endif;

