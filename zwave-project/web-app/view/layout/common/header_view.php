<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Way2mint ChatBot Notification " name="description" />

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<base href="<?php echo APP_PATH; ?>">

<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/way2mint-logo.jpg?v=<?php echo time(); ?>">
<!-- App css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

<title>:: Chatbot Notification <?php isset($title)?print($title):print("Dashboard");?> ::</title>

<?php load::view('layout/common/styles');?>    
<script>
    
    var viewMode = getCookie("view-mode");
    if(viewMode == "desktop"){
        viewport.setAttribute('content', 'width=1024');
    }else if (viewMode == "mobile"){
        viewport.setAttribute('content', 'width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no');
    }
    
</script>
</head>

<body class="authentication-bg">

<div class="account-pages pt-5 my-5">