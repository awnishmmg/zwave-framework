<?php

function prx($arg,$exit=true){

	echo '<pre style="background-color:yellow;font-size:1.5rem;color:red;font-weight:bold;">';
	if(is_array($arg)){

		print_r($arg);

	}else if(is_object($arg) or is_bool($arg)){

		var_dump($arg);

	}else{
		echo $arg;
	}
	echo '</pre>';
	if($exit==true){
			exit;	
	}

}

function pr($arg){

	echo '<pre style="background-color:yellow;font-size:1.5rem;color:red;font-weight:bold">';
	if(is_array($arg)){

		print_r($arg);

	}else if(is_object($arg) or is_bool($arg)){

		var_dump($arg);

	}else{
		echo $arg;
	}
	echo '</pre>';

}



?>