<?php 

$error = $error??[];

?>
<?php get_flashData('message'); ?>
<form action="<?php echo base_url('admin/tools/duplicate-removal-upload') ;?>" method="post" 
	autocomplete="off" enctype="multipart/form-data">
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Add Details</h6>
			</div>
			<div class="card-body">

			<div class="row">
			<div class="col-md-3">
				<b>Select Company Name *</b> 

			</div>
			<div class="col-md-5">
				<div class="form-group">

					<select class="form-control" name="company" id="company" class="form-control" 
					onchange="getContacts();">

						<option value="">--Select--</option>

							<?php if(count($companies)>0): ?>
							<?php foreach($companies as $company): ?>
								<option value="<?php echo $company['id']; ?>" 
									<?php if(set_value('company',post(),'company')==$company['id']): echo 'selected'; endif; ?> > 
									<?php echo $company['company']; ?> 
								</option>
							<?php  endforeach; ?>

				        <?php endif;?>

					</select>
				<span style="color:red;" id="spn-company-error"><?php echo set_error('company',$error); ?></span>
				</div>
		  	</div>
		</div>

<div class="row">
			<div class="col-md-3">
				<b> Select Contact Person * </b> 

			</div>
			<div class="col-md-5">
				<div class="form-group">

					<select class="form-control" name="contact" id="contact" class="form-control">

						<option value="">--Select--</option>

					</select>

					<span style="color:red;"><?php echo set_error('contact',$error); ?></span>
				</div>
		  	</div>
		  	<div class="col-md-2">
		  	<button  type="button" style="margin-left: -12px;"class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center">Add Contact</button>
		   </div>
		</div>

		<hr class="hr"/>
		<div class="row">
			
			<div class="col-md-3">
				<b>Upload Zip *</b> <br/>

			</div>
			<div class="col-md-5">
				<div class="form-group">

					<input type="file" name="uploaded_files" class="form-control" accept=".zip" style="border: none;" />
					<span style="color:red;"><?php echo set_error('comp_username',$error); ?></span>
					
				</div>
		  	</div>

		</div>	

		<hr class="hr"/>

		<div class="row">
			<div class="col-md-3">
				<b> Zip Contains * </b> 

			</div>
			<div class="col-md-5">
				<div class="form-group">

					<select class="form-control" name="file_type" id="file_type" class="form-control">

						<option value="">--Select--</option>
						<option value="txt"> Txt </option>
						<!-- <option value="csv"> Csv </option> -->
						<!-- <option value="other"> Other </option> -->

					</select>

					<span style="color:red;"><?php echo set_error('file_type',$error); ?></span>
				</div>
		  	</div>
		</div>


		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-1">
			<input type="submit" name="submit_btn" class="btn btn-primary">
		</div>
	</div>

			</div>
		</div>

</form>



<!-- Modals forms -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title" id="myCenterModalLabel">Add Contact</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close-modal">×</button>
            </div>
            <div class="modal-body">

<?php $error = $error??[]; ?>
<?php get_flashData('message'); ?>
<form method="post" autocomplete="off">
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Contact Details</h6>
			</div>
			<div class="card-body">
				<div class="row">
			<div class="col-md-4">
			Name * : 
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<input type="text" name="modal_name" id="modal_name" class="form-control" value="<?php echo set_value('modal_name',post());?>" />

			<span style="color:red;font-weight: bold;">
				<?php echo set_error('modal_name',$error); ?>
			</span>

		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-4">
			Email * : 
			</div>
			<div class="col-md-8">
				<div class="form-group"><input type="email" name="modal_email" 
					id="modal_email" class="form-control" value="<?php echo set_value('modal_email',post()); ?>"/>

					<span style="color:red;font-weight: bold;"><?php echo set_error('modal_email',$error); ?></span>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-4">
			Mobile No * : </div>
			<div class="col-md-8">
				<div class="form-group"><input type="text" name="modal_mobile" class="form-control" id="modal_mobile" value="<?php echo set_value('modal_mobile',post()); ?>"/>

					<span style="color:red;font-weight: bold;"><?php echo set_error('modal_mobile',$error); ?></span>
		</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				</div>
			<div class="col-md-8">
			<button type="button" name="submit_btn" class="btn btn-primary" id="modal_btn">Submit</button>
		</div>
	</div>

			</div>
		</div>

</form>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modals forms -->

<!-- Modals Forms for File Uploading -->

<!-- Modals forms -->

<!-- Modals Forms for File Uploading -->

<?php echo set_js_error($error); ?>