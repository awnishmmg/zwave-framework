
<form action="<?php echo base_url('admin/department/add') ;?>" method="post" >
		
		<div class="card">
			<div class="card-header" style="background-color: white;border-top: 3px solid black;">
				<h6>Department Section</h6> 
			</div>
			<div class="card-body">
			<div class="row">
			<div class="col-md-2">
				Department Name * :
				</div>
			<div class="col-md-4">
				<div class="form-group">
				 <input type="text" name="dept_name" class="form-control" /><?php show_flash('dept_name')?>
			</div>
		  	</div>
		</div>
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-1">
				<input type="submit" name="dept_btn" value="Add" class="btn btn-primary">
			</div>
		</div>
		
			</div>
		
		</div>
		
</form>

<!-- VIEW FORMS -->
<?php

load::model('admin/department');
$department_model = new Department_model();
$departments=$department_model->getAllDepartment();


?>

<?php show_flash(); ?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Department List</h6>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Department</th>
			<th>Action</th>
		</tr>
		<?php foreach ($departments as $department): ?>
		<tr>
			<td><?php echo $department['id']; ?></td>
			<td><?php echo $department['department']; ?></td>
			<td>
			  <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $department['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			<option value="more">More Details</option>

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
    ['base_url'=>base_url(),'end_point'=>'admin/department/manage/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		'more' => 'more/',
    ]);




?>

