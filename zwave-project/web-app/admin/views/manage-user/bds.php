
<!-- VIEW FORMS -->
<?php

load::model('admin/bd_agents');
load::model('admin/department');
$bd_agents_model = new Bd_agents_model();
$bds=$bd_agents_model->getBdsAgentList();



?>

<?php show_flash(); ?>
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Recently Added BDs</h6>
	</div>
	<div class="card-body">
		<table class="table table-hover">
	<tr>
		<th>#</th>
		<th>BD Name</th>
		<th>Contact</th>
		<th>Email ID</th>
		<th>Department</th>
		<th>Action</th>
	</tr>
<?php foreach ($bds as $bd): ?>
	<tr>
		<td><?php echo $bd['id']; ?></td>
		<td><a href="<?php echo base_url("admin/manage-user/bds#"); ?>">
			<span>
				<i class="fa fa-user"></i> 
			</span>
			<?php echo $bd['bd_name']; ?>
			</a>
		</td>
		<td>
			<i class="fas fa-phone"></i>
			<b><?php echo $bd['contact_no']; ?></b>
		</td>
		<td>
			<a href="mailto:<?php echo $bd['email']; ?>"><b><?php echo $bd['email']; ?></b></a>
			</td>
			

		<td><?php echo Department_model::having($bd['dept_id'],'department'); ?></td>
	<td>
        <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $bd['id']; ?>">

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


<?php

ui_action('__action',
    ['base_url'=>base_url(),'end_point'=>'admin/manage-user/bds-'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
    ]);




?>


<!-- VIEW FORMS -->
