<?php

load::model('user/Account');
class_alias('Account_model','Accounts');
load::model('user/Company');
class_alias('Company_model','Company');

load::php_file('functions/user/settings');
load::model('user/Template');
class_alias('Template_model','Template');

$session_data = session::get('session_data');
$Template = Template::getTemplatesByChatBotID(get('tmp_id'));
$Template = variable_exists($Template,'',$Template);

?>

<?php show_flash(); ?>

<div class="card">
	
	<div class="card-header" style="background-color: white;border-top: 3px solid black;">
		<h5>Template Integration</h5>
	</div>

	<div class="card-body mt-2">
	<div class="row">
		<div class="col-md-9"></div>
		<div class="col-md-2">

			<a href="<?php echo base_url('user/notification-manage'); ?>"  
				class="float-right col-md-1"><button class="btn btn-dark mb-2">Back</button>
			</a>

		</div>
	</div>

	<?php  
		if(!empty($Template)): 
			extract($Template);
			@$has_placeholder = ($has_placeholder==0)?'Normal Template':'Variable Template';
			$created_by = $session_data['auth_id']; 
			$api_url = base_url(setting_chatbot_url()); 
?>

		
	</div>


<div class="container">
  <div id="accordion">
    <div class="card">
      <div class="card-header" style="background-color:#343a40;color:white;">
        <a class="card-link" data-toggle="collapse" href="#collapseOne" 
        style="color:white;">
         <b>Basic Information</b>
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion">
        
        <div class="card-body">
          <table class="table table-striped">
          	 <tr>
	          	<th>#Template ID :</th>
	          	<td> TEMP / <?php echo $id; ?></td>
	         </tr>
          	<tr>
	          	<th>Template Type: </th>
	          	<td><?php echo $has_placeholder; ?></td>
	         </tr>
	          <tr>
	          	<th>#Token :</th>
	          	<td><?php echo $token; ?></td>
	         </tr>
	         <tr>
	          	<th>Created By :</th>
	          	<td class="text-primary"> <?php echo $created_by; ?> </td>
	         </tr>
	        

          </table>
        
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" style="background-color:#343a40;">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo" style="color:white;">
        <b>Meta Information & Access Security </b>
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body">
           <table class="table table-striped">
           	<tr>
	          	<th>Reset Template Setting :</th>
	          	<td>
	          		<a href="<?php echo base_url("user/configured-delete?id={$id}&tmp_id={$chatbot_id}&token={$token}"); ?>" class="btn btn-danger" style="font-size: 1.0rem;">Reset <i class=" mdi mdi-arrow-expand-left"></i> 
	     </a>
	          	</td>
	         </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" style="background-color:#343a40;">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree" style="color:white;">
          <b>Attachment</b>
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
           <table class="table table-striped">
          	
          </table>
        </div>
      </div>
    </div>
    <!-- Accordian 4-->
    <div class="card">
      <div class="card-header" style="background-color:#343a40;">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapse4" style="color:white;">
          <b>API Integration</b>
        </a>
      </div>
      <div id="collapse4" class="collapse" data-parent="#accordion">
        <div class="card-body">
           <table class="table table-striped">
          	 <tr>
	          	<th>Request Type :</th>
	          	<td class="text-primary"><?php echo $http_type; ?></td>
	         </tr>
          	<tr>
	          	<th>Parameters :</th>
	          	<td class="text-primary"><?php echo $variable_values; ?></td>
	         </tr>
	          <tr>
	          	<th>Base URL :</th>
	          	<td class="text-primary"><?php echo $api_url; ?></td>
	         </tr>
	         <tr>
	          	<th>Token URL :</th>
	          	<td class="text-primary"><?php echo "token={$token}"; ?></td>
	         </tr>
	         <tr>
	          	<th>Binding URL :</th>
	          	<td class="text-primary"><?php echo $query_url; ?></td>
	         </tr>
	         <tr>
	          	<th>Binding Operator :</th>
	          	<td class="text-primary">[Query String] or [?]</td>
	         </tr>
	         <?php $apiURL="{$api_url}?token={$token}&{$query_url}"; ?>
	         <tr>
	          	<th>Api URL :</th>
	          	  <td><textarea class="form-control" readonly="" style="resize: none;"><?php echo $apiURL; ?></textarea>
	          	</td>
	         </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- Accordian 4-->

        <!-- Accordian 5-->
    <div class="card">
      <div class="card-header" style="background-color:#343a40;">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapse5" style="color:white;">
          <b>API Documentation</b>
        </a>
      </div>
      <div id="collapse5" class="collapse" data-parent="#accordion">
        <div class="card-body">
           <table class="table table-striped">
          	 <tr>
	          	<th>API Documentation</th>
	          	<td>
	          		<a target="_blank" href="<?php  echo base_url('resources/uploads/chatbots/http/doc.pdf'); ?>">Download</a>
	          	</td>
	         </tr>
          
          </table>
        </div>
      </div>
    </div>
    <!-- Accordian 5-->

  </div>
</div>

<?php else: ?>
	<div style="text-align: center;">
		<hr>
		<h4 class="text text-danger">Template is Not Configured</h4></div>
<?php endif; ?>


</div>

