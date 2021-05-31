
<?php

Request::method('manage', function($action){
	if($action=='view'){
		load::php_file('admin/views/department/manage');	
	}

});

Request::method('add', function($action){
if(method()=='POST'):
	$dept_btn = post('dept_btn');
	if(isset($dept_btn) and !empty(post('dept_btn'))):
		$dept_name = post('dept_name');
		if(!empty($dept_name)):
			load::model('admin/department');
			$department_model = new Department_model();
			if($department_model->is_unique($dept_name)):
			if($department_model->addDepartment([$dept_name])):
				set_flash('msg', 'message', ['message' => alert_success('Department Added')]);
			else:
				set_flash('msg', 'message', ['message' => alert_danger('Insertion Error')]);
			endif;
			else:
		 	set_flash('msg', 'message', ['message' => alert_danger("$dept_name Already Exist")]);
			endif;
		else:
			$email_error= '<b> Department is Required </b>';
			set_flash('msg', 'dept_name',['dept_name' =>$email_error,]);
			set_flash('action','dept_name');
		endif;
	endif;
endif;
	load::php_file('admin/views/department/manage');

});