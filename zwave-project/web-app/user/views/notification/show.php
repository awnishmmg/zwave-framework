<?php

$pagination->labels('Previous','Next');

load::model('user/Account');
class_alias('Account_model','Accounts');
load::model('user/Company');
class_alias('Company_model','Company');

load::php_file('functions/user/settings');

load::model('user/Template');
class_alias('Template_model','Template');

$created_by = session::get('session_data')['user_id'];

?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>List of <?php echo count($chats_record); ?> Records </h6>
	</div>
	<div class="card-body mt-2">

<span  class="float-left">
    <select name="min_record" class="form-control form-control-sm" style="width: 100px;" id="min_record" onchange="min_records(this);">
			
			<option ><?php $records=get('records');
			                echo $page = isset($records)?$records:count($chats_record); ?></option> 
			<option >5</option>
			<option >10</option>
			<option >20</option>
			<option >50</option>
			<option >100</option>
			<option value="5">reset</option> 
			
		</select></span>
<a href="<?php echo base_url('user/notification-create'); ?>"  class="float-right col-md-1"><button class="btn btn-dark mb-2">Add New</button></a>

<table class="table mt-2 table-responsive" width="100%">
<tr>
	<th># <a href="javascript:void();">[Template-ID]</a> </th>
    <th>Link <a href="javascript:void();">[ Real URL / Short URL / Preview]</a> </th>
	<!-- <th>Company Username</th> -->
	<th style="width:15%;">Company Info <a href="javascript:void();">[ALIAS]</a> </th>
	<th style="width: 20%;text-align: center;">Template Name <br/> 
		<a href="javascript:void();">[SUBJECT TITLE]</a></th>
	<th style="width: 10%;">Scheduled Date <br/> <a href="javascript:void();">[D-Month-Y]</a> </th>
	<th>Posted On <br/> <a href="javascript:void();"> [D-Month-Y] </a></th>
	<th>Action</th>

</tr>

    <?php foreach ($chats_record as $chats): ?>

	<tr>
	    
	    <td style="background-color: black;width: 200px;">

	    	<a href="javascript:void();" style="font-size:1rem;">Template No / <?php echo $chats['id']; ?></a>
	    	<hr style="background-color: white;height: 2px;">
	    	<a href="<?php echo base_url("user/manage-integration?tmp_id={$chats['id']}&token={$chats['encrypted_id']}"); ?>" style="font-size:1rem;"><i class="fas fa-wrench" style="font-size:1.5rem;">&nbsp;</i><b> Manage Integration </b></a>

	    </td>

	    <td>
	        <textarea name="note" id="url_link_<?php echo $chats['id']; ?>" style="resize:none;border:none;color:blue;font-weight: bold;" rows="2" cols="50" readonly ><?php echo "{$chats['base_url']}?token={$chats['encrypted_id']}"; ?></textarea>
	        
    	    	<br/>
    	    <div class="row">
    	    	<div class="col-md-3">
    	      		 <a href="javascript:copyFunction('<?php echo "url_link_{$chats['id']}"; ?>');" class="btn btn-dark">	<i class="far fa-clone"></i> Copy </a>
    	        </div>
    	        <div class="col-md-4">
    	      		 <a href="javascript:void();" class="btn btn-primary"><i class="far fa-clone"></i> Tiny Url </a>
    	        </div>
    	        <div class="col-md-5">
    	       	<a href="javascript:windowPreview('<?php echo "{$chats['base_url']}?token={$chats['encrypted_id']}"; ?>');" class="btn btn-warning"><i class=" fas fa-eye">&nbsp;</i>Preview</a>
    	       </div>
    	     </div>
    	       
    	       
	    
	    </td>

		<!-- <td>
		</td> -->
		
		<td style="background-color: black;">
				<a href="javascript:void();"><i> <b> <?php echo Company::get($chats['company_name'],
				'company_name'); ?> </b> </i></a>
				<hr style="background-color: white;height: 2px;">
				<a href="javascript:void(0)"><b>
				<?php   
						echo Accounts::getAccountNameById($chats['company_username'],'accounts');		   
				?>
			  </b>
			</a>
		</td>
		
		<td align="center"> 

			<!-- Large modal -->
