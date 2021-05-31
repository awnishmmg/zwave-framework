<?php

if(method()=='POST'):
    $bill_id = sanitise(post('bill_id'));
    load::model('user/Billing');
    $billing_details = current(Billing_model::getUserBillingInfo($bill_id));
    load::model('admin/Procured_number');
    $Procured_number = new Procured_number_model();
    
    $number_details = $Procured_number->getNumberDetailsById($billing_details['vn_id']);
    load::model('user/User');
    $user_model = new User_model();
    
    $session_data = Session::get('session_data');
    $user_id = $session_data['user_id'];
    $billing_user_id = $billing_details['user_id'];
    
    if($user_id==$billing_user_id):
        
        $user_data = $user_model->getUserDetailsById($user_id);
        
    
    endif;
    
    load::model('admin/Bd_agents');
    $bd_agents = new Bd_agents_model();
    
    $bd_id = $user_data['bd_id'];
    $bd_data=$bd_agents->getByDetailsByID($bd_id);
    $bd_name = $bd_data['bd_name'];
    
    

?>
   <main class="main">
		<div class="row">
		<div class="col-md-12">	
				<div class="card">
					<div class="card-header" style="background-color: white;border-top: 3px solid black;">
						<div class="row">
							<div class="col-md-10">
							 <dl>
							<h3>
							<i>
							<dt><?php echo ucwords($user_data['company_name']); ?></dt>
						   </i>
							</h3>
							<dd><?php echo ucwords($user_data['company_description']);?></dd>
							</dl>
							</div>
							<div class="col-md-2">
								
								<span class="float float-right "><button class="btn btn-dark" onclick="window.print();">
									<i class="fa fa-print">&nbsp;</i> Print </button></span>

							</div>
						</div>
					</div>
					<div class="card-body">
					    <div class="row">
					        
					        <div class="col-md-3">
					          <table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>VN (Miscall.) No</th>
										<td><?php echo ucfirst($number_details['miscall_numbers']); ?></td>	
									</tr> 
									<tr>
										<th>Current Status</th>
										<td><?php echo ucfirst($number_details['status']); ?></td>	
									</tr>
					           </table>
					        </div>
					         <div class="col-md-3">
					          <table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Prefix Code (If Any)</th>
										<td>+<?php echo ucfirst($number_details['prefix_code']); ?></td>	
									</tr>  
					           </table>
					        </div>
					        <div class="col-md-3">
					            <table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>VN Status</th>
										<td><?php echo ucfirst($billing_details['status']) ?></td>	
									</tr>  
					           </table>
					            
					        </div>
					        
					        <div class="col-md-3">
					            <table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Activation Date</th>
										<td><?php echo ucfirst($number_details['activation_date']); ?></td>	
									</tr>  
									<tr>
										<th>Valid Till</th>
										<td><?php echo ucfirst($number_details['months']); ?> Month</td>	
									</tr>  
					           </table>
					            
					        </div>
					        
					        
					    </div>
					    <div class="row mt-4" style="border-top:3px solid orange"></div>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Owner Name</th>
										<td><?php echo ucwords($user_data['name']); ?></td>	
									</tr>

									<tr>
										<th>Mobile No</th>
										<td><?php echo ucwords($user_data['mobile_no']); ?></td>	
									</tr>

									<tr>
										<th>Landline No</th>
										<td><?php echo ucwords($user_data['landline']); ?></td>	
									</tr>



									<tr>
										<th>Email</th>
										<td><a href="mailto:<?php echo ucwords($user_data['email']); ?>"><?php echo ucwords($user_data['email']); ?></td>	
									</tr>

									<tr>
										<th>Username</th>
										<td><a href="#">awnis2021</a></td>	
									</tr>

									<tr>
										<th>Company Name</th>
										<td>
											<a href="#">
												<i>
													
													<?php echo ucwords($user_data['company_name']); ?>
												</i>
											</a>
										</td>	
									</tr>
									
									<tr>
										<th>Billing</th>
										<td>
										    <a href="#"><?php echo ucfirst($billing_details['billing_status']); ?>
										    </a></td>	
									</tr>
									
									<tr>
										<th>Service Type</th>
										<td>
										    <a href="#">
										        <?php if($billing_details['billing_status']=='no'): ?>
										            <span class="badge badge-danger" style="font-size:0.8rem;"> Test </span>
										        <?php else: ?>
										           <span class="badge badge-success" style="font-size:0.8rem;"> Paid </span>
										        <?php endif; ?>
										    </a>
										 </td>	
									</tr>
									
										<tr>
										<th>Reseller Type</th>
										<td>
										    <a href="#"><?php echo ucfirst($billing_details['reseller_type']); ?>
										    </a></td>	
									</tr>
									
									
									
									</tr>
									
										<tr>
										<th>Account Type</th>
										<td>
										    <a href="#"><?php echo ucfirst($billing_details['account_type']); ?>
										    </a></td>	
									</tr>
									
									</tr>
									
										<tr>
										<th>HLR LOOK-UPs</th>
										<td>
										    <a href="#"><?php echo ucfirst($billing_details['need_hlr']); ?>
										    </a></td>	
									</tr>


								</table>
							</div>
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
								    
								    <tr>
										<th>Billing Activation Date</th>
										<td><?php echo $billing_details['activation_date']; ?></td>	
									</tr>
									<tr>
										<th>Billing Name</th>
										<td><?php echo $billing_details['billing_name']; ?></td>	
									</tr>
									<tr>
										<th>Billing Address</th>
										<td><?php echo ucwords($billing_details['billing_address']); ?></td>	
									</tr>
									<tr>
										<th>State</th>
										<td><?php echo ucwords($billing_details['state']); ?></td>	
									</tr>

									<tr>
										<th>City</th>
										<td><?php echo ucwords($billing_details['city']); ?></td>	
									</tr>

									<tr>
										<th>Town</th>
										<td><?php echo ucwords($billing_details['town']); ?></td>	
									</tr>

                                    <tr>
										<th>Billing Activity Status</th>
										<td><?php echo ucfirst($billing_details['bstatus']); ?></td>	
									</tr>
								</table>

							</div>
						</div>
					</div>
					
					
				</div>		
				<div class="card">
				    <div class="card-header" style="background-color: white;border-top: 3px solid black;" ><h5>Pricing Details</h5></div>
				    <div class="card-body">
				        <div class="row">
				            <div class="col-md-6">
				              <table class="table table-hover" style="border-top: 2px solid orange;">
								    
								     <tr>
										<th>GST Invoicing</th>
										<td><?php echo $billing_details['gst']; ?></td>	
									</tr>
								    <tr>
										<th>Billing Cost</th>
										<td><?php echo $billing_details['billing_cost']; ?></td>	
									</tr>
									
						            <tr>
										<th>Billing Units</th>
										<td><?php echo $billing_details['billing_units']; ?></td>	
									</tr>
							  </table>
							  </div>
							  <div class="col-md-6">
				                    <table class="table table-hover" style="border-top: 2px solid orange;">
    									<tr>
    										<th>Channel Cost Price</th>
    										<td><?php echo $billing_details['billing_channel_price']; ?></td>	
    									</tr>
    									
    									<tr>
    										<th>Channel Cost Units</th>
    										<td><?php echo $billing_details['billing_channel_units']; ?></td>	
    									</tr>
    									
    									<tr>
    										<th>HLR Pricing Cost</th>
    										<td><?php echo $billing_details['hlr_cost']; ?></td>	
    									</tr>
    									
    									<tr>
    										<th>HLR Pricing Units</th>
    										<td><?php echo $billing_details['hlr_unit']; ?></td>	
    									</tr>
				                </table>
				            </div>
				        </div>
				        <div class="row">
				            <div class="col-md-12">
				                <table class="table table-hover">
				                    <tr>
				                        <th><h5>Declaration :-</h5></th>
				                        <td></td>
				                    </tr>
				                    <tr>
				                        <td><b>We declare that Invoice shows the actual price of the services and that all particulars are true and correct.</b></td>
				                        <td><b>Approved By:- <b> <br class="br br-sm"/>
				                            
				                            <?php echo ucfirst($bd_name); ?> <br/>
				                            
				                        
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

<?php  
    else:
        echo "Invalid Request ";
endif;

?>
