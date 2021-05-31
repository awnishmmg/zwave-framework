<?php

if(!function_exists('set_flashData')){

function set_flashData($key,$data,$type=''){
	
	Session::set('flash__'.$key,[
		'type'=>$type,
		'data'=>$data
	]);

}

}

if(!function_exists('get_flashData')){

function get_flashData($key){

	$data = Session::get('flash__'.$key);
	if($data !=false){
		$data_data = $data['data'];
		$data_type = $data['type'];
		set_flash('msg','flash__'.$key,[
		   'flash__'.$key => (in_array($data_type,['success','info','warning','danger']))? call_user_func_array('alert_'.$data_type,array($data_data)) : $data_data,
		]);

	}
	
	show_flash();
	unset($_SESSION['flash__'.$key]);
	unset($_REQUEST['flash__'.$key]);
}
}



