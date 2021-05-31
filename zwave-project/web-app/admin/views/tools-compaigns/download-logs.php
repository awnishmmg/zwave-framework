<?php

?>

<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>All Recents Downloads</h6>
		<a href="<?php echo base_url('admin/tools/duplicate-removal/add') ;?>" class="float-right btn btn-primary"> New Upload</a>

	</div>
	<div class="card-body">
		<table class="table table-hover table-striped">
		<tr>
			<th>#</th>
			<th>Uploaded Date</th>
			<th>File Type</th>
			<th>Processed Time</th>
			<th>No of Zip <br/>(Uploaded)</th>
			<th>No of Files <br/>(Zipped)</th>
			<th>No of Files <br/>(Processed)</th>
			<th>Errors <br/>(Occurred)</th>
			<th>Download <br/>(Log Details)</th>
			<th>Action</th>
		</tr>
		<?php foreach ($duplicates ?? [] as $duplicate): ?>
		<tr>

			<td> <?php echo $duplicate['id']; ?> </td>
			<td> <?php echo set_dateformat('d-M-Y',$duplicate['date']); ?> </td>
			<td> <span class="badge badge-primary" 
				style="font-size: 0.8rem;">	<?php echo ucfirst($duplicate['file_type']); ?> Type </span></td>

			<td> <span class="badge badge-info" style="font-size: 0.8rem;">
				<?php echo $duplicate['processed_at']; ?> </span></td>

			<td><span class="badge badge-success" style="font-size: 0.8rem;">
				<?php echo count(json_decode($duplicate['uploads'])); ?> Zip
			    </span>
	    	</td>
			<td><span class="badge badge-warning" style="font-size: 0.8rem;">
				<?php echo json_decode($duplicate['uploads'],true)[0]['count']; ?> Files 
			    </span>
			</td>

			<td><span class="badge badge-success" style="font-size: 0.8rem;">
				<?php echo count(json_decode($duplicate['logs'])); ?> txt Files
			    </span>
	    	</td>

	    	<td>
	    		<span class="badge badge-danger" style="font-size: 0.8rem;">
						No Error
			    </span>
	    	</td>

			<td> <a href="<?php echo base_url("admin/tools/duplicates-logs-download/{$duplicate['id']}"); ?>">
				<i style="font-size: 0.8rem;" class="fas fa-download"></i> Download</a></td>

		<td>
			  <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $duplicate['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			<option value="output_csv">Output CSV</option>

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
    ['base_url'=>base_url(),'end_point'=>'admin/tools/duplicate-manage/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		'output_csv' => 'output-csv/'
		
    ]);



?>

