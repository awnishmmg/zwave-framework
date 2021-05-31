<?php

require_once __DIR__.'/matrix.php';

function get_captcha_text($size=6){
global $matrix;
$c_arr=[];
for($i=0;$i<$size;$i++){

	$c_arr[$i] = $matrix[rand(0,count($matrix)-1)];
}
$captcha = join($c_arr);
return $captcha;
}

#echo get_captcha_text();
