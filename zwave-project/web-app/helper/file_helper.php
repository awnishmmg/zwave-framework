<?php

// Important Functions Related to File Helper

if(!function_exists('convert_to_MB')){

function convert_to_MB($size){
	if(is_int($size) and ($size>0) )
    	return ($size*1024*1024);
    else 
     exit('Invalid size & must be greater than Zero');
}

}