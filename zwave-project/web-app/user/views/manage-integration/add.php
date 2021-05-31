<?php
    $session_data = Session::get('session_data');
    
    $user_id = $session_data['user_id'];
    load::model('user/Account');
    $accounts_model = new Account_model();
    $accounts = $accounts_model->getAccountsByUserId($user_id);


     load::php_file('functions/user/settings');

	 $valid_size = setting_file_size(2); //get from the database
	 $valid_extension = setting_extensions(2); //get from the database

     $valid_size = convert_to_MB(intval($valid_size));

     $data = isset($data)?$data:post();
     $error = isset($error)?$error:[];  
?>

<form action="<?php echo base_url('user/notification-create'); ?>" method="post" enctype="multipart/form-data">
		
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Add ChatBot Responder </h6>
	</div>
	<div class="card-body">
	    
	    <span style="color:red;">* All Fields are Mendatory </span> <br/> <br/>
	    
		<div class="row">
			<div class="col-md-2">
				<b>Company username * :</b> 

			</div>
			<div class="col-md-4">
				<div class="form-group">

					<select class="form-control" name="comp_username" id="comp_username" class="form-control" onchange="getCompanies(this);">

						<option value="">--Select--</option>

							<?php if(count($accounts)>0): ?>
							<?php foreach($accounts as $account): ?>
								<option value="<?php echo $account['id']; ?>" 
									<?php if(set_value('comp_username',$data,'company_username')==$account['id']): echo 'selected'; endif; ?> > 
									<?php echo $account['accounts']; ?> 
								</option>
							<?php  endforeach; ?>

				        <?php endif;?>

					</select>
					<span style="color:red;"><?php echo set_error('comp_username',$error); ?></span>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<b>Company Name (Alias) * :</b>
			</div>
			<div class="col-md-4">
				<div class="form-group">

				<select class="form-control" name="comp_name" id="comp_name" class="form-control" value="<?php echo set_value('comp_name',$data,'company_name'); ?>" >
						<option value="">--Select--</option>
					</select>

				    
				    <!-- <input type="text" id="comp_name" name="comp_name" class="form-control" value="<?php //echo set_value('comp_name',$data,'company_name'); ?>" /> -->

				    <span style="color:red;"><?php echo set_error('comp_name',$error); ?></span>

				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				<b>Template Name * :</b> 
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
				<input type="text" name="template_name" id="template_name"  class="form-control" value="<?php echo set_value('template_name',$data,'template_name'); ?>" />

    				<span style="color:red;"><?php echo set_error('template_name',$error); ?></span>
    				
				</div>
		  	</div>
		</div>
		

		<div class="row">
			<div class="col-md-2">
				<b> Campaign Date * : </b> 
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
					<input type="date" name="compaign_date" id="compaign_date" class="form-control" value="<?php echo set_value('compaign_date',$data,'compaign_date'); ?>"  />

					<span style="color:red;"><?php echo set_error('compaign_date',$error); ?></span>
					
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				<b> Campaign Text * : </b> 
			</div>
			<div class="col-md-10">
				<div class="form-group">
				    
					<textarea name="compaign_text" class="form-control" id="compaign_text" ><?php echo set_value('compaign_text',$data,'compaign_text'); ?></textarea>

					  <span style="color:red;"><?php echo set_error('compaign_text',$error); ?></span>
					  
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				<b> Upload Attachement :  </b>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
					 <input type="file" class="form-control" id="compaign_image"  name="compaign_image" /> <span class="text text-primary">Max size is 
					 	<?php echo display_filesize($valid_size); ?> and Allowed Extension (
					 	<?php echo pattern_replace('|',' , ',$valid_extension); ?>
					 ); </span>
					 
				     <span style="color:red;"> <?php echo set_error('compaign_image',$error); ?> </span> 
				
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-1">
				<input type="submit" name="submit-btn" class="btn btn-primary" value="Submit">
			</div>
		</div>		
	</div>
</div>

</form>

<script>
    CKEDITOR.replace( 'compaign_text' );
</script>

<script type="text/javascript">
	function getCompanies(element){
		var company_AccountID = $(element).val();
		var user_id = "<?php echo session::get('session_data')['user_id']; ?>";
		var post_data = "<?php echo post('company_name'); ?>";
		// window.alert(company_userID);
		if(company_AccountID==""){
			return false;
		}else{
			$.ajax({
				url:site_url+'ajax/user/notification/company/get',
				type:"POST",
				data:{
					userid:user_id,
					accountid:company_AccountID,
					postdata:post_data
				},
				success:function(response){
					$("#comp_name").html(response);
				}
			});
		}

	}
</script>

<?php echo set_js_error($error); ?>