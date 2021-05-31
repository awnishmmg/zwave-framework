<?php 
$session_data = Session::get('session_data');
$auth_id = $session_data['auth_id'];

//code for going to Admin dashboard from user this link only works when login_by is set
$login_by = isset($session_data['login_by'])?$session_data['login_by']:"";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>:: Chatbot App ||
<?php isset($title)?print($title):print(""); ?>
::</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Responsive bootstrap 4 admin template" name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<base href="<?php echo APP_PATH; ?>">
<!-- App favicon -->
<!--<link rel="shortcut icon" href="assets/images/main.png">-->

<!-- App css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />


<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<?php load::view('layout/user/styles'); ?>

</head>

<body class="left-side-menu-dark topbar-light">

<!-- Begin page -->
<div id="wrapper">


<!-- Topbar Start -->
<div class="navbar-custom">
<ul class="list-unstyled topnav-menu float-right mb-0">

    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="mdi mdi-bell-outline noti-icon"></i>
            <span class="noti-icon-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5 class="font-16 text-white m-0">
                    <span class="float-right">
                        <a href="" class="text-white">
                            <small>Clear All</small>
                        </a>
                    </span>Notification
                </h5>
            </div>

            <div class="slimscroll noti-scroll">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-danger">
                        <i class="mdi mdi-account-plus"></i>
                    </div>
                    <p class="notify-details">New user
                        <small class="text-muted">You have 10 unread messages</small>
                    </p>
                </a>

                

               
            </div>

            <!-- All-->
            <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                View all
                <i class="fi-arrow-right"></i>
            </a>

        </div>
    </li>
    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<!--             <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
<span class="d-none d-sm-inline-block ml-1 font-weight-medium" title="<?php echo $auth_id; ?>"> <?php echo $auth_id; ?> </span>
            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow text-white m-0">Welcome !</h6>
            </div>

            <!-- item-->
            <a href="<?php echo base_url('user/profile'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-account-outline"></i>
                <span>Profile</span>
            </a>

         <a href="<?php echo base_url('user/change-password'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-lock-outline"></i>
                <span>Change Password</span>
            </a>

        <a href="<?php echo base_url('user/accounts-create'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-link-variant"></i>
                <span>Linked Accounts</span>
            </a>

            <div class="dropdown-divider"></div>

            <!-- item-->
            <a href="<?php echo base_url('user/logout');?>" class="dropdown-item notify-item">
                <i class="mdi mdi-logout-variant"></i>
                <span>Logout</span>
            </a>
            
            <?php if($login_by=='admin'): ?>
            
                <div class="dropdown-divider"></div>
    
                <!-- item-->
                <a href="<?php echo base_url('admin/change-login/admin?auth=admin');?>" class="dropdown-item notify-item">
                    
                    <i class="mdi mdi-switch-variant"> </i>
                    
                    <span class="btn btn-dark" >Switch to Admin</span>
                </a>
            
            <?php endif; ?>
            

        </div>
    </li>

    <li class="dropdown notification-list">
        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
            <i class="mdi mdi-settings-outline noti-icon"></i>
        </a>
    </li>

</ul>

<!-- LOGO -->
<div class="logo-box">
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="assets/images/way2mint-logo.jpg" alt="" height="22">
            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
        </span>
        <span class="logo-sm">
            <!-- <span class="logo-lg-text-dark">U</span> -->
            <img src="assets/images/way2mint-logo.jpg" alt="" height="24">
        </span>
    </a>

    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/way2mint-logo.jpg" alt="" style="height:80px;width:100%;padding-bottom: 2px;box-shadow:0px 0px 5px black;margin-top:-10px;">
            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
        </span>
        <span class="logo-sm">
            <!-- <span class="logo-lg-text-dark">U</span> -->
            <img src="assets/images/way2mint-logo.jpg" alt="" height="44">
        </span>
    </a>
</div>

<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
    <li>
        <button class="button-menu-mobile waves-effect waves-light">
            <i class="mdi mdi-menu"></i>
        </button>
    </li>

    <li class="d-none d-sm-block">
        <form class="app-search">
            <div class="app-search-box">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Help Support ...">
                    <div class="input-group-append">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </li>

</ul>
</div>
<!-- end Topbar -->


<?php load::view('Layout/user/nav'); ?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
<div class="content">
    
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        
                        <!-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Uplon</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                            <li class="breadcrumb-item active">Dark Sidebar</li>
                        </ol> -->

                        <!-- <?php bread_crumb((isset($bread_link)?$bread_link:"")); ?>

-->
                    </div>
                    <h4 class="page-title">

    <?php isset($bread_title)?print($bread_title):print("Dashboard"); ?></h4></h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        




