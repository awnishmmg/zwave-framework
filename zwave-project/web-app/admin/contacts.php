<?php

Request::method('manage',function(){
		load::model('admin/Contacts');
		class_alias('Contacts_model','Contacts');
		$contact = new Contacts();
		$contacts = $contact->getAllRecords();

		$data['contacts'] = $contacts;

	    load::php_file('admin/views/contacts/manage',$data);
});	

Request::method('add',function(){
	load::php_file('admin/views/contacts/add');
});


Request::method('create',function(){

	$session_data = session::get('session_data');
	$user_id = $session_data['user_id'];
	// prx($session_data);
	$data['error'] = array();

	$name = sanitise(post('name'));
	$email = sanitise(post('email'));
	$mobile = sanitise(post('mobile'));

	$v = new Validator();
	$Validator = $v->init();
	
	$rules=$Validator->make(post(),[
		'name' => 'required',
		'email'=> 'required',
		'mobile' => 'required',
	]);

	$rules->validate();

	if($rules->fails()){
		$errors = $rules->errors();
		$data['error'] = $errors->firstOfAll();
		load::php_file('admin/views/contacts/add',$data);
	}else{

		load::model('admin/Contacts');
		class_alias('Contacts_model','Contacts');
		$contact = new Contacts();
		
		if($contact->AddContacts(compact(['name','email','mobile','user_id']))){

			set_flashData('message',"{$GLOBALS['success']} Contacts Added",'success');
			return redirect_to('admin/contacts/add');
		}else{
			  set_flashData('message',"{$GLOBALS['warning']} Cannot Add Contact",'danger');
		return redirect_to('admin/contacts/add');
	}
	}


	//;
});