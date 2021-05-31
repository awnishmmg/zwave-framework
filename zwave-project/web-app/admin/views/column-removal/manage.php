<?php

?>

<?php get_flashData('message'); ?>
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Manage Column Removal</h6>
		<a href="<?php echo base_url('admin/tools/column-removal/add') ;?>" class="float-right btn btn-primary"> New Upload</a>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Activity Date</th>
			<th>Company Name</th>
			<th>Contact Person</th>
			<th>No of Zips (Uploaded)</th>
			<th>No of Files (In Zip)</th>
			<th>Download (Uploaded)</th>
			<th colspan="2">Remove Columns &nbsp;|&nbsp;Action</th>
		</tr>
		<?php foreach ($columns ?? [] as $column): ?>
		<tr>
			<td><?php echo $column['id']; ?></td>
			<td><?php echo set_dateformat('d-M-Y',$column['date']); ?></td>
			<td><?php echo $column['company']; ?></td>
			<td><?php echo $column['contact_name']; ?></td>
			<td><span class="badge badge-success" style="font-size: 1rem;">
				<?php echo count(json_decode($column['uploads'])); ?> Zip
			    </span>
	    	</td>
			<td><span class="badge badge-warning" style="font-size: 1rem;">
				<?php echo json_decode($column['uploads'],true)[0]['count']; ?> Files 
			    </span>
			</td>
			<td><a href="<?php echo base_url("admin/tools/columns-archive-original/{$column['id']}"); ?>">Download</a></td>
	
		<td>
		   <?php if($column['is_processed']==0): ?>
		      <a href="<?php echo base_url("admin/tools/columns-process/{$column['id']}"); ?>" class="btn btn-danger form-control"><b>Delete From <?php echo chr($column['column_from']+64); ?> to <?php echo chr($column['column_to']+64); ?></b></a>
		    <?php else: ?>
		    	<span class="badge badge-success">Completed</span>
		   <?php endif?>
    	</td>
    	<td>
        <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $column['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>

			 <?php if($column['is_processed']==1): ?>
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
    ['base_url'=>base_url(),'end_point'=>'admin/tools/column-manage/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		'archive' => 'archive/',
		
    ]);



?>

