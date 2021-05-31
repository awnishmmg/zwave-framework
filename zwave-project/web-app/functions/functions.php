<?php
//for file_size
function display_filesize($filesize){
   
    if(is_numeric($filesize)){
    $decr = 1024; 
	$step = 0;
    $prefix = array('Byte','KB','MB','GB','TB','PB');
       
    while(($filesize / $decr) > 0.9){
        $filesize = $filesize / $decr;
        $step++;
    }
    return round($filesize,2).' '.$prefix[$step];
    } else {

    return 'NaN';
    }
   
}


function set_msg($arr){
	$GLOBALS['msg']=$arr;
}

//sanitisation
function sanitise($arg){
$arg = strip_tags($arg);
$arg = htmlentities($arg);
$arg = htmlspecialchars($arg);
$arg = trim($arg);
return $arg;
}

//For Showing Error
function show_flash($action='')
{ 
	global $msg;
	$keyname = @$_REQUEST['msg'];
	$error=@$msg[$keyname];
	$request_action = @$_REQUEST['action'];
	
	if($action==$request_action and !empty($action)){
		echo "<span style='color:red' id='spn-error'>$error</span>";//Main Varible		
		echo "<script>";
		echo "setTimeout(function(){
		document.getElementById('spn-error').style='display:none;';
		},5000);";
		echo "</script>";
	}//action compare
	if($action=='' and $request_action==NULL){	
		echo "<span style='color:red' id='spn-error'>$error</span>";//Main Varible
		echo "<script>";
		echo "setTimeout(function(){
		document.getElementById('spn-error').style='display:none;';
		},5000);";
		echo "</script>";
	}
	
}

function redirect_to($arg){
	header("location:".APP_PATH."{$arg}");
	exit;
}


function redirecting_to($arg,$time){
	header("refresh:{$time};url=".APP_PATH."{$arg}");
	exit;
}


function base_url($arg=''){
	if(empty($arg)){
		return APP_PATH;
	}
	return APP_PATH.$arg;
}


//Super Global Varibles
function post($keyname=''){
	if(empty($keyname)){
		return $_POST;
	}
	return isset($_POST[$keyname])?$_POST[$keyname]:NULL;
}


function get($keyname=''){
	if(empty($keyname)){
		return $_GET;
	}
	return isset($_GET[$keyname])?$_GET[$keyname]:NULL;

}

function request($keyname=''){
	if(empty($keyname)){
		return $_REQUEST;
	}
	return $_REQUEST[$keyname];
}

function method(){
	return $_SERVER['REQUEST_METHOD'];
}



function pass_encrypt($argument){
	global $settings;
	$hash=md5($settings['salt_hash']);
	return call_user_func_array($settings['pass_encrypt'],[$argument.$hash]);
}


function set_flash($keyname,$value,$param=[]){
	
	if(count($param)>0){
		set_msg($param);
	}

	$_REQUEST[$keyname] = $value;
}

//get Cleint Ip
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


?>