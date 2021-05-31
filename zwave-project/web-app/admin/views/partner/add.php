<?php

?>
<form action="<?php echo base_url('admin/partners/create'); ?>" method="post" >
		
<div class="card" style="border:2px solid grey;">
	<div class="card-header">
		<h6>Add Channel Partner </h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-2">
				Partner Name * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="vendor_name" class="form-control"/>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Description * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<textarea name="description" class="form-control"></textarea>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Partner Since : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="date" name="since" class="form-control"/>
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