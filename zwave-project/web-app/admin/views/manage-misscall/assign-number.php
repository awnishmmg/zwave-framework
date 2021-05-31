<?php

load::model('admin/Procured_number');
$procured_number_model = new Procured_number_model();
$active = $procured_number_model->activeNoCounts();


Load::model('admin/Assigned_number');
$Assigned_number_model = new Assigned_number_model();
$data=$Assigned_number_model->getAssignedNumbers();
load::model('admin/Procured_number');
$Procured_number_model = new Procured_number_model();
load::model('user/User');
$User_model = new User_model();

load::model('common/User_billing');
$User_billing_model = new User_billing_model();

?>


    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="icon-layers float-right m-0 h2 text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Active Numbers</h6>
                <h3 class="my-3" data-plugin="counterup"><?php echo $active; ?></h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="icon-paypal float-right m-0 h2 text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Assigned</h6>
                <h3 class="my-3">
                	<span data-plugin="counterup"><?php echo $active; ?></span></h3>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="icon-paypal float-right m-0 h2 text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Un-Assigned</h6>
                <h3 class="my-3"><span data-plugin="counterup"><?php echo $inactive; ?></span></h3>
            </div>
        </div>
    
    </div>

<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	<div class="card-header">
		<div class="row">
			<div class="col-md-10">
				<h5>Assigned Channel Number</h5>
			</div>	
			<div class="col-md-2">
				<a href="<?php echo base_url('admin/manage-misscall/assign'); ?>">
					<button class="btn btn-warning waves-effect waves-light"> 
						<span><b>Assign</b></span> 
						<i class="mdi mdi-launch mr-1"></i> 
					</button>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
<table class="table table-hover">
<tr>
	<th>Sr No. </th>
	<th>Misscall No.</th>
	<th>Assigned To</th>
	<th>Status</th>
	<th>Billing</th>
	<th>Billing Info</th>
	<th>Action</th>
</tr>
<?php if(count($data)>0): $i=1 ?>
<?php foreach ($data as $row): ?>

	<tr style="border-bottom:1px solid silver;">
		<td>
			<?php echo $i; ?>
		</td>
		<td>
			<?php 

			$prefix_code=$Procured_number_model->getNumberDetailsById($row['procured_no_id'])['prefix_code'];
			$number = $Procured_number_model->getNumberDetailsById($row['procured_no_id'])['miscall_numbers'];

			echo "+{$prefix_code}{$number}";

			?>
		</td>
		<td style="background-color: black;color:white;padding:5px;">
			<?php $user_id=$row['user_id'];
	$name=$User_model->getUserDetailsById($user_id)['name'];
	$campany=$User_model->getUserDetailsById($user_id)['company_name'];
	$email=$User_model->getUserDetailsById($user_id)['email'];
				echo "<b><i>".$name."</i></b> <hr class='mt-1' style='background-color:white;'/><i class='ti ti-email'></i> <a href='mailto:{$email}'>{$email} </a>";

				echo "<hr class='mt-1' style='background-color:white;'/><i class='fa fa-building'></i> <a href='javascript:void(0);'> {$campany} </a>";
			?>
		</td>
		<td>
			<a href="javascript:void(0)">
				<?php echo ucfirst($row['status']); ?>
			</a>
		</td>
		<td>
			<?php $billing_id=$row['billing_id'];
			$billing_status=$User_billing_model->getBillingDetailsId($billing_id)['billing_status'];
			echo $billing_status;

			?>
		</td>
		<td>
		<?php 
			 
			if($billing_status=='yes'){
				echo "<a href='javascript:void(0)'><i class='mdi mdi-launch mr-1' style='font-size:0.9rem;'> View</i></a>";
			}
		?>
		</td>
	
		<td>
			<select name="action" class="form-control form-control-sm " style=	"width: 100px;">
				<option>Action</option>
				<option>Delete</option>
				<option>More Details</option>
				<option>Edit</option>
				<option>Setting</option>
				<option>Delete</option>
			</select>
		</td>
	</tr>

<?php $i++; endforeach; ?>
<?php else:?>
	<tr>
		<td colspan="3"></td>
		<td><b>No Record Found</b></td>
		<td colspan="3"></td>
	</tr>
<?php endif;?>
</table>



	</div>

</div>