<button onclick="__action('<?php echo "{$chats['id']}"; ?>');" class="btn btn-warning waves-effect waves-light" data-toggle="modal" <?php if(!Template::is_configured($chats['id'],$created_by)): ?> data-target=".bs-example-modal-lg" <?php endif; ?>
	data-id="<?php echo $chats['id']; ?>" id="<?php echo "input_template_{$chats['id']}"; ?>" data-token="<?php echo $chats['encrypted_id']; ?>" title="<?php echo $chats['compaign_text'];?>"><?php echo $chats['template_name'];?></button>
			<!-- Large modal -->  

		</td>
		
			<td> <a href="javascript:void(0);" class="btn btn-dark" style="font-size:0.8rem;"> <?php echo set_dateformat('d-M-Y',$chats['compaign_date']); ?> </a> </td>
			
			<td style="text-align:center"><span class="btn btn-success" style="font-size:0.8rem;"> <b><?php 
			
			    empty($chats['created_date'])?print(" NA "):print(set_dateformat('d-M-Y',$chats['created_date']));
			
			?> </span> </b></td>
	<td>
	    
	    
		<select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="chatbot_action(this);" title="<?php echo $chats['id']; ?>">
		    
			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			<option value="more">More Details</option>
			
		</select>
	</td>
	</tr>

<?php endforeach; ?>

</table>

<!-- Parsed Template Modal -->
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;margin-top: 10px;">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="myLargeModalLabel">Configure Template</h5>

	           <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
	        </div>
	        <div class="modal-body" style="overflow-y: scroll;height: 500px;">
	          
	           <form action="<?php echo base_url('user/configure-template'); ?>" method="post" >

<!-- Row One -->
	   			<div class="row">
						<div class="col-md-3">
							<b>Token No * :</b>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							    
							    <input type="text" id="modal_token" name="modal_token" class="form-control" readonly />
							     
							     <input type="hidden" id="modal_hidden" class="form-control" name="modal_hidden" readonly/>

							</div>
		  			   </div>
		          </div>
<!-- Row One -->

<!-- Row One -->
	   			<div class="row">
						<div class="col-md-3">
							<b>Has Placeholder * :</b>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							    
							    <select type="text" id="modal_placeholder" name="modal_placeholder" class="form-control"/>
								    <option>select</option>

								    <option value="1">Yes</option>
								    <option value="0">No</option>							    
								</select>

							</div>
		  			   </div>
		          </div>
<!-- Row One -->

<!-- Row One -->
	   			<div class="row">
						<div class="col-md-3">
							<b>Select Variable * :</b>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							    
							    <select type="text" id="modal_variable" name="modal_variable" class="form-control" onchange="set_variable(this);" />

								    <option>select</option>
									<?php  
											$options = explode(',',setting_delimiter(2));
									    	if(count($options) > 0): 
									    			foreach($options as $index => $option):
									?>
										<option><?php echo $option; ?></option>	
								     <?php endforeach; ?>
								    <?php endif; ?>							    
							</select>

							</div>
		  			   </div>
		          </div>
<!-- Row One -->

<!-- Row One -->
	   			<div class="row">
						<div class="col-md-3">
							<b>Template Text* :</b>
						</div>
						<div class="col-md-9">
							<div class="form-group">
							    
					<textarea id="modal_text" name="modal_text" class="form-control" rows="10" style="border-top: 20px solid silver;"></textarea>
							
							</div>
		  			   </div>
		          </div>
<!-- Row One -->


<!-- Row One -->
<div id="more-container">
	<!-- More Container Open -->
	<div class="row">
						<div class="col-md-3">
							<b>Define Variable*: </b>
						</div>

						<div class="col-md-3">
							<div class="form-group">
					           <input type="text" id="modal_key" name="modal_key[]" class="form-control modal_key" placeholder=" Variable Key Name " />
							</div>
		  			   </div>

		  			   <div class="col-md-3">
							<div class="form-group">
					         <input type="text" id="modal_value" name="modal_value[]" class="form-control modal_value" placeholder="Variable Parameter"/>
							</div>
		  			   </div>

		  			   <div class="col-md-3">
							<div class="form-group">

					           <button type="button" id="modal_btn_add" name="modal_btn_add" 
					           class="btn btn-success">Add More</button>

							</div>
		  			   </div>

		          </div>


	<!-- More Container Close -->
</div>
	   			
<!-- Row One -->


<!-- Row One -->
	   			<div class="row">
						<div class="col-md-3">
							<b>HTTP REQUEST * :</b>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							    
							    <select type="text" id="modal_http" name="modal_http" class="form-control"/>
								    <option>select</option>

								    <option>GET</option>
								    <option>POST</option>							    
								</select>

							</div>
		  			   </div>
		          </div>
