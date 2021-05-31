<?php
//Error Library
$GLOBALS['success'] = "&#10004;";
$GLOBALS['warning'] = "&#9888;";


$success_open = '<div class="alert alert-success" role="alert">';
$success_close = '</div>'; 

$error_open = '<div class="alert alert-danger" role="alert">';
$error_close = '</div>'; 

$msg['400'] ="{$error_open} !! Something Went Wrong {$error_close}";



$msg['301'] = "{$error_open} * Invalid Request {$error_close}";
$msg['302'] = "{$success_open} Registration Success {$success_close}";
$msg['303'] = "{$error_open} * Email already exist {$error_close}";

$msg['304'] = "{$success_open} Record Deleted {$success_close}";
$msg['305'] = "{$error_open} !! Oops Cant Delete {$error_close} ";

$msg['306'] = "{$success_open} Updated Successfully {$success_close}";
$msg['307'] = "{$error_open} Invalid username or Password {$error_close}";
$msg['308'] = "{$error_open} Account Disabled By Admin {$error_close}";

$msg['309'] = <<<ERRORBLOCK
{$success_open} 
<b> Login Success You are being Validated... </b>
{$success_close}
ERRORBLOCK;

$msg['310'] = "{$error_open} Session Expired Try Login Again !! {$error_close}";
$msg['311'] = "{$success_open} Channel partner Added Successfully {$success_close}";
$msg['312'] = "{$success_open} Password Changed Try To Re-Login  {$success_close}";
$msg['313'] = "{$success_open} {$GLOBALS['success']} Logout Successfully {$success_close}";

$msg['314'] = "{$success_open} {$GLOBALS['success']} Template Configured Successfully {$success_close}";
$msg['315'] = "{$error_open} Template Cannot be Updated !! {$error_close}";
$msg['316'] = "{$error_open} Template Not Created !! {$error_close}";

$msg['317'] = "{$success_open} {$GLOBALS['success']} Template Reset Successfully {$success_close}";

$msg['318'] = "{$error_open} Template Cannot be Reset !! {$error_close}";
#File Upload
$msg['102'] = "{$success_open} &#10004; File Uploaded Successfully {$success_close}";













