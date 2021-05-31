<?php

if(method()=='POST'):
	$userid = sanitise(post('uuserid'));
	//Intialise the key with values
	load::model('admin/Contacts');
	class_alias('Contacts_model','Contacts');
	$contact = new Contacts();
	$contacts = $contact->getCompanyByUserId($userid);
	if(count($contacts)>0){
			echo "<option value=''>--select--</option>\n";
		foreach ($contacts as $contact) {
			if($contact['mobile']==""){
				$option_mobile = "";
			}else{
				$option_mobile = "[{$contact['mobile']}]";
			}
			echo "<option value='{$contact['id']}'>{$contact['name']} [{$contact['email']}] {$option_mobile} </option>\n";
		}
	}else{
		return json_bind([],201," &#10060; No Contacts Found Create New ",false);
	}

else:
	return json_bind([],201,"Invalid Method",false);
endif;