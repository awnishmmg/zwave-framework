<?php
  show_flash();
?>

		
<div class="card" style="border:2px solid grey;">
	<div class="card-header">
	    <div class="row">
	        <div class="col-md-10">
		        <h6>Add SMS API Integration</h6>
		    </div>
		    <div class="col-md-2">
		        <a href="<?php echo base_url('admin/integration/show-api'); ?>"><button class="btn btn-primary">View Integrations</button></a>
		    </div>
		</div>
	</div>
	<form action="<?php echo base_url('admin/integration/create'); ?>" method="post" >
	<div class="card-body">
		<div class="row">
			<div class="col-md-2">
				Api Name* : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="api_name" class="form-control" required/>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			 Base Url * : 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<textarea name="base_url" class="form-control" required></textarea>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			 Api Parameters * : 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<textarea name="api_params" class="form-control" required></textarea>
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
			Activation Setting * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<select name="activation_status" class="form-control" required>
					    <option value="">--select--</option>
					    <option value="enable">Enable</option>
					    <option value="disable">Disable</option>
					</select>
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-1">
				<input type="submit" name="submit-btn" class="btn btn-primary">
			</div>
		</div>		
	</div>
</div>


</form>