<?php

class Load{

	//Model Folder
	public static function model($file){
/*********************************************************************************
	    #Logic is Implement for Linux/Unix Class Naming Convention

************************************************************************************/
	    $file_arr = explode("/",$file);
	   
	    $valid_names = [];
	    
	    if(count($file_arr)==1):
	        
	        $valid_names[0] = ucfirst(strtolower(end($file_arr)));
	        
	    elseif(count($file_arr)==2):
	        
	        $valid_names[0] = strtolower($file_arr[0]);
	        $valid_names[1] = ucfirst(strtolower(end($file_arr)));
	        
	    endif;
	    
	    
	    
	    $file = implode("/",$valid_names);
	    
/*********************************************************************************
	    #Logic is Implement for Linux/Unix Class Naming Convention

************************************************************************************/	

		$path=dirname(__DIR__)."/".__FUNCTION__."/{$file}_model.php";
		#echo $path;
		
		if(file_exists($path)):
			$value=basename($path,'_model.php');
			include_once $path;
		else:	
			die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	// Helper Folder
	public static function helper($file){
		
		$path=include dirname(__DIR__)."/".__FUNCTION__."/{$file}_helper.php";
		if(file_exists($path)):
			$value=basename($path,'_helper.php');
			include_once $path;
		else:
			die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	// Library Folder
	public static function library($file){
		
		$path=dirname(__DIR__)."/".__FUNCTION__."/{$file}.class.php";
		if(file_exists($path)):
				$value=basename($path,'.class.php');
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');	
		endif;
	}

	//Config Folder
	public static function config($file){
		
		$path=dirname(__DIR__)."/".__FUNCTION__."/{$file}_config.php";
		if(file_exists($path)):
				$value=basename($path,'_config.php');
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	//package Folder
	public static function package($file){
		
		$path=dirname(__DIR__)."/".__FUNCTION__."/{$file}_package.php";
		if(file_exists($path)):
				$value=basename($path,'_package.php');
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	//Any General PHP File
	public static function php($file,$from){
		
		$from = str_replace('.', "/", $from);
		$file = str_replace('.', "/", $file);

		$path=dirname(__DIR__)."/".$from."/{$file}.php";

		//echo $path;
		if(file_exists($path)):
				$value=basename($path,'.php');
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	//Any General assets File
	public static function assets($tmp_data=[]){

		@$from = str_replace('.', "/", $from);
		@$file = str_replace('.', "/", $file);

		$views = Request::param().'/views/'.Request::param(2);
		$from = $views;
		$file = Request::param(3);
	
		$path=dirname(__DIR__)."/".$from."/{$file}.php";

		// echo $path;
		if(file_exists($path)):
			//define the values
			if(count($tmp_data)>0):
				foreach ($tmp_data as $key => $value) {
					$$key = $value;		
				}
			endif;

				// $value=basename($path,'.php');
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}



	//Any General PHP File with Folder Name
	public static function php_file($file,$tmp_data=[]){
		
		$path=dirname(__DIR__)."/{$file}.php";
		if(file_exists($path)):

			//define the values
			
			if(count($tmp_data)>0):
				foreach ($tmp_data as $key => $value) {
					$$key = $value;		
				}
			endif;

				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	//Any File with Root Folder and File name with Any Extension
	public static function file($file){
		
		$path=dirname(__DIR__)."/{$file}";
		if(file_exists($path)):
				$value=basename($path);
				include_once $path;
		else:
				die('<b> Such '.__FUNCTION__.' File does not exist </b>');
		endif;
	}

	public static function view($file,$tmp_data=[]){
        $file = strtolower($file);
		$path=dirname(__DIR__)."/".__FUNCTION__."/{$file}_view.php";
		if(file_exists($path)){
			
			//define the values
			if(count($tmp_data)>0):
				foreach ($tmp_data as $key => $value) {
					$$key = $value;		
				}
			endif;
			include_once $path;
		}else{

			die('<b> Such '.__FUNCTION__." $file File does not exist </b>");

		}//end if-else


}//end of Views Functions


}
