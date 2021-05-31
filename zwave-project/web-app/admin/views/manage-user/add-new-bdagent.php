<?php 


load::model('admin/department');
$department_model = new Department_model();
$departments=$department_model->getAllDepartment();

?>

<?php show_flash() ?>

<form action="<?php echo base_url('admin/manage-user/add-new-bdagent') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>BD Profile</h6>
			</div>
			<div class="card-body">
				<div class="row">
			<div class="col-md-2">
			BD Name * : 
			</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="bd_name" class="form-control"/>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Department : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
			<select name="dept_id" class="form-control">
			 	<option value="">
			 		Select Department 
			 	</option>
			 <?php foreach($departments as $department): ?>
			 	<option value="<?php echo $department['id']; ?>"><?php echo 
			 	ucfirst($department['department']); ?></option>
			 <?php endforeach;?>	
			 </select>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Email * : 
			</div>
			<div class="col-md-4">
				<div class="form-group"><input type="email" name="bd_email" class="form-control"/>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Mobile No * : </div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="bd_mobile" class="form-control" />
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				</div>
			<div class="col-md-1">
			<input type="submit" name="submit_btn" class="btn btn-primary">
		</div>
	</div>

			</div>
		</div>

</form>