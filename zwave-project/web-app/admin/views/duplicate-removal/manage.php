<?php

?>

<?php get_flashData('message'); ?>
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Manage Duplicates</h6>
		<a href="<?php echo base_url('admin/tools/duplicate-removal/add') ;?>" class="float-right btn btn-primary"> New Upload</a>

	</div>
	<div class="card-body">
		<table class="table table-hover table-striped">
		<tr>
			<th>#</th>
			<th>Activity Date</th>
			<th>Company Name</th>
			<th>Contact Person</th>
			<th>No of Zips (Uploaded)</th>
			<th>No of Files (In Zip)</th>
			<th>Type</th>
			<th>Download (Uploaded)</th>
			<th colspan="2">Filter Data &nbsp;|&nbsp;Action</th>
		</tr>
		
		<?php foreach ($duplicates ?? [] as $duplicate): ?>
		<tr>
			<td><?php echo $duplicate['id']; ?></td>
			<td><?php echo set_dateformat('d-M-Y',$duplicate['date']); ?></td>
			<td><?php echo $duplicate['company']; ?></td>
			<td><?php echo $duplicate['contact_name']; ?></td>
			<td><span class="badge badge-success" style="font-size: 1rem;">
				<?php echo count(json_decode($duplicate['uploads'])); ?> Zip
			    </span>
	    	</td>
			<td><span class="badge badge-warning" style="font-size: 1rem;">
				<?php echo json_decode($duplicate['uploads'],true)[0]['count']; ?> Files 
			    </span>
			</td>

			<td> <span class="badge badge-info" style="font-size: 1rem;">
					<?php echo $duplicate['file_type']; ?>
			     </span>
			</td>

			<td><a href="<?php echo base_url("admin/tools/duplicate-archive-original/{$duplicate['id']}"); ?>">Download</a></td>
	
		<td>
		   <?php if($duplicate['is_processed']==0): ?>
		      <a href="<?php echo base_url("admin/tools/duplicate-process/{$duplicate['id']}"); ?>" class="btn btn-danger form-control"><b>Filter <?php echo $duplicate['file_type']; ?></b></a>
		    <?php else: ?>
		    	<span class="badge badge-success">Completed</span>
		   <?php endif?>
    	</td>
    	<td>
        <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $duplicate['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>

			 <?php if($duplicate['is_processed']==1): ?>
		     	<option value="archive">Archive</option>
		   <?php endif?>
			

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
		'archive' => 'archive/',
		
    ]);



?>

