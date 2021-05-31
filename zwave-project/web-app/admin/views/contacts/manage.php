

<!-- VIEW FORMS -->
<?php

?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Contacts Person List</h6>
		<a href="<?php echo base_url('admin/contacts/add') ;?>" class="float-right btn btn-primary"> Add New</a>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Action</th>
		</tr>
		<?php foreach ($contacts as $contact): ?>
		<tr>
			<td><?php echo $contact['id']; ?></td>
			<td><?php echo $contact['name']; ?></td>
			<td><?php echo $contact['email']; ?></td>
			<td><?php echo $contact['mobile']; ?></td>
			<td>
			  <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $contact['id']; ?>">

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


<?php

ui_action('__action',
    ['base_url'=>base_url(),'end_point'=>'admin/contacts/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		
    ]);




?>

