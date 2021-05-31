<?php

load::model('role');
$role_model = new Role_model();
$roles=$role_model->getAllRoles();

load::model('admin/bd_agents');
load::model('admin/department');
$bd_agents_model = new Bd_agents_model();
$bds=$bd_agents_model->getBdsAgentList();


load::model('admin/Contacts');
class_alias('Contacts_model','Contacts');
$contact = new Contacts();
$contacts = $contact->getAllRecords();

?>
<?php show_flash(); ?>
<form action="<?php echo base_url('admin/manage-user/add-new') ;?>" method="post" >
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>User Profile</h6>
			</div>
			<div class="card-body">
			<div class="row">
			<div class="col-md-3">
					Name * : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="name" class="form-control" />
				</div>
		  	</div>
		</div>

				<div class="row">
			<div class="col-md-3">
					Company Name * : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="company_name" class="form-control"/>
				</div>
		  	</div>
		</div>

				<div class="row">
			<div class="col-md-3">
					Email * : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><input type="email" name="email" class="form-control"/>
				</div>
		  	</div>
		</div>

				<div class="row">
			<div class="col-md-3">
					Mobile No * : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="mobile" class="form-control"/>
				</div>
		  	</div>
		</div>

				<div class="row">
			<div class="col-md-3">
					Landline No : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="landline" class="form-control"/>
				</div>
		  	</div>
		</div>

				<div class="row">
			<div class="col-md-3">
					Company Description : 
					</div>
			<div class="col-md-4">
				<div class="form-group"><textarea name="company_detail" class="form-control"></textarea>

				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-3">
					BD Incharge :
					</div>
			<div class="col-md-4">
				<div class="form-group"> 
					<select name="bd_id" class="form-control">
					 	<option value="">
					 		select  
					 	</option>
					 <?php foreach($bds as $bd): ?>
					 	<option value="<?php echo $bd['id']; ?>"><?php echo 
					 	ucfirst($bd['bd_name']); ?></option>
					 <?php endforeach;?>	
					 </select>
				</div>
		  	</div>
		</div>

			<div class="row">
			<div class="col-md-3"> Contact Person :</div>
			
			<div class="col-md-4">
				<div class="form-group"> 
					<select name="contact" class="form-control">
					 	<option value="">
					 		select  
					 	</option>
					 <?php foreach($contacts as $contact): ?>
					 	<option value="<?php echo $contact['id']; ?>">
					 	<?php echo 
					 	ucfirst($contact['name']); ?></option>
					 <?php endforeach;?>	
					 </select>
					

				</div>
		  	</div>
		</div>






		</div>
		</div>
		

		<hr class="hr" />
			<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Account Credentials </h6>
			</div>
			<div class="card-body">
			<div class="row">
			<div class="col-md-3">
				Login ID * : 
				</div>
			<div class="col-md-4">
				<div class="form-group"><input type="email" name="auth_id" class="form-control"/>
			</div>
		  	</div>
		</div>

			<div class="row">
			<div class="col-md-3">
				 Password * : 
				 </div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="password" class="form-control"/>
			</div>
		  	</div>
		</div>

			<div class="row">
			<div class="col-md-3">
				 Confirm Password * : 
				 </div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="cnf_password" class="form-control" />
			</div>
		  	</div>
		</div>
			</div>

		</div>
		<hr>
		
		<div class="card" >
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Role & Permission</h6>
			</div>
			<div class="card-body">
				<div class="row">
			<div class="col-md-3">
			 User Type * : 
			 </div>
			<div class="col-md-4">
				<div class="form-group">
			 <select name="role_id" id="admin-add-new-role" class="form-control">
			 	<option value="">
			 		select Role  
			 	</option>
			 <?php foreach($roles as $role): ?>
			 	<option value="<?php echo $role['role_id']; ?>"><?php echo 
			 	ucfirst($role['role']); ?></option>
			 <?php endforeach;?>	
			 </select>
		</div>
		  	</div>
		</div>

		

		<div class="row">
			<div class="col-md-3">
			 Permission * : 
			 </div>
			<div class="col-md-4">
				<div class="form-group">
			 <span id="admin-add-new-permission"></span>
			 
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-1">
			<input type="submit" name="submit-btn" class="btn btn-primary">
		</div>
		</div>

			</div>

		</div>

</form>