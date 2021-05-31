<?php

$timezone = TIME_ZONE;
date_default_timezone_set($timezone);


//to get date
function get_date(){
	return date("d/m/y");	
}


//to get time 
function get_time(){
	return date("h:i:s:a");	
}


function get_year(){
	return date("Y");
}