<?php 

$error = $error??[];

?>

<?php get_flashData('message'); ?>

<form action="<?php echo base_url('admin/contacts/create') ;?>" method="post" autocomplete="off">
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Add Contact Person</h6>
			</div>
			<div class="card-body">
				<div class="row">
			<div class="col-md-2">
			Name * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
						<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name',post());?>" />

			<span style="color:red;font-weight: bold;"><?php echo set_error('name',$error); ?></span>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Email * : 
			</div>
			<div class="col-md-4">
				<div class="form-group"><input type="email" name="email" class="form-control" id="email" value="<?php echo set_value('email',post()); ?>"/>

					<span style="color:red;font-weight: bold;"><?php echo set_error('email',$error); ?></span>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Mobile No * : </div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo set_value('mobile',post()); ?>"/>

					<span style="color:red;font-weight: bold;"><?php echo set_error('mobile',$error); ?></span>
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

<?php echo set_js_error($error); ?>
