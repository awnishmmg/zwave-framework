<?php
load::model('user/User');
$user_model = new User_model();
$session_data=session::get('session_data');
$login_id = $session_data['login_id'];
$user_id = $session_data['user_id'];
$user_model->getUserDetailsById(1);

load::model('admin/Assigned_number');
$assigned_model = new Assigned_number_model();
$assigned_data=$assigned_model->getAssignedNumbersByUserId($user_id);
load::model('admin/Procured_number');
$procured_model = new Procured_number_model();
        
?>

<form action="<?php echo base_url('user/my-billing') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h5>Miscall Billing Details:</h5> 
			</div>
			<div class="card-body">
			<div class="row">
			<div class="col-md-2">
				<b> Select Miscall No * </b>:
				</div>
			<div class="col-md-4">
				<div class="form-group">
				<select class="form-control" name="control" name="billing_id" id="billing_id">
						  <option class="form-control" value="">--select--</option>
						  <?php foreach($assigned_data as $number): ?>
						
						    <option class="form-control" value="<?php echo $number['billing_id']; ?>">
						        
						    <?php 
						            $procured_no_id = $number['procured_no_id'];
						            $procured_number_data=$procured_model->getNumberDetailsById($procured_no_id);
						            $prefix_code = $procured_number_data['prefix_code'];
						            $misscall_number = $procured_number_data['miscall_numbers'];
						  
						            echo "+{$prefix_code}{$misscall_number}";
						    ?>
						    
						    
						    </option>
					    
					    <?php endforeach; ?>
				</select>
				
				<span id="error-select-billing"></span>
				
				</div>
		  	</div>
		</div>
			<div class="row mt-2">
			<div class="col-md-2"></div>
			<div class="col-md-1">
				<input type="button" name="billing_search_btn" value="Search" class="btn btn-dark" id="billing_search_btn">
			</div>
		</div>
		
			</div>
		
		</div>
		
</form>

<div id="search-billing">
    
</div>
