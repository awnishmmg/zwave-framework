<?php

//Function to get Url from settings
if(!function_exists('setting_chatbot_url')){

	function setting_chatbot_url($role_id=2){
		load::model('admin/Setting');
    		 $setting = new Setting_model();

		    $allSettings=$setting->getSettingsByRoleId($role_id);
		      foreach ($allSettings as $sett):
		        if($sett['name'] == 'chatbot_default_url'):
		            $url = $sett['value'];
		            break;
		        endif;
		     endforeach;
		     return $url;
	}
}

//Function to get Allowed Extension from settings
if(!function_exists('setting_extensions')){

	function setting_extensions($role_id=2){
		load::model('admin/Setting');
		    $setting = new Setting_model();
		    $allSettings=$setting->getSettingsByRoleId($role_id);
		      foreach ($allSettings as $sett):
		        if($sett['name'] == 'extension_allowed'):
		            $extensions = $sett['value'];
		            break;
		        endif;
		     endforeach;
		     return $extensions;
	}
}



//Function to get Maximum Uploaded Size Extension from Settings
if(!function_exists('setting_file_size')){

	function setting_file_size($role_id=2){
		load::model('admin/Setting');
 		$setting = new Setting_model();
		    $allSettings=$setting->getSettingsByRoleId($role_id);
		      foreach ($allSettings as $sett):
		        if($sett['name'] == 'max_uploaded_size'):
		            $size = $sett['value'];
		            break;
		        endif;
		     endforeach;
		     return $size;
	}
}

//Function to get Maximum Uploaded Size Extension from Settings
if(!function_exists('setting_delimiter')){

	function setting_delimiter($role_id=2){
		load::model('admin/Setting');
 		$setting = new Setting_model();
		    $allSettings=$setting->getSettingsByRoleId($role_id);
		      foreach ($allSettings as $sett):

		        if($sett['name'] == 'place_holder_delimiters'):
		            $delimiter = $sett['value'];
		            break;
		        endif;
		     endforeach;
		     
		     return $delimiter;
	}
}


//Function to get Reset Password from settings
if(!function_exists('setting_reset_password')){

	function setting_reset_password($role_id=2){

		load::model('admin/Setting');
		    $setting = new Setting_model();
		    $allSettings=$setting->getSettingsByRoleId($role_id);
		      foreach ($allSettings as $sett):
		        if($sett['name'] == 'reset_password'):
		            $password = $sett['value'];
		            break;
		        endif;
		     endforeach;
		     return $password;
	}
}
