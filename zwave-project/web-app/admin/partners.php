<?php

Request::method('add',function(){
	load::php_file('admin/views/partner/add');

});

Request::method('view',function(){
	load::php_file('admin/views/partner/view');

});


Request::method('delete',function(){

});

Request::method('create',function(){

	if(method()=='POST'){

		$vendor_name = sanitise(post('vendor_name')); 
		
		$description = sanitise(post('description'));
		$since =  sanitise(post('since'));
		load::model('admin/vendor');

			(new Vendor_model)->addVendors(compact(['vendor_name','description','since']));

		redirect_to('admin/partners/view?msg=311');
		
}
	
});

Request::method('procure-numbers', function(){

if(method()=='POST'){

		$channel_number = sanitise(post('channel_number')); 
		
		$prefix_code = sanitise(post('prefix_code'));
		
		$vendor_id =  sanitise(post('vendor_id'));
		$activation_date =  sanitise(post('activation_date'));
		$months =  sanitise(post('months'));

		load::model('admin/Procured_number');
		$procured_number_model = new Procured_number_model();

		if($procured_number_model->addNumbers(compact(['channel_number','prefix_code','vendor_id','activation_date','months']))){

			set_flash('msg', 'message',[
				'message' => alert_success(" {$procured_number_model->last_id} Miss-call Number Added "),
			]);

		}else{
			
			set_flash('msg', 'message',[
				'message' => alert_danger("Miss-call Number cannot be Added "),
			]);
		}


}

load::model('admin/vendor');

$vendor_model = new Vendor_model();
$vendors = $vendor_model->getAllDistinctVendors();
$data['vendors'] = $vendors ;
load::php_file('admin/views/partner/procure-number',$data);

});

Request::method('manage-numbers',function(){
	load::php_file('admin/views/partner/manage-numbers');
});

Request::method('change-status', function($status,$id){
	load::model('admin/procured_number');
	$procured_number_model = new procured_number_model();
	
	$status = ($status=='active')?'inactive':'active';
	$miss_call = $procured_number_model->getNumberById($id);

	if($procured_number_model->set_status($status,$id)){
		set_flash('msg', 'message', [
			'message'=>alert_success(" {$GLOBALS['success']} <b>$miss_call</b> is $status "),
		]);
	}else{

		set_flash('msg', 'message', [
			'message'=>alert_danger(" {$GLOBALS['warning']} Error changing Status"),
		]);
	} 
	load::php_file('admin/views/partner/manage-numbers');

});


?>