<?php

$core_path = dirname(__FILE__);
// echo $core_path;

//including csv path
$includes['csv'] =  "{$core_path}/inc/csv.inc.php";
$includes['user'] =  "{$core_path}/inc/user.inc.php";

foreach ($includes as $file => $file_path) {	
	if(!file_exists($file_path)){
		echo basename($file_path)." file does not exist";
		break;
	}
	
	include $file_path;
}



