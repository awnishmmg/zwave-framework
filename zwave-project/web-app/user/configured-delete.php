<?php

if(method()=='GET'):

load::model('user/Template');
class_alias('Template_model','Template');

$token = get('token');
$temp_id = get('temp_id');

$Template = new Template();
if($Template->delete(get('id'))){
	return redirect_to("user/manage-integration?msg=317&tmp_id={$temp_id}&token={$token}");
}else{
	return redirect_to("user/manage-integration?msg=318&tmp_id={$temp_id}&token={$token}");
}

endif;


