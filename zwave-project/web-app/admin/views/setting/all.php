<?php

?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">

		<h5> Custom Settings* </h5>
		<hr/>
		<h4>
			<small>
					<i>These Settings can be globally Customised for user Application.</i>
			</small>
		</h4>

		<hr/>

	</div>
	<div class="card-body">
		<a href="<?php echo base_url('admin/setting/create'); ?>"  class="float-right">
			<button class="btn btn-dark mb-2">New Setting</button>
		</a>
<table class="table mt-2 table-responsive">

	<tbody style="overflow-y: scroll; height: 500px;">
		<?php foreach ($settings as $setting): ?>
	<tr>
		<td> <b><i><?php echo $setting['title']; ?></i></b> 
			<br/>
			<small class="text-danger"> <?php echo $setting['description']; ?> </small>
		</td>

		<td> <input type="text" class="form-control" 
			value="<?php echo pattern_replace("|",' | ', $setting['value']); ?>" 
			title="<?php echo pattern_replace("|",' | ', $setting['value']); ?>" readonly id="input_<?php echo $setting['id']; ?>" data-id="<?php echo $setting['id']; ?>" name="setting_value"/> 
			<small class="text-primary">
				<?php if($setting['name']=='place_holder_delimiters'):
						echo pattern_replace(",",' , ', $setting['options']);
					  else:
					  	echo pattern_replace("|",' , ', $setting['options']);
					endif;
				?> 
		    </small>
		</td>
		<td> 
			<button onclick="__action('<?php echo "input_{$setting['id']}"; ?>');" class="waves-effect waves-light btn btn-dark" data-id="<?php echo $setting['id']; ?>" 
				data-toggle="modal" data-target=".bs-example-modal-center">
				<span><i class="fa fa-edit"></i> Change </span> </button>
		</td>
	</tr>

<?php endforeach; ?>
 </tbody>

</table>

</div>
</div>

<!-- Setting Modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="myCenterModalLabel">Change Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="<?php echo base_url('admin/setting/change');?>" method="post" onsubmit="return validate(); ">
                	
                		<div class="modal-body" id="wrapper-setting">
		                     
		                </div>
	                
               </form>
            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!-- Setting Modal -->
<script type="text/javascript">

	var intial_value;

	function __action(element){

	$("#wrapper-setting").html(""); //so that Append donot works again if this is left empty then what will happen all the code fields will be Added again.

	var el = document.getElementById(element);
	var duplicate = $(el).clone();

	$("#wrapper-setting").append("<label>Enter New Value :<label>");
	$("#wrapper-setting").append(duplicate);
	$("#wrapper-setting").append("<span class='text-danger' id='setting_error'><span>");
	
	$("#wrapper-setting input[type=text] ").attr('id','duplicate_input');
	$("#duplicate_input").attr('readonly',false);

	 var setting_id = $("#duplicate_input").data('id');
	 $("#wrapper-setting").append("<input type='hidden' name='setting_id' readonly value='"+setting_id+"'>\
	 	<button type='button' \
	 	class='btn btn-danger float-right ml-2 mt-2' data-dismiss='modal' aria-hidden='false'>Cancel</button>\
	 	<input type='submit' class='btn btn-primary float-right mb-2 mt-2' value='Apply'/>\
	 	");
	
		//get the value from text box of modal and set it to the global variable so that 
		// it can used on the later purpose.
		intial_value = $("#duplicate_input").val();
	}

	function validate(){

		var status= false;

		var model_input = $("#duplicate_input");
		var new_value = model_input.val();

		if(intial_value == new_value){
			 model_input.css("border","2px solid red");
			 $("#setting_error").html('* new value is same as old value');
		}else{
				model_input.css("border","");
				$("#setting_error").html('');

				if(new_value.trim() == ""){
			  		model_input.css("border","2px solid red");
			  		$("#setting_error").html('* Field Cannot be Empty');
			    }else{
			    	$("#setting_error").html('');
			    	model_input.css("border","");
			    	status = true;
			    }
		}
		return status;
	}

</script>