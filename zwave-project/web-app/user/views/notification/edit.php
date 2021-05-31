<?php


$data = isset($chats_record)?$chats_record:post();
$error = isset($error)?$error:[];

load::php_file('functions/user/settings');
$valid_size = setting_file_size(2); //get from the database
$valid_extension = setting_extensions(2); //get from the database

?>
<form action="<?php echo base_url('user/notification-update'); ?>" method="post" enctype="multipart/form-data">		
<div class="card" >
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Add ChatBot Responder </h6>
		
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-2">
				Company username * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
				    <input type="text" name="comp_username" id="comp_username" class="form-control" value="<?php echo set_value('comp_username',$data,'company_username'); ?>"  />
        			<span style="color:red;"><?php echo set_error('comp_username',$error); ?></span>
					<input type="hidden" name="chatbot_id" class="form-control" value="<?php echo set_value('chatbot_id',$data,'id'); ?>" readonly />
					
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Company Name (Alias) * :
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
				    <input type="text" id="comp_name" name="comp_name" class="form-control" value="<?php echo set_value('comp_name',$data,'company_name'); ?>" />
				    <span style="color:red;"><?php echo set_error('comp_name',$error); ?></span>

				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Template Name * : 
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
				Compaign Date * : 
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
				Compaign Text * : 
			</div>
			<div class="col-md-10">
				<div class="form-group input-group">
				    
					<textarea name="compaign_text" 
					style="border-top:25px solid 
				#ced4da;" class="form-control" id="compaign_text" rows="10"><?php echo html_entity_decode(set_value('compaign_text',$data,'compaign_text')); ?></textarea>
					 <span style="color:red;"><?php echo set_error('compaign_text',$error); ?></span>
					
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Upload Attachement : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    
					 <input type="file" class="form-control" id="compaign_image"  name="compaign_image" />
					 <span class="text text-primary">Max size is 
					 	<?php echo display_filesize($valid_size); ?> and Allowed Extension (
					 	<?php echo pattern_replace('|',' , ',$valid_extension); ?>
					 ); </span>

				     <span style="color:red;">  <?php echo set_error('compaign_image',$error); ?> </span>
				     
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-1">
			    
				<input type="submit" name="submit-btn" class="btn btn-primary" value="Update">
				
			</div>
		</div>		
	</div>
</div>

</form>

<script>

    //  CKEDITOR.replace( 'compaign_text',{
    //   // Pressing Enter will create a new <div> element.
    //   enterMode: CKEDITOR.ENTER_DIV,
    //   // Pressing Shift+Enter will create a new <p> element.
    //   shiftEnterMode: CKEDITOR.ENTER_P
    // });

</script>
<?php echo set_js_error($error); ?>