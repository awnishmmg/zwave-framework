<?php



//$user_id=Session::get('session_data')['user_id'];
load::model('common/Hooks');

$hooks = new Hooks_model();
$hooks_data = $hooks->getAllHooksData();

?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header mt-0" style="background-color: white;border-top: 3px solid black;">
		<div class="row">
			<div class="col-md-10"><h5>All Miscall Logs</h5></div>
			<div class="col-md-2">
			<a href="<?php echo base_url('admin/uploads/misscall-logs'); ?>"><button class="btn btn-dark">Refresh</button></a>
			</div>
		</div>
	</div>
	<div class="card-body mt-0">
<table class="table table-hover mt-4 table-responsive table-borderless table-sm" >
<tr class="mt-4">
    	<th>Sr No.</th>
    	<th>Misscall Number</th>
    	<th>Client IP</th>
    	<th>Caller ID</th>
    	<th>Pulse Start At</th>
    	<th>Pulse Drop At</th>
    	<th>Call Type</th>
    	<th>Date</th>
    	<th>Time</th>
    	<th>Action</th>
    	<th>View More</th>
</tr>	
<?php if(count($hooks_data)>0): ?>
<?php $i=1; foreach($hooks_data as $hooks): ?>
<tr>
    <td><?php echo $i; ?></td>
    <td><a href="javascript:void(0);"><?php echo $hooks['dispnumber']; ?></a></td>
    <td><?php echo $hooks['client_ip']; ?></td>
    <td><a href="javascript:void();"><?php echo $hooks['caller_id']; ?></a></td>
    <td><?php echo $hooks['start_time']; ?></td>
    <td><?php echo $hooks['end_time']; ?></td>
    <td><?php echo $hooks['type']; ?></td>
    <td><?php echo $hooks['date']; ?></td>
    <td><?php echo $hooks['time']; ?></td>
	<td>
		
		<select name="action" class="form-control form-control-sm" style="width: 100px;">
    			<option>Action</option>
    			<option>Deleted</option>
    			<option>Archived</option>
    			<option>Report</option>
		</select>
		
	</td>
	<td><a  href="#" onclick="javascript:view_more(event,'<?php echo $i; ?>');" data-hooks_id="<?php echo $hooks['hooks_id']; ?>" id="more_details_<?php echo $i;?>" ?><i class="ion ion-ios-more" style="font-size:2rem;"></i></a></td>
	
	<tr id="collapse_heading<?php echo $i?>" style="display:none;background-color:black;color:white;" >
	        
	        <th colspan="3">API URL</th> 

	   
	        <th>Send ID Used</th> 

	   
	        <th>Password Used</th> 

	   
	        <th colspan="3">Message Used</th> 

	   
	        <th>Sent To</th> 

	   
	        <th>Delivery Status</th> 

	   
	        <th>Retry Session</th> 


    </tr>
    
    <tr id="collapse_data<?php echo $i?>" style="display:none;background-color:yellow;">
	        
	        <td colspan="3">Https://Way2mint.com</td>
	   

	        <td>Https://Way2mint.com</td>
	   

	        <td>Https://Way2mint.com</td>

	        <td colspan="3">Thank for Registering with Sephore Brand</td>
	   
 
	        <td>Https://Way2mint.com</td>
	   

	        <td>Https://Way2mint.com</td>
	   

	        <td>Yes/No</td>

    </tr>
	</tr>
<?php $i++; endforeach; ?>

<?php else: ?>
    <tr>
        <td colspan="4"></td>
        <th>No Record Found</th>
        <td colspan="6"></td>
    </tr>
<?php endif; ?>
</table>

	</div>

</div>