<!-- Row One -->

<!-- Row One -->
<div class="row">
	<div class="col-md-3">
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<input type="submit" id="submit" name="submit" class="form-control btn btn-primary"/>
		</div>
	</div>

</div>
<!-- Row One -->

 </form>
<!-- Extra Div -->
<div id="copy" style="display: none;">
	<!-- More Container Open -->
	<div class="row parent_more">
						<div class="col-md-3">
							<b></b>
						</div>

						<div class="col-md-3">
							<div class="form-group">
					           <input type="text" name="modal_key[]" class="form-control modal_key" placeholder=" Variable Key Name " />
							</div>
		  			   </div>

		  			   <div class="col-md-3">
							<div class="form-group">
					         <input type="text" name="modal_value[]" class="form-control modal_value"placeholder="Variable Parameter"/>
							</div>
		  			   </div>

		  			   <div class="col-md-3">
							<div class="form-group">

					           <button type="button" id="modal_btn_remove" name="modal_btn_remove" 
					           class="btn btn-danger modal_btn_remove">Remove</button>

							</div>
		  			   </div>

		          </div>


	<!-- More Container Close -->
</div>
<!-- Extra Div -->


	        </div>
	    </div>	<!-- modal-content -->
	</div>	<!--modal-dialog -->
</div>	<!--modal -->

<!-- Parsed Template Modal -->
<!-- Modal for Showing Template Configuration -->

<!-- Modal for Showing Template Configuration -->

 <?php if(count($chats_record)>0): ?> <span class="float-right"><?php $pagination->render();?> </span> <?php endif; ?>
</div>

<!-- Context Menu -->
<!-- Context Menu -->


<!-- Script Tag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!-- Script Tag -->
<script>

   var base_url = "<?php echo base_url(); ?>";
   base_url = base_url + 'user/notification-';
   
   function chatbot_action(obj){
      var option = obj.value;
      switch(option){

          case 'edit': 
              uri = 'edit?id='+obj.title;
          break;

          case 'delete': 
              uri = 'delete?id='+obj.title;
          break;

          case 'more': 
              uri = 'more?id='+obj.title;
          break;
          
          default:
          break;
      }
      
      window.location.href=base_url+uri;
   }
   
   var current_url = "<?php echo base_url('user/notification-manage?') ?>";
   function min_records(element){
       var pages = element.value;
        window.location.href=current_url+"&records="+pages;
   }
   
// Copy function

function copyFunction(element_name) {
            
      var copyText = document.getElementById(element_name);
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
}
// Copy function

function __action(id){

 var target_element = $('#input_template_'+id).data('target');
if(typeof(target_element)=="undefined"){
	swal("Template Is Already Configured","[goto]/[Manage Integration]/[Meta Information & Access settings]/[Reset setting]/Reset ");
	return false;
}


 var current_element = document.getElementById('input_template_'+id);
 var token = $(current_element).data('token');
 var new_template = $(current_element).data('template_name');
 var modal_text = $(current_element).attr('title');
 //set on the modal form
 $("#modal_token").val(token);

 $("#modal_hidden").val(id);
 // insertIntoCkeditor(modal_text);
 $("#modal_text").append(modal_text);
}

function windowPreview(url){
	window.open(url,'Preview of Chatbot','fullscreen=yes');
}

// function insertIntoCkeditor(str){
//     CKEDITOR.instances['modal_text'].setData(str);
// }

// Create the Add More Logic
</script>

<script>

    //   CKEDITOR.replace('modal_text',{
    //   // Pressing Enter will create a new <div> element.
    //   enterMode: CKEDITOR.ENTER_DIV,
    //   // Pressing Shift+Enter will create a new <p> element.
    //   shiftEnterMode: CKEDITOR.ENTER_P
    // });
      
</script>

<script type="text/javascript">

	$(document).ready(function(){
		var html = $("#copy").html();
		
	$("#modal_btn_add").on("click",function(){
		$("#more-container").append(html);
		$("#more-container .modal_key").val($("#modal_key").val());
		$("#more-container .modal_value").val($("#modal_value").val());
	});

	$(document).on("click",".modal_btn_remove",function(){
		$(this).parents('.parent_more').remove();
	})

	});


// Automcatically set the variable value to Variable
function set_variable(element){
	var modal_variable = element.value;
	if(modal_variable == ""){

		$("#modal_key").val("");
	}else{
		$("#modal_key").val(modal_variable);
	}
	
}
</script>

   
