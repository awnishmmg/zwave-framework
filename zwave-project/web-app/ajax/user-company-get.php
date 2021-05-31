<?php

if(method()=='POST'):

	$session_data = session::get('session_data');
	$user_id = $session_data['user_id'];
	// Or 
	$user_id = sanitise(post('userid'));
	$account_id = sanitise(post('accountid'));

	load::model('user/Company');
	$company = new Company_model();
	$companies = $company->getCompaniesByID($account_id,$user_id);

else:

	json_bind([],404,'Invalid Request',false);

endif;

?>
<?php if(count($companies)>0): ?>
<table class="table table-hover">
		<tr>
			<th>
				<input type="checkbox" style="zoom:1.5;" name="checkbox[]"
				 value="<?php echo $account['id']; ?>" onchange="select_checkbox(this)" /> Select
			</th>
			<th>#</th>
			<th>Company Name</th>
			<th>Company Type</th>
			<th>Status</th>
		</tr>
		<?php foreach ($companies as $company): ?>
		<tr>

			<td>
				<input type="checkbox" style="zoom:1.5;" class="checkbox" name="checkbox[]" value="<?php echo $company['id']; ?>" onclick="single_select(this);"/>
			</td>

			<td><b><?php echo $company['id']; ?></b></td>
			<td><b><?php echo $company['company_name']; ?></b></td>
			<td><b><?php echo $company['company_type']; ?></b></td>
			<td><b><?php echo $company['status']; ?></b></td>

		</tr>
		
		<?php endforeach; ?>

		</table>

<?php else: ?>
	<div class="text text-center text-danger"> No Record Found </div>
<?php endif; ?>

