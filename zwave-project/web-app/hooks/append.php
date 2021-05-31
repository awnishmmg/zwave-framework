<?php

$hooks = include 'hooks.php';
foreach ($hooks as $key => $value){
	// echo $key;
	if(in_array($key, $hooks[basename(__FILE__,'.php').'_keys'])){

		$disallow_keys = $hooks['disallow_keys'];
		$uri=$_SERVER['REQUEST_URI'];
		$uri_arr=explode("/",$uri);
		
		$index = 0 ;
		foreach ($disallow_keys as $module_name => $m_value){
			$index=array_search($module_name, $uri_arr);
			break;
		}

	
		if($index>0){
				$da_k= $uri_arr[$index]; 
				$not_includes=$disallow_keys[$da_k];
				if(!in_array(basename($value,".php"),$not_includes)){
					include_once $value;
				}
		}else{
			include_once $value;
		}
		
	}
}

