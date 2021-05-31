<?php

?>

<?php show_flash(); ?>
<form action="<?php echo base_url('user/accounts-create'); ?>" method="post" >
<div class="card">
	
<div class="card-header" style="background-color: white;border-top: 3px solid black;">
	<h6>Add Accounts </h6>
</div>

<div class="card-body">
<div class="row">
	<div class="col-md-2">
		<b>Account Name :* </b>
	</div>
	<div class="col-md-4">
		<div class="form-group">

		 <input type="text" id="accounts" name="accounts" class="form-control" value="" />

		</div>
  	</div>
</div>


		<div class="row">
			<div class="col-md-2">
				<b>Activate Account *</b> 

			</div>
			<div class="col-md-4">
				<div class="form-group">	

				<select class="form-control" name="status" id="status" class="form-control">
								<option value="">--Select--</option>
								<option value="active">Yes</option>
								<option value="inactive">No</option>
				</select>

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


<!-- Account Show Data -->

<!-- VIEW FORMS -->
<?php

$session_data = Session::get('session_data');
$user_id = $session_data['user_id'];

load::model('user/Account');
$accounts_model = new Account_model();
$accounts = $accounts_model->getAccountsByUserId($user_id);

?>

<?php //show_flash(); ?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Linked Accounts</h6>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Account Name</th>
			<th>Company</th>
			<th style="text-align: center;">Action</th>

		</tr>
		<?php foreach ($accounts as $account): ?>
		<tr>
			<td><b><?php echo $account['id']; ?></b></td>
			<td><b><?php echo $account['accounts']; ?></b></td>

			<td style="width: 20%;">
				<div class="row">
					<div class="col-md-6">
				<button onclick="add_modal(this);" style="font-size:1.0rem;font-weight: bold;" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModalAdd" data-id="<?php echo $account['id']; ?>" data-accounts="<?php echo $account['accounts']; ?>">
					<i class="fas fa-building"></i> Add </button>
				</div>
				<div class="col-md-6">
				<button onclick="view_modal(this);" style="font-size:1.0rem;font-weight: bold;" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#myModalview" data-id="<?php echo $account['id']; ?>" data-accounts="<?php echo $account['accounts']; ?>">
					<i class="fas fa-bookmark" ></i> View </button> 
				</div>
				</div>
			</td>

		<td align="center">

			  <select name="action" class="form-control form-control-sm" style="width: 100px;" 
			  id="action" onchange="__action(this);" title="<?php echo $account['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			

        </select>
		</td>

		</tr>
		
		<?php endforeach; ?>
		</table>

	</div>
</div>

<!-- VIEW FORMS -->

<!-- Modal Forms -->
<!-- Modal Form of Add -->
<!-- sample modal content -->
    <div id="myModalAdd" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    
<form method="post">	
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Fill Company Details</h6>
	</div>

	<div class="card-body">

		<div class="row">
			<div class="col-md-4">
				<b>Account Name *</b>
			</div>

			<div class="col-md-8">
				<div class="form-group">
			    <input id="add-modal-header" class="form-control"
			    name="m_account_name" readonly />

				</div>
		  	</div>
		</div>
	
		<div class="row">
			<div class="col-md-4">
				<b>Company Name or (Alias) * </b>
			</div>
			<div class="col-md-8">
				<div class="form-group">

				 <input type="text" id="m_company_name" name="m_company_name" 
				 class="form-control addcompany-modal" value="" />

				</div>
		  	</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<b>Company Type *</b> 

			</div>

			<div class="col-md-8">
			<div class="form-group">	

			<select class="form-control" name="m_company_type" id="m_company_type" 
			class="form-control addcompany-modal">
				<option value="">--Select--</option>
				<option value="parent">Parent</option>
				<option value="child">Child</option>
			</select>

			</div>
		  	</div>
		</div>


		<div class="row">
			<div class="col-md-4">
				<b>Company Status *</b> 

			</div>
			<div class="col-md-8">
				<div class="form-group">	

				<select class="form-control" name="m_status" id="m_status" class="form-control addcompany-modal">
								<option value="">--Select--</option>
								<option value="active">Yes</option>
								<option value="inactive">No</option>
				</select>

				</div>
		  	</div>
		</div>

			
	</div>
</div>


</div>
	<div class="modal-footer">
	    <button type="button" id="add-modal-close-btn" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
	    <button type="button" onclick="submit_add_modal();" class="btn btn-primary waves-effect waves-light">Add</button>
	</div>
</form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- Modal Form of Add -->

<!-- Modal Form of View -->

<!-- sample modal content -->
    <div id="myModalview" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">All Companies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

             <div class="row">
				<div class="col-md-4">
					<b>Account Name *</b>
				</div>
				<div class="col-md-8">
					<div class="form-group">

				    <input id="view-modal-header" class="form-control"
				    name="m_account_name" readonly />

					</div>
			  	</div>
			</div>
			<!-- Ajax Table Will Binded Here -->
				<div id="view_modal_company" style="overflow-y:scroll;height:250px;">
					

				</div>
             <!-- Ajax Table Will Binded Here -->      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal"
                     id="modal_view_close_btn">Close</button>

                    <button type="button" onclick="delete_company(this);" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- Modal Form of View -->
