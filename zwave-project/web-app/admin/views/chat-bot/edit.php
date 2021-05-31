<?php

$data = isset($chats_record)?$chats_record:post();
$error = isset($error)?$error:[];


?>
<form action="<?php echo base_url('admin/chat-bot/update'); ?>" method="post" enctype="multipart/form-data">		
<div class="card" style="border:2px solid grey;">
	<div class="card-header">
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
				Company Name * : 
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
    				
    				
    					 <span style="color:red;">	<?php echo set_error('comp_name',$error); ?></span>
    					
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
				<div class="form-group">
					<textarea name="compaign_text" class="form-control" id="compaign_text" ><?php echo set_value('compaign_text',$data,'compaign_text'); ?></textarea>
					   
					   <span style="color:red;"><?php echo set_error('compaign_text',$error); ?></span>
					   
					   
					  
					   
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Upload Image * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					 <input type="file" class="form-control" id="compaign_image"  name="compaign_image" />
					    <span style="color:red;"> <?php echo set_error('compaign_image',$error); ?></span>
					    
					    
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
            CKEDITOR.replace( 'compaign_text' );
</script>

<?php echo set_js_error($error); ?>