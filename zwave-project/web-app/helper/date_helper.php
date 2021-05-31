<?php

#function to change the format of the date

if(!function_exists('set_dateformat')){
    function set_dateformat($format,$old_date){
          $old_format_date = $old_date;
		  $new_format_date = date($format,strtotime($old_format_date));
		  return $new_format_date;
    }
    

}

?>