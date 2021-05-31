<?php

if(method()=='POST'):
	$session_data = session::get('session_data');
	$user_id = $session_data['user_id'];
	// Or 
	$company_ids = sanitise(post('company_ids'));

	load::model('user/Company');
	$company = new Company_model();

	if($company->companyBulkDelete(explode(',',$company_ids))):

		json_bind([],200,'Record Deleted Successfully',true);
	else:

		json_bind([],201,'Cannot Delete Record',false);
	endif;

else:

	json_bind([],404,'Invalid Request',false);

endif;