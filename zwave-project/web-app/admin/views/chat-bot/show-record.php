<?php

?>

<?php show_flash(); ?>

<div class="card" style="border:2px solid grey;">
	<div class="card-header">
		<h6>List of <?php echo count($chats_record); ?> Records </h6>
	</div>
	<div class="card-body mt-2">
		
<a href="<?php echo base_url('admin/chat-bot/add'); ?>"  class="float-right"><button class="btn btn-dark mb-2">Add New</button></a>
<table class="table table-hover mt-2 table-striped">
<tr>
	<th>#</th>
	<th>Company Username</th>
	<th>Company Name</th>
	<th>Template Name</th>
	<th>Scheduled Date</th>
	<th>Posted On</th>
	<th>Action</th>
</tr>
<?php foreach ($chats_record as $chats): ?>

	<tr>
		<td><?php echo $chats['id']; ?></td>
		<td><?php echo $chats['company_username']; ?></td>
		<td><?php echo $chats['company_name']; ?></td>
		<td><?php echo $chats['template_name']; ?></td>
		
			<td class="btn btn-dark btn-sm"><?php echo set_dateformat('d-M-Y',$chats['compaign_date']); ?></td>
			
			<td style="text-align:center"><b><?php 
			
			    empty($chats['created_date'])?print(" NA "):print(set_dateformat('d-M-Y',$chats['created_date']));
			
			?> </b></td>
	<td>
		<select name="action" class="form-control form-control-sm" style="width: 100px;" id="action" onchange="chatbot_action(this);" title="<?php echo $chats['id']; ?>">
			<option value="">Action</option>
			<option value="edit">Edit</option>
			<option value="delete">Delete</option>
			<option value="more">More Details</option>
		</select>
	</td>
	</tr>

<?php endforeach; ?>

</table>

<span class="float-right"><?php $pagination->render(); ?></span>
	</div>

</div>

<script>

   var base_url = "<?php echo base_url(); ?>";
   base_url = base_url + 'admin/chat-bot/';
   
   function chatbot_action(obj){
      var option = obj.value;
      switch(option){
          case 'edit': 
              uri = 'edit/'+obj.title;
          break;
          case 'delete': 
              uri = 'delete/'+obj.title;
          break;
          case 'more': 
              uri = 'more/'+obj.title;
          break;
          
          default:
          break;
      }
      window.location.href=base_url+uri;
   }

</script>