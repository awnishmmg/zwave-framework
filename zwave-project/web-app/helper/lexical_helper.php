<?php

// Only reformat the Pattern of string
if(!function_exists('pattern_replace')){
	function pattern_replace($thiss,$that,$subject){
		return implode($that,explode($thiss, $subject));
	}
}

// Function to check the validity of varibles with NUll or exist or empty

if(!function_exists('variable_exists')){

	function variable_exists($variable,$if_not,$if){

		if($variable == "" ):
			return $if_not;

		elseif(empty($variable)):

			return $if_not;

		elseif(is_null($variable)):

			return $if_not;

		else:

		  	return $if;

		endif;
	}
}

//  Function to get Raw string by replacing \n and \r to <br>

if(!function_exists('escape_br')){

	function escape_br($subject){
		return str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$subject);
	}
}

//  Function to get replace Keys

if(!function_exists('parse_string')){

	function parse_string($pattern_arr=[],$subject_string=''){
		
		if(count($pattern_arr)>0):
			foreach($pattern_arr as $key => $value){
				$subject_string = str_replace($key,$value,$subject_string);
			}
		endif;
		
		return $subject_string;
	}
}

