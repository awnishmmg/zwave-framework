<?php
#Include the Aplha Numeric Captcha Generator
require_once __DIR__.'/alpha.php';

header("Content-Type:image/jpeg");
$width = 150;
$height = 60;
$lines = rand(10,100);

#Image Frame Create

$imagef=imagecreate($width,$height);
#var_dump($imagef);

#r,g,b color

$r1=rand(0,255);
$g1=rand(0,255);
$b1=rand(0,255);

#Layering -1 :: Background
imagecolorallocate($imagef,$r1,$g1,$b1);
#Layering - 2 :: Foreground

$r2=rand(0,255);
$g2=rand(0,255);
$b2=rand(0,255);

#Layering -1 :: foreground
$color=imagecolorallocate($imagef,$r2,$g2,$b2);

$r3=rand(0,255);
$g3=rand(0,255);
$b3=rand(0,255);

$line_color=imagecolorallocate($imagef,$r3,$g3,$b3);

#Processing of Text

$dir = __DIR__;
$font_file = "{$dir}/font14.ttf";

#$tb=imagettfbbox(20,0,$font_file,"awnish");

$captcha = get_captcha_text();
session_start();
$_SESSION['captcha']= $captcha;

#Create the Random Lines

for($i=0;$i<$lines;$i++){
	$x1 = rand(0,$width);
	$x2 = rand(0,$width);
	$y1 = rand(0,$height);
	$y2 = rand(0,$height);
	imageline($imagef,$x1,$x2,$y1,$y2,$line_color);
}

imagettftext($imagef,23,8,30,43,$color,$font_file,$captcha);
#create the Image

#To write In File
#imagejpeg($imagef,"captcha.jpeg",100);

#To display In Browser
imagejpeg($imagef,'captcha.jpeg',100);

#If you are Writing to file Free Memory
#imagedestroy($imagef);













