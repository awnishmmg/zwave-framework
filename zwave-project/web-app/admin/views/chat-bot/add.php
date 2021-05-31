<?php

?>

<form action="<?php echo base_url('admin/chat-bot/create'); ?>" method="post" enctype="multipart/form-data">
		
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
					<input type="text" name="comp_username" class="form-control" required/>
				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				Company Name * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <input type="text" name="comp_name" class="form-control" required/>

				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Template Name * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="template_name" class="form-control" required/>
				</div>
		  	</div>
		</div>
		

		<div class="row">
			<div class="col-md-2">
				Compaign Date * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="date" name="compaign_date" class="form-control" required/>
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Compaign Text * : 
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<textarea name="compaign_text" class="form-control" id="compaign_text" required></textarea>
				</div>
		  	</div>
		</div>
		
		<div class="row">
			<div class="col-md-2">
				Upload Image * : 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					 <input type="file" class="form-control" id="compaign_image" name="compaign_image" required/>
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