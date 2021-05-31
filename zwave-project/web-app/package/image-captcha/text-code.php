<?php
session_start();

$email = $_POST['email'];
#echo $email;

$sess_captcha=$_SESSION['captcha'];
#echo $sess_captcha;


$captcha = $_POST['captcha'];
#echo $captcha;

if($captcha == $sess_captcha){
	echo 'captcha matched';
}else{
	echo 'captcha not Matched';
}

