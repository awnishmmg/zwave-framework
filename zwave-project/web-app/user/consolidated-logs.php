<?php
    if(method()=='POST'):
        prx(post());
    else:
        $session_data=Session::get('session_data');
        $user_id = $session_data['user_id'];
        load::model('admin/Procured_number');
        load::model('user/User_sms_api');
        $sms_model = new User_sms_api_model();
        $Procured_number = new Procured_number_model();
        load::model('admin/Assigned_number');
        $Assigned_number = new Assigned_number_model();
        load::model('admin/Sms_api');
        $sms= new Sms_api_model();
        
        $assign_details = $Assigned_number->getAssignedNumbersByUserId($user_id);
        $number_details = $sms_model->getProcNumberByUserId($user_id);
        $services = $sms->getAllSmsApi();
    endif;
?>

<?php show_flash(); ?>
<form action="<?php echo base_url('user/consolidated-logs') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h5>Consolidated Logs</h5> 
				 <div class="row mr-2" style="text-align:center;">
				     <div class="col-md-12">
				         <b>User can Download the Log Report for offline log</b>
				     </div>
				     </div>
			</div>
		
			<div class="card-body">
			   
			    <div class="row">
			    <div class="col-md-1"></div>
			    <div class="col-md-10">
			    <div class="row form-group">
			    <div class="col-md-2"><b>Select Misscall Number *</b></div>
			    <div class="col-md-4">
			        <select class="form-control" name="vn_number">
			            <option>--Select number--</option>
			            <?php foreach($number_details as $number){ ?>
			            <option value="<?php echo $number['procured_no_id'];?>"><?php echo $number['miscall_numbers']; ?></option>
			            <?php } ?>
			        </select>
			    </div>
			</div>
			
			<div class="row form-group">
			    <div class="col-md-2"><b>Type of Logs *</b></div>
			    <div class="col-md-4">
			        <select class="form-control" name="logs_type" >
			            <option>--Select--</option>
			            <option value="misscall_logs">Misscall Logs</option>
			            <option value="delivery_logs">Audit Logs</option>
			            <option value="retrial_logs">Retrial Logs</option>
			            <option value="api_logs">API Logs</option>
			            <option value="hooks_logs">Hooks API Logs</option>
			        </select>
			    </div>
			</div>
		      <!--Start of Row-->
		    <div class="row">
		          <!--from date-->
		        <div class="col-md-6">
		             <div class="row mt-2">
			          <div class="col-md-3"><b>From Date</b></div>
			          <div class="col-md-1"></div>
			           <div class="col-md-6">
			             <input type="date" name="from_date" class="form-control" required>
			        </div>
			        <div class="col-md-2"><b>To Date</b></div>
			        </div>
                 </div>

		         <!--from date-->
		        <!--to date-->
		        <div class="col-md-6">
		             <div class="row mt-2">

			           <div class="col-md-6">
			             <input type="date" name="to_date" class="form-control" required>
			        </div>
			        </div>
		        </div>
		         <!--to date-->
  
		    </div>
		    <!--End of Row-->
		    
		 <!--   <div class="row mt-2">-->
			<!--    <div class="col-md-2"><b>Acc Username</b></div>-->
			<!--    <div class="col-md-4"><input type="text" name="username" class="form-control" required></div>-->
			<!--</div>-->

		    <div class="row mt-2">
			    <div class="col-md-2"></div>
			    <div class="col-md-4">
			        <input type="submit" name="submit" class="btn btn-dark" 
			        value="search">
			     </div>
			</div>
			
			
		    </div>
		    </div>
		    </div>
		</div>
		
</form>




