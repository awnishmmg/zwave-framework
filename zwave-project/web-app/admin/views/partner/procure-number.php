<?php
	
	show_flash();
?>

<form action="<?php echo base_url('admin/partners/procure-numbers') ;?>" 
method="post" >
	<div class="card" style="border:2px solid grey;">
		<div class="card-header">
			<h6>Add Channel Number</h6>
		</div>
		<div class="card-body">
			
		<div class="row">
			<div class="col-md-2">
			Channel Number * :
			</div>
			<div class="col-md-4">
				<div class="form-group"> 
			<input type="text" name="channel_number" placeholder="Enter Ten digit Number" class="form-control" />
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Prefix Code * (+) : 
			</div>
			<div class="col-md-4">
				<div class="form-group"><input type="text" name="prefix_code" placeholder="Enter Prefix code " value="" class="form-control"/>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Vendor : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<select name="vendor_id" class="form-control">
						<option> Select Vendor </option>
						<?php foreach($vendors as $vendor ): ?>
							<option value="<?php echo $vendor['id']; ?>"><?php echo $vendor['vendors_name']; ?></option>
						<?php endforeach; ?>
				  	</select>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Activation Date: 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="date" name="activation_date" class="form-control"/>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Validity (in Months): 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<select name="months" class="form-control">
						<option> Select Validity in months </option>
							<?php for($i=1;$i<=12;$i++): ?>
								<option><?php echo $i; ?></option>
							<?php endfor; ?>
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