<?php

$enc_uname = $enc_pass = "";
$min = 11111111111111;
$max = 99999999999999;

if(method()=='POST'){

	$submit = post('submit');
	if(isset($submit) and !empty($submit)){
		$username = sanitise(post('username'));
		$password = sanitise(post('password'));
		
		load::model('Login');

		$login = new Login_model();
		if($login->is_valid_user($username,$password)){
		  
			$enc_uname = pass_encrypt(rand($min,$max));
			$enc_pass = pass_encrypt(rand($min,$max));
			$role=$login->getRoleByUserid($username);

			Session::start();
			
			if($role=="user"){
				Session::set($session_key[$role], $username);

				$sess_authID = $username;
				$login_model = new Login_model();
				$user_data = $login_model->getUserByAuthID($sess_authID);
				Session::set('session_data', $user_data);
				
				set_flash('msg', '311', [
					'311' => alert_success("<b> User Login Success Redirecting ... </b>"),
				]);

			}else{
				Session::set($session_key[$role], $username);
				$sess_authID = $username;

				$login_model = new Login_model();
				$user_data = $login_model->getUserByAuthID($sess_authID);
				Session::set('session_data', $user_data);
				
				set_flash('msg', '309');	
			}

		}else{
			set_flash('msg', '307');
		}
	}
}


?>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-5">
<div class="account-card-box">
<div class="card mb-0">
<div class="card-body p-4">

<div class="text-center">
<div class="my-3">
<a href="index.html">
    <span><img src="assets/images/way2mint-logo.jpg?v=<?php echo time(); ?>" alt="" height="80"></span>
</a>
</div>
<h5 class="text-muted text-uppercase py-3 font-16">Sign In</h5>
</div>

<?php show_flash(); ?>
<form action="<?php echo basename($_SERVER['PHP_SELF'],'.php');?>" 
	class="mt-2" method="post">

<div class="form-group mb-3">
<input class="form-control" type="text" name="username" required="" placeholder="Enter your username" value="<?php isset($enc_uname)?print($enc_uname):"" ;?>">
</div>

<div class="form-group mb-3">
<input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password" value="<?php isset($enc_pass)?print($enc_pass):"" ;?>">
</div>

<div class="form-group mb-3">
<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
</div>
</div>

<div class="form-group text-center">
<input class="btn btn-success btn-block waves-effect waves-light" name="submit" type="submit" value="Log In"/> 
</div>

<a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>

</form>

</div> <!-- end card-body -->
</div>
<!-- end card -->
</div>

</div> <!-- end col -->
</div>
<!-- end row -->

</div>

<?php

if(@request('msg')=='311'){
	redirecting_to('user/dashboard?_status=login-success', 3);
}elseif(@request('msg')=='309'){
	redirecting_to('admin/dashboard/main?_status=login-success', 3);
}


?>
