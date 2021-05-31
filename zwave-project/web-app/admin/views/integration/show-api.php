
<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	
<div class="card-header">
	<h6>All SMS Integrations</h6>
</div>
<div class="card-body">
	<a href="<?php echo base_url('admin/integration/sms-api'); ?>">
	    <button class="btn btn-primary">Add API</button>
	 </a>

<table class="table table-hover">
<tr>

	<th>Sr No.</th>
	<th>Api Name</th>
	<th>Base Url</th>
	<th>Api Parameters</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php $i=1; ?>
<?php if(count($sms_data)>0): ?>
<?php foreach ($sms_data as $sms): ?>

	<tr>
	    
	    <td><?php echo $i; ?></td>
		<td><?php echo $sms['api_name']; ?></td>
		<td><?php echo $sms['base_url']; ?></td>
		<td><?php echo $sms['api_params']; ?></td>
		<td><?php echo $sms['status']; ?></td>
	
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;">
				<option>Action</option>
				<option>More Details</option>
				<option>Edit</option>
				<option>Delete</option>
		</select>
	</td>
	</tr>

<?php $i++; endforeach; ?>
<?php else:?>
	<tr>
		<td colspan="3"></td>
		<td>No Record Found</td>
	</tr>
<?php endif;?>
</table>





</div>
</div>



