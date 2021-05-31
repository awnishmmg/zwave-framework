<?php 
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

$error="";
if(method()=='POST'):
    $submit_btn = post('submit');

    if(isset($submit_btn) and !empty($submit_btn)):
        
    //load::model('user/Sms_api');
    //$login = new Sms_api_model();
    $formdata['user_id'] = $session_data['user_id'];
    $formdata['number'] = $_POST['number'];
    $formdata['service'] = $_POST['service'];
    $formdata['senderid'] = $_POST['senderid'];
    $formdata['username'] = $_POST['username'];
    $formdata['password'] = $_POST['password'];
    $formdata['message'] = $_POST['message'];
    
    $res=$sms_model->addSmsApi($formdata);
    if($res){
        set_flash('msg','inserted',[
                        'inserted'=>alert_success(" {$GLOBALS['success']} Data Added Successfully"),
                    ]);
    }else{
        set_flash('msg','not-inserted',[
                        'not-inseted'=>alert_danger(" {$GLOBALS['success']} Something went wrong.. Please try again"),
                    ]);
    }
    endif;
endif;
?>

<?php show_flash(); ?>
<form action="<?php echo base_url('user/sms-api') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h5>Sms Api</h5> 
			</div>
			<div class="card-body">
			    <div class="row">
			    <div class="col-md-1"></div>
			    <div class="col-md-10">
			    <div class="row form-group">
			    <div class="col-md-2"><b>Misscall Number *</b></div>
			    <div class="col-md-4">
			        <select class="form-control" name="number">
			            <option>--Select number--</option>
			            <?php foreach($number_details as $number){ ?>
			            <option value="<?php echo $number['procured_no_id'];?>"><?php echo $number['miscall_numbers']; ?></option>
			            <?php } ?>
			        </select>
			    </div>
			</div>
			
			<div class="row form-group">
			    <div class="col-md-2"><b>SMS Service *</b></div>
			    <div class="col-md-4">
			        <select class="form-control" name="service">
			            <option>--Select--</option>
			            <?php foreach($services as $service){ ?>
			            <option value="<?php echo $service['id'];?>"><?php echo $service['api_name']; ?></option>
			            <?php } ?>
			        </select>
			    </div>
			</div>
		     
		    
		    <div class="row mt-2">
			    <div class="col-md-2"><b>Sender ID *</b></div>
			    <div class="col-md-4">
			        <input type="text" name="senderid" class="form-control" required>
			        <small> Don`t have Way2mint Account <a href="https://way2mint.com"> Create New or Request One</a> </small>  
			        </div>
			</div>
		    
		    
		    <div class="row mt-2">
			    <div class="col-md-2"><b>Acc Username</b></div>
			    <div class="col-md-4"><input type="text" name="username" class="form-control" required></div>
			</div>
			
			<div class="row mt-2">
			    <div class="col-md-2"><b>Acc Password</b></div>
			    <div class="col-md-4"><input type="text" name="password" class="form-control" required></div>
			</div>
			
			<div class="row mt-2">
			    <div class="col-md-2"><b>Message</b></div>
			    <div class="col-md-4"><textarea name="message" class="form-control" required></textarea>
			    </div>
			    <div class="col-md-4">
			       <i> According to new Rules and Regulation of TRAI Each message has to be approved by a Template ID No Messsage will be delivered if Template ID is not Approved.</i>
			    </div>
			    
			</div>
		    
		    
		    <div class="row mt-2">
			    <div class="col-md-2"></div>
			    <div class="col-md-4">
			        <input type="submit" name="submit" class="btn btn-dark" 
			        value="Submit">
			     </div>
			</div>
			
			
		    </div>
		    </div>
		    </div>
		</div>
		
</form>



