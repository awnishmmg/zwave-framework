<?php
$user_details=$chats_record;
?>

<!-- Main content -->
 <main class="main">
		<div class="row">
		<div class="col-md-12">	
				<div class="card">
					<div class="card-header" style="background-color: white;border-top: 3px solid black;">
						<div class="row">
							<div class="col-md-10">
							<h3>
							<i>
							<?php echo $user_details['company_name']; ?>
						   </i>
							</h3>
							</div>
							<div class="col-md-2">
								
								<span class="float float-right "><a href="<?php echo base_url("admin/chat-bot/edit/{$user_details['id']}"); ?>">
								    <button class="btn btn-dark">
									<i class="fa fa-edit">&nbsp;</i>Modify
									</button>
									</a>
								</span>
									
									<span class="float float-right mr-2"><a href="<?php echo base_url("admin/chat-bot/show-record"); ?>">
									    <button class="btn btn-dark">
									<i class="fas fa-arrow-left" >&nbsp;</i>Back</button></a>
									</span>

							</div>
							
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Company Name</th>
										<td><i><?php echo ucfirst($user_details['company_name']); ?></i></td>	
									</tr>
									
									
									 <tr>
										<th>Token</th>
										<td>
										    <a href=""javascript:void(0);><?php echo $user_details['encrypted_id']; ?></a>
										</td>	
									</tr>
									
									<tr>
										<th>Short Url</th>
										 <td><a href="javascript:void(0)";><?php empty($user_details['short_url'])?print("No Link Found"):print($user_details['short_url']); ?></a><button class="btn btn-dark btn-sm ml-4"> <i class="far fa-clone"> </i> Copy</button></td>
										 
									</tr>
							</table>
							</div>
							
						
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Scheduled Date</th>
										<td>
										        <?php echo set_dateformat("d-M-Y",$user_details['compaign_date']); ?>
										 </td>	
									</tr>
									
									<tr>
										<th>Username</th>
										<td><a href="javascript:void(0);"><?php echo $user_details['company_username']; ?></a></td>	
									</tr>
									
									<tr>
										<th>Created On</th>
										<td><?php echo $user_details['created_date']; ?></td>	
										
										
									</tr>
									
									<tr>
									    <th>Created Time</th>
										<td><?php echo $user_details['created_time']; ?></td>
									</tr>
									
								</table>
								

							</div>
						</div>
						<h6>Template & Chatbot Information</h6>
						<div class="row">
						    <div class="col-md-12">
						        <table class="table table-hover">
						            <tr>
										<th>Template Subject / Name</th>
										<td>
										    <a href=""javascript:void(0);><?php echo $user_details['template_name']; ?></a>
										</td>	
									</tr>
									
									
						           <tr>
						                   <th>Template Text</th>
						                   <td><textarea  rows="5" style="resize:none;" cols="100" readonly id="template_text"><?php echo html_entity_decode($user_details['compaign_text']); ?></textarea>
						                   <button class="btn btn-dark btn-sm ml-4" onclick="copyFunction('template_text');">
						                           <i class="far fa-clone"> </i> Copy</button>
						                   </td>
						                    
						          </tr>
						          

						          <tr>
						                   <th>ChatBot URL</th>
						                   <td>
						                 <div class="row">
						                     
						                     <div class="col-md-10">
						                         <input type="text" class="form-control form-control-sm" value="<?php echo "{$user_details['base_url']}?token={$user_details['encrypted_id']}"; ?>" style="width:80%;" 
						                   readonly data-toggle="tooltip" data-placement="top" title="<?php echo $user_details['encrypted_id']; ?>" data-original-title="<?php echo $user_details['encrypted_id']; ?>" value="<?php echo "{$user_details['base_url']}?token={$user_details['encrypted_id']}"; ?>" id="chatbot_url" readonly/>
						                     </div>
						                      <div class="col-md-2">
						                           <button class="btn btn-dark btn-sm ml-4" onclick="copyFunction('chatbot_url');">
						                           <i class="far fa-clone"> </i> Copy</button>
						                      </div>
						                 </div>
						                 </td>
                                              
						          </tr>
						          
						          <tr>
                                        <th>Complete Url</th>
                                        <td>
                                            <a href="javascript:void(0);" id="complete_url" class="btn btn-dark btn-sm ml-4"> <b> <?php echo "{$user_details['base_url']}?token={$user_details['encrypted_id']}"; ?> </b> </a>
                                                 </td>
                                 </tr>
						          
						           
						          <tr>
                                        <th>Template Image</th>
                                        
                                        <td>
                                            <?php  if(!$user_details['compaign_image']=="" or !is_null($user_details['compaign_image']) ):   ?>
                                            
                                            <img src="<?php echo base_url($user_details['compaign_image']); ?>" height="50" width="50" style=""/>
                                            <a href="<?php echo base_url($user_details['compaign_image']); ?>" id="preview" class="btn btn-dark btn-sm ml-4" target="_blank"> <b> Preview </b> </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp; save for later click 
                                            <a href="javascript:void();" id="preview" target="_blank"> <b> Download </b> </a> here 
                                            
                                            <?php else: ?>
                                               No Image Found
                                            <?php endif; ?>
                                        </td>
                                 </tr>
						          </table>  
						      </div>
						 </div>
					</div>
				</div>		
		</div>
		</div>


	</div>

</main>


</div>

<script>

        function copyFunction(element_name) {
            
              var copyText = document.getElementById(element_name);
              copyText.select();
              copyText.setSelectionRange(0, 99999)
              document.execCommand("copy");
              alert("Copied the text: " + copyText.value);
        }
        
        
        
</script>

<script>
            CKEDITOR.replace( 'compaign_text' );
</script>
