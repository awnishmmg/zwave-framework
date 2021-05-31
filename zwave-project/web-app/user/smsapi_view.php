<?php
$session_data=Session::get('session_data');
    $user_id = $session_data['user_id'];

    load::model('user/User_sms_api');
    $sms_model = new User_Sms_api_model();
    load::model('admin/Sms_api');
    $data=$sms_model->getApiProcNumberByUserId($user_id);
    
?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header mt-0" style="background-color: white;border-top: 3px solid black;">
		<div class="row">
			<div class="col-md-10"><h5>Api Logs </h5></div>
			<div class="col-md-2">
			<a href="<?php echo base_url('user/sms-api'); ?>"><button class="btn btn-dark btn"> Add SMS API </button></a>
			</div>
		</div>
	</div>
	<div class="card-body mt-0">
	<div class="row">
	    <table class="table table-hover">
	        <tr>
	            <th>Sr.no</th>
	            <th>Number</th>
	            <th>Service</th>
	            <th>Sender Id</th>
	            <th>Username</th>
	            <th>Password</th>
	            <th>Message</th>
	            <th>Action</th>
	        </tr>
	        <?php $a=1; foreach($data as $key): ?>
	        <tr>
	            <td><?php echo $a;?></td>
	            <td><?php echo $key['miscall_numbers'];?></td>
	            <td><?php echo Sms_api_model:: getSmsNameById($key['sms_id']);?></td>
	            <td><?php echo $key['sender_id'];?></td>
	            <td><?php echo $key['acc_username'];?></td>
	            <td><?php echo $key['acc_password'];?></td>
	            <td><?php echo $key['message'];?></td>
	            <td>
	                <select class="form-control">
	                
	                    <option value="">Action</option>
	                    <option value="edit">Edit</option>
	                    <option value="delete">Delete</option>
	                    <option>More Details</option>
	                    
	                
	                </select>
	           
	           </td>
	        </tr>
	        <?php $a++; endforeach;?>
	    </table>
	    

	</div>
    
    
	</div>

</div>



