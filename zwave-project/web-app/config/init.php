<?php

$settings = include 'settings.php';
extract($settings);


//Define Link Tags

function link_tag(){
	global $settings;

	$assets=$settings['assets'];
	if(array_key_exists('css', $assets)){

		foreach ($assets['css'] as $index => $css) {
			echo "<link href='assets/css/{$css}?v=".time()."' type='text/css' rel='stylesheet'/>";
		}
	}

}

//Define Scripts Tags
function script_tag(){
		global $settings;

	$assets=$settings['assets'];
	if(array_key_exists('js', $assets)){

		foreach ($assets['js'] as $index => $js) {

			echo "<script src='assets/js/{$js}?v=".time()."' type='text/javascript' rel='javascript'/></script>";
		}
	}

}

//define All Constants

foreach($settings['constants'] as $constnames => $value){
	define($constnames,$value);
}

