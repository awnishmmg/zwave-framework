<?php

load::model('upload');
$upload_model = new upload_model();
$uploads = $upload_model->getAllUploads();

?>

<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	
<div class="card-header">
	<h6>Uploaded Logs</h6>
</div>
<div class="card-body">
	<a href="<?php echo base_url('admin/raw-uploads'); ?>"><button class="btn btn-primary">Upload More</button></a>

<table class="table table-hover">
<tr>

	<th>File Name</th>
	<th>Date</th>
	<th>Time</th>
	<th>Uploaded</th>
	<th>Imported</th>
	<th>Action</th>
</tr>
<?php if(count($uploads)>0): ?>
<?php foreach ($uploads as $upload): ?>

	<tr>
		<td><?php echo "{$upload['file_name']}.{$upload['extension']}"; ?></td>
		<td><?php echo $upload['date']; ?></td>
		<td><?php echo $upload['time']; ?></td>
		<td><?php 

		if(in_array($upload['status'], ['uploaded','imported'])){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="assets/images/tick.png" height="24">';
		}

		?></td>
		<td><?php 


		if($upload['status']=='imported'){
			echo 'Imported';
		}else{
			echo "<a href='".base_url('admin/uploads/import')."'><button class='btn btn-sm btn-success'>Import DB</button></a>";
		}
		?></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;" onchange="choose_action()" id="action">
				<option>Action</option>
				<option>More Details</option>
				<option>Edit</option>
				<option value="delete">Delete</option>
		</select>
	</td>
	</tr>

<?php endforeach; ?>
<?php else:?>
	<tr>
		<td colspan="3"></td>
		<td>No Record Found</td>
	</tr>
<?php endif;?>
</table>





</div>
</div>
<script>
    function choose_action(){
        var action=document.getElementById('action').value;
        if(action=='delete'){
            var confirm=window.confirm('Are you sure want to delete');
            if(confirm==true){
                
            }
        }
    }
    
</script>


