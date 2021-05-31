<?php

load::model('admin/procured_number');
$procured_number_model = new Procured_number_model();
$numbers=$procured_number_model->getunAssignedNo();
load::model('user/user');
$user_model = new User_model();
$users=$user_model->getAllUser();

?>


<?php show_flash(); ?>
<form action="<?php echo base_url('admin/manage-misscall/assign'); ?>" 
method="post" >
	<div class="card" style="border:2px solid grey;">
		<div class="card-header">
			<h6>Assign Number</h6>
		</div>
		<div class="card-body">

		<div class="row">
			<div class="col-md-2">
			Channel Number *: 
			</div>
			<div class="col-md-4">
			<div class="form-group">
			<select name="procured_no_id" class="form-control">
			<option> Select Channel </option>
			<?php foreach($numbers as $number ): ?>
				<option value="<?php echo $number['id']; ?>">
					+ <?php echo $number['prefix_code']; ?>-
					<?php echo $number['miscall_numbers']; ?></option>
				<?php endforeach; ?>
		  	</select>
		  	<span class="text-primary">* Channel No is Misscall No User has Opted Out</span>
			</div>
		  </div>
		</div>

		<div class="row">
			<div class="col-md-2">
			Select User Type *: 
			</div>
			<div class="col-md-4">
			<div class="form-group">
			<input type="text" list="users" class="form-control" autocomplete="off" name="user">
			<datalist id="users">
				<?php foreach($users as $user): ?>
					<option value="<?php echo $user['user_id']."-".$user['name']." , @ {$user['company_name']}"; ?>" data-user_id='<?php echo $user['user_id'];?>'>
				<?php endforeach; ?>
			</datalist>
			<span class="text-primary">* Search the Concerned Owner of Service</span>

		</div>
		</div>
		</div>

		<div class="row">
			<div class="col-md-2">Billing * :
			</div>
				<div class="col-md-4">
				<div class="form-group">
				
				<input type="radio" name="billing_status"  class="radio admin-assign-radio" value="no"> No

				<input type="radio" name="billing_status" class="radio admin-assign-radio" value="yes"> Yes
			</div>
			</div>
			
		</div>

		<div class="row" id="admin-assign-billing" style="display: none;">
			<div class="col-md-12">
				<div class="card" style="border:2px solid grey;">
					<div class="card-header">
						<h6>Add Billing</h6>
					</div>
					<div class="card-body">
						<div class="row">
						<div class="col-md-2">
						Activation Date *
						</div>
						<div class="col-md-4">
							<input type="date" name="activation_date" class="form-control" />
							<span class="text-primary">Date when Activation was proposed</span>
						</div>
						<div class="col-md-2">
						HLR Lookup *
						</div>
						<div class="col-md-4">
							<select name="need_hlr" class="form-control" id="admin-assign-need_hlr"/>
							<option value="">--select--</option>
							<option value="yes">Yes</option>
							<option value="no">No</option>
							</select>
							<span class="text-primary"> HLR LooK up service is third party for Telecom Reporting </span>
						</div>
						<div class="row mt-4" id="admin-assign-hlr-cost" style="display: none;">
							<div class="col-md-2"></div>
							<div class="col-md-2">If You are using HLR Lookup Add the Cost/unit</div>
							<div class="col-md-3">
								Cost *<input type="number" name="hlr_cost" class="form-control" />
							</div>
							<div class="col-md-3">
								Per <select name="hlr_unit" class="form-control">
									<option value="">--select--</option>
									<option value="call">call</option>
									<option value="month">month</option>
									<option value="year">year</option>
									<option value="pulse">pulse</option>
									</select>
							</div>
						</div>
						</div>
						<!-- Another Row -->
						<div class="row mt-2">
						<div class="col-md-2">Channel Price * :
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="number" name="channel_price" class="form-control" />
							</div>
						</div>

						<div class="col-md-1">Per Unit*
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<select name="channel_unit" class="form-control">
									<option value="">--select--</option>
									<option value="call">call</option>
									<option value="month">month</option>
									<option value="year">year</option>
									<option value="pulse">pulse</option>
								</select>
							</div>
						</div>
						<!-- Channel Price -->

						<!--Start Cost Price -->
						<div class="row mt-2 ml-1">
						<div class="col-md-4">Cost for call* :
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="number" name="cost_price" class="form-control" />
							</div>
						</div>

						<div class="col-md-2">Per Unit
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<select name="cost_unit" class="form-control">
									<option value="">--select--</option>
									<option value="call">call</option>
									<option value="month">month</option>
									<option value="year">year</option>
									<option value="pulse">pulse</option>
								</select>
							</div>
						</div>

						</div>
						<!--End Cost Price  -->
					 </div>

					 <div class="row mt-2">
					 	<div class="col-md-2">Account Type*</div>
					 	<div class="col-md-4"><select name="account_type" class="form-control">
					 		<option value="">--select--</option>
								<option value="postpaid">Postpaid</option>
								<option value="prepaid">Prepaid</option>
					 	</select>
					 	</div>
					 	<div class="col-md-2">Retail Type*</div>
					 	<div class="col-md-4">
					 		<div class="form-group">
							<select name="retail_type" class="form-control">
									<option value="">--select--</option>
									<option value="reseller">Reseller</option>
									<option value="normal">Normal</option>
								</select>
							</div>
					 	</div>
					 </div>
					 <!-- End of Row -->

					 <!-- Start of Row -->
					 <div class="row mt-2">
					 	<div class="col-md-2">Acc Status*</div>
					 	<div class="col-md-4"><select name="account_status" class="form-control">
					 		<option value="">--select--</option>
								<option value="active">Active</option>
								<option value="deactive">Deactive</option>
								<option value="not using">Not Using</option>
					 	</select>
					 	<span class="text-primary">* Account must be Active for using service</span>
					 	</div>
					 	<div class="col-md-2">Add GST*</div>
					 	<div class="col-md-4">
					 		<div class="form-group">
							<select name="add_gst" class="form-control">
									<option value="">--select--</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
								<span class="text-primary">* Invoicing will Include GST Tax % *Incl.)</span>
							</div>
					 	</div>
					 </div>
					 <!-- End of Row -->

					 <!-- Start of Row -->
					 <div class="row mt-1 card-header">
					 	<div class="col-md-12">
					 		<h6 style="width: 200px;">Billing Information</h6>
					 	</div>
					</div>
					 <div class="row mt-2">
					 	<div class="col-md-2">Billing Name*</div>
					 	<div class="col-md-4"><input type="text" name="billing_name" class="form-control">
					 	<span class="text-primary">* Billing Name Should be Legal for Merchant Account as per PAN </span>
					 	</div>
			
					 </div>
					 <div class="row mt-2">
					 	<div class="col-md-2">Billing Address*</div>
					 	<div class="col-md-8">
					 	<textarea name="billing_address" class="form-control"></textarea>
					 	<span class="text-primary">* Billing Address includes your Full Permanent Address with any landmark if Any.</span>
					 	</div>
			
					 </div>

					 <div class="row mt-2">
					 	<div class="col-md-2">Town</div>
					 	<div class="col-md-6">
					 	<input type="text" name="town" class="form-control">
					 	</div>
					 </div>

					 <div class="row mt-2">
					 	<div class="col-md-2">City*</div>
					 	<div class="col-md-6">
					 	<input type="text" name="city" class="form-control">
					 	</div>
					 </div>

					 <div class="row mt-2">
					 	<div class="col-md-2">State*</div>
					 	<div class="col-md-6">
					 	<input type="text" name="state" class="form-control">
					 	</div>
					 </div>
					 <!-- End of Row -->



						<!-- End of Billing Row -->
					</div>

				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-1"><input type="submit" name="submit-btn" class="btn btn-primary"></div>
		<div>

		</div>
	</div>
</form>