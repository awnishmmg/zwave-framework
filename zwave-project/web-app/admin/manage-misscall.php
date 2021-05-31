<?php

Request::method('assign-number', function(){
		load::php_file('admin/views/manage-misscall/assign-number');
});


Request::method('assign', function(){

	if(method()=='POST'){
		
		$procured_no_id = sanitise(post('procured_no_id'));
		$user = sanitise(post('user'));

		$user_arr = explode('-', $user);
		$user_id = $user_arr[0];

		$billing_status = sanitise(post('billing_status'));
		$activation_date = sanitise(post('activation_date'));
		$need_hlr = sanitise(post('need_hlr'));
		$hlr_cost = sanitise(post('hlr_cost'));
		$hlr_unit = sanitise(post('hlr_unit'));
		$channel_price = sanitise(post('channel_price'));
		$channel_unit = sanitise(post('channel_unit'));
		$cost_price = sanitise(post('cost_price'));
		$cost_unit = sanitise(post('cost_unit'));
		$account_type = sanitise(post('account_type'));
		$retail_type = sanitise(post('retail_type'));
		$account_status = sanitise(post('account_status'));
		$add_gst = sanitise(post('add_gst'));
		$billing_name = sanitise(post('billing_name'));
		$billing_address = sanitise(post('billing_address'));
		$town = sanitise(post('town'));
		$city = sanitise(post('city'));
		$state = sanitise(post('state'));


		load::model('common/User_billing');
		$User_billing_model = new User_billing_model();
		if($User_billing_model->AssignNumbertoUser(compact('user_id','billing_status','activation_date','need_hlr','hlr_cost','hlr_unit','channel_price','channel_unit','cost_price','cost_unit','account_type','retail_type','account_status','add_gst','billing_name','billing_address','town','city','state'))){

			$billing_id = $User_billing_model->getInsertedId();
			load::model('admin/Assigned_number');
			$Assigned_number_model = new Assigned_number_model();
			if($Assigned_number_model->AssignNumbers(compact('procured_no_id','user_id','billing_id'))){

				set_flash('msg', 'message', [
				'message' => alert_success(" {$GLOBALS['success']} Misscall Number Assigned To User"),
			]);

			}else{

			set_flash('msg', 'message', [
				'message' => alert_danger(" {$GLOBALS['warning']} Cannot Assigned To User"),
			]);


			}


		}else{
			set_flash('msg', 'message', [
				'message' => alert_danger(" {$GLOBALS['warning']} Cannot Assigned To User"),
			]);
		}

	}
	load::php_file('admin/views/manage-misscall/assign');
});