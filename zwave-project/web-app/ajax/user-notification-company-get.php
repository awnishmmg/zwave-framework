<?php

if(method()=='POST'):
	$user_id = sanitise(post('userid'));
	$account_id = sanitise(post('accountid'));
	load::model('user/Company');
	$company = new Company_model();
	$companies=$company->getActiveCompaniesByID($account_id,$user_id);

	$post_data['company_name'] = sanitise(post('postdata'));
	$data = (empty($post_data['company_name']))?[]:$postdata;
	
else:
	json_bind([],201,'Invalid Request',false);
endif;

?>
<option value="">--Select--</option>
<?php if(count($companies)>0): ?>
<?php foreach($companies as $company): ?>
	<option value="<?php echo $company['id']; ?>" <?php if(set_value('company_name',$data,'company_name')==$company['id']): echo 'selected'; endif; ?> > 
		<?php echo $company['company_name']; ?> 
	</option>
<?php  endforeach; ?>
<?php endif;?>

