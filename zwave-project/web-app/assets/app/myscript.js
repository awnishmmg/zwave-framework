// Application Js Script

$(document).ready(function(){

	$("#admin-add-new-permission").html("<span class='badge badge-success'> Select Role for Permission </span>");
	$("#admin-add-new-role").on("change",function(){
		// window.alert($(this).val());
		var role_id = $(this).val();
		if(role_id==""){
			$("#admin-add-new-permission").html("<span class='badge badge-danger'>Role Required </span>");
			return false;
		}
		$.ajax({
			url:"ajax/role-menu.php",
			type:"POST",
			data:{
				roleid:role_id
			},
			success:function(response){
				// console.log(response);
				$("#admin-add-new-permission").html(response);
			}
		});

	});

});


$(document).ready(function(){
	$(".admin-assign-radio").on("click",function(){
		var billing=$(this).val();
		if(billing!="no"){
			$("#admin-assign-billing").show(500);
		}else{
			$("#admin-assign-billing").hide(500);
		}
	});

	$("#admin-assign-need_hlr").on("change",function(){
		var need_hlr = $(this).val();
		if(need_hlr=="yes"){
			$("#admin-assign-hlr-cost").fadeIn(500);
		}else{
			$("#admin-assign-hlr-cost").fadeOut(500);
		}
	});
});



function getContacts(){
		var user_id = $("#company").val();
		console.log(user_id);
					$.ajax({
				url:site_url+"ajax/admin/get/contacts",
				type:"POST",
				data:{
					uuserid:user_id,
				},
				beforeSend:function(){
					console.log('Send....');
				},
				completed:function(){
					
				},
				success:function(response){
					// console.log(response);
					var Optionstext = $( "#company option:selected" ).text();

					if(response.response_code==201 && response.status==false){
						$("#company").css("border","4px solid red");
						$("#spn-company-error").css("color","red");
						$("#spn-company-error").html("<b>"+response.comments+" Contacts for "+Optionstext+"</b>");
						$("#contact").html("<option value=''>--select--</option>\n");
					}else{
						$("#company").css("border","4px solid green");
						$("#spn-company-error").css("color","green");

						$("#spn-company-error").html("&#9989; Contacts Found in "+Optionstext+" Company ");

						$("#contact").html(response);
					}
					
				}
			});

}


// Add Contact using Ajax
$(document).ready(function(){
	
	$("#modal_btn").click(function(){

		var user_id = $("#company").val();
		console.log(user_id);

		$("#m-name-error").remove();
		$("#m-email-error").remove()
		$("#m-mobile-error").remove()
		
		var input_name = $("#modal_name");
		var input_email = $("#modal_email");
		var input_mobile_no = $("#modal_mobile");

		var name = input_name.val();
		var email = input_email.val();
		var mobileno = input_mobile_no.val();
		var counter = 0;

		if(name==""){
			$(input_name).after("<span style='color:red' id='m-name-error'>Name is Required</>");
			counter++;
		}

		if(email==""){
			$(input_email).after("<span style='color:red' id='m-email-error'>Email is Required</>");
			counter++;
		}

		if(mobileno==""){
			$(input_mobile_no).after("<span style='color:red' id='m-mobile-error'>Mobile is Required</>");
			counter++;
		}

		if(counter==0){
			$.ajax({
				url:site_url+"ajax/admin/create/contact",
				type:"POST",
				data:{
					uname:name,
					uemail:email,
					umobile:mobileno,
					uuserid:user_id,
				},
				beforeSend:function(){
					console.log('Send....');
				},
				completed:function(){
					
				},
				success:function(response){
					if(response.response_code==200 && response.status==true){
						swal("success",response.comments,"success");
						$("#close-modal").click();
						getContacts();

					}else{
						swal("success",response.comments,"success");
					}
				}
			});
		}

	});
});


//Conversion Type

function getConversions(){

	var conversion = $("#conversion_type").val();
	var uploadsfield = $("#append_upload");
	console.log(conversion);
	uploadsfield.html(csvs);

    switch(conversion){

    	case 'zip_to_csv':
    	 	var zips = $("#zip_multiple").html();
    	 	console.log(zips);
    	 	uploadsfield.html(zips);
    	break;

    	case 'xls_to_csv':
    		var excels = $("#excel_multiple").html();
    		console.log(excels);
    		uploadsfield.html(excels);
    	break;

    	case 'csv_to_xls':
    		var csvs = $("#csv_multiple").html();
    		console.log(csvs);
    		uploadsfield.html(csvs);
    	break;

    	case '':
    		uploadsfield.html("");
    	break;

    }



}
