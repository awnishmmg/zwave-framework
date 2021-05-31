<?php

if(method()=='POST'):
	$name = sanitise(post('uname'));
	$email = sanitise(post('uemail'));
	$mobile = sanitise(post('umobileno'));
	$userid = sanitise(post('uuserid'));
	//Intialise the key with values
   

	load::model('admin/Contacts');
	class_alias('Contacts_model','Contacts');
	$contacts = new Contacts();
	if($contacts->createContact(compact(['name','email','mobile','userid']))){
		return json_bind([],200,"Record Inserted",true);
	}else{
		return json_bind([],201,"Cannot Add Record !!",false);
	}

else:
	return json_bind([],201,"Invalid Method",false);
endif;