<!-- Modal Forms -->

<?php

ui_action('__action',
    ['base_url'=>base_url(),'end_point'=>'user/accounts-action?'],
    
    [
		'edit' => 'do=edit&id=',
		'delete' => 'do=delete&id=',
    ]);

?>
<script type="text/javascript">

	var checked_ids = [];
	function select_checkbox(element){
		checked_ids = [];
		if($(element).is(":checked")){
			// console.log("checked");

			$(element).attr('checked',true); //Current Element Should be Checked
			$(".checkbox").attr('checked',true); //Make Other Chechbox also checked

			$(".checkbox").each(function(){
				checked_ids.push($(this).val());
			});

		}else{
			// console.log("Unchecked");
			$(element).attr('checked',false); //Current Element Should not be Checked
			$(".checkbox").attr('checked',false); //Make Other Chechbox also checked
		}
		
	}

	// Single Select
	function single_select(element){
		if($(element).is(":checked")){
			checked_ids.push($(element).val());
		}else{
			checked_ids.pop();
		}
	}

	function delete_company(element){
		//Print the ID`s
		var uniqueIds = [];
		$.each(checked_ids, function(i, el){
		    if($.inArray(el, uniqueIds) === -1) uniqueIds.push(el);
		});

		// if(checked_ids.length>0){
		// 	// console.log(checked_ids);	
		// 	var check_list = checked_ids.join(",");
		// 	console.log(check_list);
		// }

		if(uniqueIds.length>0){
			// console.log(checked_ids);	
			var check_list = uniqueIds.join(",");
			console.log(check_list);
			$.ajax({
				url:site_url+"ajax/user/company/delete",
				type:"POST",
				data:{company_ids:check_list},
				success:function(response){
					if(response.response_code==200 && response.status==true){
						// alert('Record Deleted');
						swal("Success", response.comments, "success");
					 	$("#modal_view_close_btn").click();

					}else{
						// alert('Cannot Deleted Record Deleted');
						swal("OOps", response.comments, "danger");
					 	
					}
				}
			});
		}
	}

</script>

<script type="text/javascript">
	function add_modal(element){
		
		$(".addcompany-modal").each(function(){

			if($(this).attr("type")=="text"){
				$(this).val("");
			}
		});

		//unset the company type select Box
		$("#m_company_type").html("");
		
		$("#m_company_type").html('<option value="">--Select--</option>\
				<option value="parent">Parent</option>\
				<option value="child">Child</option>');

		//unset the company status select Box
		$("#m_status").html("");

		$("#m_status").html('<option value="">--Select--</option>\
			<option value="active">Yes</option>\
			<option value="inactive">No</option>');



		var account_name = $(element).data("accounts");
		var account_id = $(element).data("id");
		$("#add-modal-header").val(account_name);
		$("#add-modal-header").attr("data-id",account_id);
	}


	function view_modal(element){
		checked_ids = [];

		var account_name = $(element).data("accounts");
		var account_id = $(element).data("id");
		var user_id = "<?php echo session::get('session_data')['user_id']; ?>";
		// alert(user_id);

		$("#view-modal-header").val(account_name);
		$("#view-modal-header").attr("data-id",account_id);
			$.ajax({
			 	url:site_url+'ajax/user/company/get',

			 	type:"POST",
			 	data:{

			 		userid:user_id,
			 		accountid:account_id,
			 	},
			 	success:function(response){
			 		$("#view_modal_company").html(response);
			 	}
			 });
	}

	function submit_add_modal(){

		//Field set
		var account_input = $("#add-modal-header");
		var company_input = $("#m_company_name");
		var company_type_input = $("#m_company_type");
		var status_input = $("#m_status");

		// Field value
		var account_id = account_input.data('id');
		var company_name = company_input.val();
		var company_type = company_type_input.val();
		var status = status_input.val();

		// console.log("Account Id="+account_id);
		// console.log("Company Name ="+company_name);
		// console.log("Company Type="+company_type);
		// console.log("Status ="+status);

		if(company_name==""){
			company_input.css("border","2px solid red");
		}else{
			company_input.css("border","");
			if(company_type==""){
				company_type_input.css("border","2px solid red");
			}else{
				company_type_input.css("border","");
				if(status==""){
					status_input.css("border","2px solid red");
				}else{
					status_input.css("border","");
					 $.ajax({
					 	url:site_url+'ajax/user/company/add',
					 	type:"POST",
					 	data:{

					 		id:account_id,
					 		cname:company_name,
					 		ctype:company_type,
					 		cstatus:status
					 	},
					 	success:function(response){
					 		if(response.response_code==200 && response.status==true ){
					 			// window.alert(response.comments);
					 			swal("Success", response.comments, "success");
					 			$("#add-modal-close-btn").click();
					 		}else{
					 			swal("OOps", "Error Adding Record", "danger");
					 			// window.alert("Error Adding the Record");
					 		}
					 	}
					 });
				}
			}
		}
		
	}
</script>


<!-- Account Show Data -->
