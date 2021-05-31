<?php

Request::method('all',function(){
   
   $session_data = Session::get('session_data');
    $user_id = $session_data['user_id'];
    // $role_id = $session_data['role_id'];
    
    load::model('admin/Setting');
    class_alias('Setting_model','Settings');
    $setting = new Settings();
    $data['settings'] = $setting->getAllsettings();

   load::php_file('admin/views/setting/all',$data);

});


Request::method('create',function(){

});

Request::method('change',function(){

	$setting_id = sanitise(post('setting_id'));
	$setting_value = sanitise(post('setting_value'));

	load::model('admin/Setting');
    class_alias('Setting_model','Settings');

    $setting = new Settings();
    if($setting->setNewSetting($setting_value,$setting_id)):
    	return redirect_to('admin/setting/all?_status=record-updated');
    else:
    	return redirect_to('admin/setting/all?_status=record-update-Error');
    endif;

});

