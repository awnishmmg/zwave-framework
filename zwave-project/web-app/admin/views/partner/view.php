<?php

load::model('admin/vendor');
$vendor_model = new Vendor_model();
$vendors = $vendor_model->getAllVendors();

?>

<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	<div class="card-header">
		<h6>Channel Partners </h6>
	</div>
	<div class="card-body">
		
<a href="<?php echo base_url('admin/partners/add'); ?>"><button class="btn btn-primary">Add New</button></a>
<table class="table table-hover">
<tr>
	<th>#</th>
	<th>Channel Partner</th>
	<th>Partner Since</th>
	<th>Action</th>
</tr>
<?php foreach ($vendors as $vendor): ?>

	<tr>
		<td><?php echo $vendor['id']; ?></td>
		<td><?php echo $vendor['vendors_name']; ?></td>
		<td><?php echo $vendor['since']; ?></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;">
			<option>Action</option>
			<option>Edit</option>
			<option>Delete</option>
		</select>
	</td>
	</tr>

<?php endforeach; ?>
</table>

	</div>

</div>