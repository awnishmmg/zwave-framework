<?php

?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>All Recents Downloads</h6>
		<a href="<?php echo base_url('admin/tools/column-removal/add') ;?>" class="float-right btn btn-primary"> New Upload</a>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>Type</th>
			<th>Activity</th>
			<th>File Name</th>
			<th>Details</th>
			<th>Download</th>
			<th>Action</th>
		</tr>
		<?php foreach ($downloads ?? [] as $download): ?>
		<tr>

			<td> <?php echo $download['id']; ?> </td>
			<td> <?php echo set_dateformat('d-M-Y',$download['date']); ?> </td>
			<td> <span class="badge badge-warning" ><?php echo $download['type']; ?></span></td>
			<td> File Downloaded at <span class="badge badge-info"><?php echo $download['time']; ?> </span></td>
			<td> <?php echo basename($download['downloaded_path']); ?> </td>
			<td> <a href="javascript:void();"><i style="font-size: 1.9rem;" class="ion ion-ios-more"></i></a> </td>
			<td> <a href="<?php echo base_url($download['downloaded_path']); ?>">
				<i style="font-size: 1.0rem;" class="fas fa-download"></i></a></td>

		<td>
			  <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $download['id']; ?>">

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
    ['base_url'=>base_url(),'end_point'=>'admin/tools/column-downloads/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		
    ]);



?>

