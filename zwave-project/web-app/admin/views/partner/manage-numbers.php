<?php

load::model('admin/Procured_number');
$procured_number_model = new Procured_number_model();
$numbers = $procured_number_model->getAllnumbers();

$total_no = $procured_number_model->NumbersCounts();
$active = $procured_number_model->activeNoCounts();
$inactive = $procured_number_model->inactiveNoCounts();

?>


                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right m-0 h2 text-muted"></i>
                                    <h6 class="text-muted text-uppercase mt-0">Total Numbers</h6>
                                    <h3 class="my-3" data-plugin="counterup"><?php echo $total_no; ?></h3>
                                   <div class="row">

                                	<span>Channel Number been procured</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-paypal float-right m-0 h2 text-muted"></i>
                                    <h6 class="text-muted text-uppercase mt-0">Active</h6>
                                    <h3 class="my-3"><span data-plugin="counterup"><?php echo $active; ?></span></h3>
                                    <span class="badge badge-success mr-1"> <?php echo ($active/$total_no)*100; ?>% </span> <span class="text-muted"> Active Numbers</span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-paypal float-right m-0 h2 text-muted"></i>
                                    <h6 class="text-muted text-uppercase mt-0">Inactive</h6>
                                    <h3 class="my-3"><span data-plugin="counterup"><?php echo $inactive; ?></span></h3>
                                    <span class="badge badge-danger mr-1"> <?php echo ($inactive/$total_no)*100; ?>% </span> <span class="text-muted"> In-Active Numbers</span>
                                </div>
                            </div>
                        
                        </div>

<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	<div class="card-header">
		<h6>Manage Channel Number</h6>
	</div>
	<div class="card-body">
		<a href="<?php echo base_url('admin/partners/procure-numbers'); ?>"><button class="btn btn-primary">Procure More</button></a>
<table class="table table-hover">
<tr>

	<th></th>
	<th>Misscall No. (inc. +Code)</th>
	<th>Vendor / Channel Partner</th>
	<th>Status</th>
	<th>Active</th>
	<th>Action</th>
</tr>
<?php if(count($numbers)>0): ?>
<?php foreach ($numbers as $number): ?>

	<tr>
		<td>
		<?php 
			if($number['status']=='active'):
				echo "<img src='assets/images/tick.png' height='20'/>";
			else:
				echo "<img src='assets/images/cross.png' height='20'/>";
			endif;
		?>
		</td>
		<td><a href="javascript:void(0);">

			<?php echo "+{$number['prefix_code']}{$number['miscall_numbers']}"; ?>
			</a>
		</td>
		
		<td><a href="javascript:void(0);">
			<?php echo 
              	
               Procured_number_model::findVendorByID($number['vendor_id'])['vendors_name'];
              ?>
			</a>
		</td>
		<td><?php $status=$number['status']; 
			
			$color = ($status=='active')?'success':'danger';

			echo "<span class='badge badge-$color'>".$status."</span>";


			?></td>
		<td><a href="<?php echo base_url("admin/partners/change-status/{$status}/{$number['id']}"); ?>">
			<?php if($number['status']=='inactive'): ?>
				<b>Active</b>
			<?php else: ?>
				<span style="color:red;"><b>Disable</b></span>
			<?php endif; ?>
			
		</a></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;">
				<option>Action</option>
				<option>More Details</option>
				<option>Edit</option>
				<option>Delete</option>
		</select>
	</td>
	</tr>

<?php endforeach; ?>
<?php else:?>
	<tr>
		<td colspan="2"></td>
		<td>No Record Found</td>
	</tr>
<?php endif;?>
</table>



	</div>

</div>

