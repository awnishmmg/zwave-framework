<?php

Request::method('add-new', function(){
	if(method()=='POST'):	
		// if(!is_null(post('submit-btn')) and !empty(post('submit'))):
			
			$name = post('name');
			$company_name = post('company_name');
			$email = post('email');
			$mobile = post('mobile');
			$landline= post('landline');
			$company_detail = post('company_detail');
			$bd_id = post('bd_id');
			$contact_id = sanitise(post('contact'));


			$auth_id = post('auth_id');
			$password = post('password');
			$cnf_password = post('cnf_password');
			$role_id = post('role_id');
			$menu_label = post('menu_label');
			$menu_label = implode(',', $menu_label);
			
			load::model('user/user');
			$user_model = new User_model();
			if($user_model->addUser(compact('name','company_name','email','mobile','landline','company_detail','bd_id'))):
				$user_id=$user_model->getNewUserId(); 
				
				load::model('admin/Contacts');
				$contact = new Contacts_model();
				$contact->Update(['user_id'=>$user_id],$contact_id);

				load::model('login');
				$login_model = new Login_model();
				if($password==$cnf_password):
					
					$password = pass_encrypt($password);
					if($login_model->create_login(compact('auth_id','password','role_id','user_id'))):

						$login_id = $login_model->getNewLoginId();
						load::model('user/user_permission');
						$user_permission_model = new User_permission_model();
				        $user_permission_model->assignMenustologInID($menu_label,$login_id);

				set_flash('msg', 'message', [
							'message'=>alert_success(" {$GLOBALS['success']} User Created Successfully "),
						]);
				
				else:
						set_flash('msg', 'message', [
							'message'=>alert_danger(" {$GLOBALS['warning']} Cannot Add User "),
						]);
					endif;
				else:	
					set_flash('msg', 'message', [
							'message'=>alert_danger(" {$GLOBALS['warning']} Password not Match "),
						]);
				endif;
			else:

			endif;
		// endif;
	else:
		load::php_file('admin/views/manage-user/add-new'); 
	endif;
	load::php_file('admin/views/manage-user/add-new'); 

});

Request::method('user', function(){
	load::php_file('admin/views/manage-user/user'); 
});

Request::method('bds', function(){
	load::php_file('admin/views/manage-user/bds'); 
});





Request::method('add-new-bdagent', function(){



if(method()=='POST'):
	$submit_btn = @post('submit_btn');
	if(isset($submit_btn) and !empty($submit_btn)):

		$bd_name = sanitise(post('bd_name'));
		$dept_id = sanitise(post('dept_id'));
		$bd_email = sanitise(post('bd_email'));
		$bd_mobile = sanitise(post('bd_mobile'));
		
		load::model('admin/bd_agents');
		$bd_agents_model = new Bd_agents_model();
		
		if($bd_agents_model->addBdAgents(compact('bd_name','dept_id','bd_email','bd_mobile'))):
		set_flash('msg', 'message', ['message'=>alert_success('BD Added')]);
		else:
		set_flash('msg', 'message', ['message'=>alert_danger('BD cannot be Added')]);
		endif;

	endif;
endif;
load::php_file('admin/views/manage-user/add-new-bdagent');

});

Request::method('delete',function($id){
	load::model('user/User');
	$user = new User_model();

	if($user->deleteUser($id)){
		set_flash('msg', 'message', ['message'=>alert_success('Record Deleted')]);
	}else{
	   set_flash('msg', 'message', ['message'=>alert_danger('Record Cannot Be Deleted')]);
	}
	load::php_file('admin/views/manage-user/user'); 
	redirecting_to('admin/manage-user/user',1);
});


Request::method('bds-delete',function($id){
	load::model('admin/Bd_agents');
	$bds = new Bd_agents_model();

	if($bds->deleteBds($id)){
		set_flash('msg', 'message', ['message'=>alert_success('Record Deleted')]);
	}else{
	   set_flash('msg', 'message', ['message'=>alert_danger('Record Cannot Be Deleted')]);
	}
	load::php_file('admin/views/manage-user/bds');
	

});