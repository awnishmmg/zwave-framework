<?php

// Ui Action for Action Functionality in crud using select statement

function ui_action($function_name,$params,$options){
$case = "";
foreach($options as $key => $value){
    
	$case .= "\t case '$key': \n\t\t\t\t";
	$case .= "uri = '$value'+obj.title; \n\t\t\t\t";
	$case .= "break; \n \t\t";
	
}

echo <<<BLOCK
<script>
var base_url = "{$params['base_url']}";
base_url = base_url + "{$params['end_point']}";
 function $function_name(obj){
      var option = obj.value;
      switch(option){
          $case
          default:
          break;
      }
      window.location.href=base_url+uri;
   }
</script>
BLOCK;
}

// Ui Action for Action Functionality in crud using select statement
