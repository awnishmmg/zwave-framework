
<!-- VIEW FORMS -->
<?php

load::model('user/User');
$User_model = new User_model();
$users=$User_model->getAllUser();

Load::model('Login');
$Login_model = new Login_model();

?>

<?php show_flash(); ?>
    <div class="row">
        <div class="col-lg-12">
        	<h5>User Accounts</h5>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-expanded="true">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                            role="tab" aria-controls="profile">Credential</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="billing-tab" data-toggle="tab" href="#billing"
                            role="tab" aria-controls="billing">Billing / Credits</a>
                    </li>
                </ul>
                <div class="tab-content text-muted" id="myTabContent">
                    <div role="tabpanel" class="tab-pane fade in active show" id="home"
                            aria-labelledby="home-tab">
                        <!-- Users Active -->

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>User Account</h6>
	</div>
	<div class="card-body">
		<table class="table table-hover">
	<tr>
		<th>#</th>
		<th>User Name</th>
		<th>Contact Info</th>
		<th>Company Name</th>
		<th>Email ID</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['user_id']; ?></td>
		<td><a href="<?php echo base_url("admin/manage-user/bds#"); ?>">
			<span>
				<i class="fa fa-user"></i> 
			</span>
			<?php echo $user['name']; ?>
			</a>
		</td>
		<td>
			<i class="fas fa-phone"></i>
			<b><?php echo $user['mobile_no']; ?></b>
		</td>
		<td><?php echo $user['company_name']; ?></td>
		<td>
			<a href="mailto:<?php echo "{$user['email']}"; ?>"><b><?php echo $user['email']; ?></b></a>
			</td>
			

		<td><?php echo $user['status']; ?></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="info__action(this);" title="<?php echo $user['user_id'];?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			

        </select>
	</td>
	</tr>
<?php endforeach; ?>
</table>


	</div>
</div>

<!-- User Active -->
 </div>
 <div class="tab-pane fade" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
 <!-- User Credentials -->
	<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>User Credential</h6>
	</div>
	<div class="card-body">
		<table class="table table-hover">
	<tr>
		<th>#</th>
		<th>User Name</th>
		<th>Email ID</th>
		<th>Login As</th>
		<th>Password</th>
		<th>Login Status</th>
		
	</tr>
		<?php if(count($users)>0): ?>
		<?php foreach ($users as $user): $user_id = $user['user_id']; ?>
			<tr>
				<td><?php echo $user['user_id'];?></td>
				<td><?php echo $user['name'];?></td>
				<td><?php echo $user['email'];?></td>
				<td>
                <?php $login_as = $Login_model->getLoginDetailsByUserId($user_id)['auth_id']; ?>
	            <a href="<?php echo base_url('admin/change-login/user?auth='.$login_as); ?>" target="_blank"> <?php echo "<i class='fa fa-user'></i> ".$Login_model->getLoginDetailsByUserId($user_id)['auth_id'];?> 
	            </a>
			
				</td>
				
				<td style="padding: 5px;">

					<button class="form-control-sm btn-danger mt-0" onclick="reset_password(this);" data-loginId="<?php echo 
					$Login_model->getLoginDetailsByUserId($user_id)['login_id']; ?>">Reset <i class="fa fa-key"></i></button>
					&nbsp;&nbsp;
				    <button class="form-control-sm btn-warning mt-0" onclick="change_password(this);" data-loginId="<?php echo 
					$Login_model->getLoginDetailsByUserId($user_id)['login_id']; ?>">Change <i class="fa fa-edit"></i></button>

				</td>
				<td>
					<a href="javascript:void(0);">
					<?php echo $Login_model->getLoginDetailsByUserId($user_id)['status']; ?> 
				</td>
				
			</tr>
		<?php endforeach; ?>
		<?php else:?>
			<tr>
					<td colspan="3"></td>
					<td><b>No Record Found</b></td>
					<td colspan="3"></td>
			</tr>
		<?php endif?>
</table>
                    
  	</div>
    </div>
            
    </div>


     <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
      

    </div>
    </div>
    <!-- end row -->


<!-- VIEW FORMS -->

<?php 

//Action UI for Credentials 

ui_action('credential__action',

    ['base_url'=>base_url(),'end_point'=>'admin/manage-user/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		
    ]);

//Action UI for Credentials 

//Action UI for Managing Users 

ui_action('info__action',

    ['base_url'=>base_url(),'end_point'=>'admin/manage-user/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		
    ]);

//Action UI for Managing User


?>

<script>
	
function reset_password(element){

	var loginID = $(element).data('loginid');

	if(loginID ==""){
		window.alert('Auth ID is Empty !!');
	}else{
		$.ajax({
			
			url:site_url+'ajax/admin/setting/reset/password',
			type:"POST",
			data:{login_id:loginID},
			beforeSend:function(){
				console.log("Request Send..");
			},
			complete:function(){
				console.log("Request Completed..");
			},
			success:function(response){

				if(response.response_code==200 && response.status == true){
					window.alert(response.comments);

				}else{

					window.alert(response.comments);
				}
			},
		});
	}
	


}


function change_password(element){


	var loginID = $(element).data('loginid');
	var new_password = window.prompt("Enter New Password :");

	if(new_password.trim() == null || new_password.trim() == ""){
		swal("OOps","Password Cannot Be Changed","danger");
	}else{
		if(window.confirm("Are you Sure to Change ?")){
			// console.log("password = "+new_password);
			if(loginID ==""){
				window.alert('Auth ID is Empty !!');
			}else{
			$.ajax({
				url:site_url+'ajax/admin/setting/change/password',
				type:"POST",
				data:{login_id:loginID,password:new_password},
				beforeSend:function(){
					console.log("Request Send..");
				},
				complete:function(){
					console.log("Request Completed..");
				},
				success:function(response){
					if(response.response_code==200 && response.status == true){
						swal("success",response.comments,"success")
					}else{
						swal("OOPs",response.comments,"danger")
					}
				},
			});
	}

		}else{
			swal("OOps","Password Cannot Be Changed","danger");
		}
	}
	// End of the Password 
	
}




</script>