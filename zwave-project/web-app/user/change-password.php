<?php

$error="";
if(method()=='POST'):
    $submit_btn = post('submit');

    if(isset($submit_btn) and !empty($submit_btn)):
        
    load::model('Login');
    
    $login = new Login_model();
    $session_data = Session::get('session_data');
    $login_id = $session_data['login_id'];

    $dbpass=$login->getUserPasswordById($login_id);
    
    $oldpass = pass_encrypt(sanitise(post('oldpass')));
    $newpass = pass_encrypt(sanitise(post('newpass')));
    $cnfpass = pass_encrypt(sanitise(post('cnfpass')));
    
    //change password logic
    
    if($oldpass==$dbpass):
        if($newpass==$cnfpass):
            if($cnfpass==$oldpass):
                $error = "New Password or Confirm Password cannot be same as Old Password";
            else:
                // Load the Model to Change the Code
                
                $password=$newpass;
                
                if($login->changeUserPassword($login_id,$password)):
                    
                    set_flash('msg','password-changed',[
                        
                        'password-changed'=>alert_success(" {$GLOBALS['success']} Password Changed Success"),
                    ]);
                    
                    session::destroy();
                    //Now Redirect to Login Screen after 3 seconds
                    
                else:
                    $error = "Password Changing Failed";
                endif;
                
            endif;
        else:
            $error = "New Password and Confirm Password Does not Match";
        endif;
    else:
       $error='Password not Matched ';
        
    endif;
    //end of change password logic
    
    if(!empty($error)):
        set_flash('msg','message',[
            'message'=>alert_danger(" {$GLOBALS['warning']} {$error} "),
        ]);
    endif;
        
    else:
        // prx('invalid Request *',false);
    endif;
    
endif;


?>


<?php show_flash(); ?>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<form action="<?php echo base_url('user/change-password') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h5>Change Password</h5> 
			</div>
			<div class="card-body">
			<div class="row mt-2">
			    <div class="col-md-6"><b>Old Password</b></div>
			    <div class="col-md-6"><input type="text" name="oldpass" class="form-control" required></div>
			</div>
		     
		    
		    <div class="row mt-2">
			    <div class="col-md-6"><b>New Password</b></div>
			    <div class="col-md-6"><input type="text" name="newpass" class="form-control" required></div>
			</div>
		    
		    
		    <div class="row mt-2">
			    <div class="col-md-6"><b>Confirm Password</b></div>
			    <div class="col-md-6"><input type="text" name="cnfpass" class="form-control" required></div>
			</div>
		    
		    
		    <div class="row mt-2">
			    <div class="col-md-6"></div>
			    <div class="col-md-6">
			        <input type="submit" name="submit" class="btn btn-dark" 
			        value="change">
			     </div>
			</div>
			
			
		    </div>
		</div>
		
</form>

</div>
<div class="col-md-4"></div>
</div>

<?php

if(@request('msg')=='password-changed'):
    redirecting_to('login?msg=312',3);
endif;

?>