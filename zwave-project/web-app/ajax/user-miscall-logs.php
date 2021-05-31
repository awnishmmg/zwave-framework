<?php


?>
<table class="table table-hover mt-4">
<tr>
	<th>#</th>
	<th>Misscall Number</th>
	<th>Billing link</th>
	<th>status</th>
	<th>Action</th>
	<th>Logs</th>
</tr>
<?php foreach ($assigned_data as $assigned): ?>

	<tr>
		<td><?php echo $assigned['assigned_id']; ?></td>
		<?php
		        $no_id=$assigned['procured_no_id']; 
		        
		        $vnno=$Procured_number->getNumberDetailsById($no_id)['miscall_numbers'];
		        $prefix_code=$Procured_number->getNumberDetailsById($no_id)['prefix_code'];
		        
		        $enc_no_id = encode_64($no_id);
		 ?>
		<td><b><?php echo "+{$prefix_code}{$vnno}"; ?></b></td>
		<td><a href="<?php echo base_url("user/billing?bill_id={$assigned['billing_id']}"); ?>">Preview</a></td>
		<td><?php echo Ucfirst($assigned['status']); ?></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;">
			<option>Action</option>
			<option>Configure</option>
			<option>Unassigned</option>
			<option>All Logs</option>
		</select>
	</td>
	<td><a href="<?php echo base_url("user/miscall-logs?m_id={$enc_no_id}"); ?>"><i class="mdi mdi-file-check-outline" style="font-size:1.5rem;"></i></a></td>
	</tr>

<?php endforeach; ?>
</table>