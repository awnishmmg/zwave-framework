<?php



?>
<div class="card">
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h6>Manage Excel Conversion</h6>
		<a href="<?php echo base_url('admin/tools/xls-converter') ;?>" class="float-right btn btn-primary"> New Upload</a>

	</div>
	<div class="card-body">
		<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Activity Date</th>
			<th>Uploaded Time</th>
			<th>Types of Conversion</th>
			<th>Company Name</th>
			<th>Contact Person</th>
			<th>No of Files (Uploaded)</th>
			<th>Download (Uploaded)</th>
			<th colspan="2">Process&nbsp;|&nbsp;Action</th>
		</tr>
		<?php foreach ($uploads ?? [] as $upload): ?>
		<tr>
			<td><?php echo $upload['id']; ?></td>
			<td><?php echo $upload['date']; ?></td>
			<td><span class="badge badge-info">
				<?php echo $upload['uploaded_at']; ?></span>
			</td>
			<td><?php echo $upload['conversion_type']; ?></td>
			<td><?php echo $upload['company']; ?></td>
			<td><?php echo $upload['contact_name']; ?></td>
			<td>
			<?php 

			if($upload['conversion_type']=='zip_to_csv'):
				$count=json_decode($upload['uploads'],true)[0]['count'];
				echo count(json_decode($upload['uploads']))." Zip and {$count} Files";
			else:
				echo count(json_decode($upload['uploads']))." Files";
			endif;
			


			?></td>
			<td><a href="<?php echo base_url("admin/tools/xls-archive-original/{$upload['id']}"); ?>">Download</a></td>
	
		<td>
		   <?php if($upload['is_processed']==0): ?>
		      <a href="<?php echo base_url("admin/tools/xls-process/{$upload['id']}"); ?>" class="btn btn-success form-control">Process</a>
		    <?php else: ?>
		    	<span class="badge badge-success">Completed</span>
		   <?php endif?>
    	</td>
    	<td>
        <select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="__action(this);" title="<?php echo $upload['id']; ?>">

			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>

			 <?php if($upload['is_processed']==1): ?>
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

if($action=='manage'):

ui_action('__action',
    ['base_url'=>base_url(),'end_point'=>'admin/tools/xls-manage/'],
    
    [

		'edit' => 'edit/',
		'delete' => 'delete/',
		'archive' => 'archive/',
		
    ]);

endif;

?>

