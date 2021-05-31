<?php
$session_data=Session::get('session_data');


$user_id = $session_data['user_id'];

load::model('user/User');
$user_model = new User_model();
$user_details=$user_model->getUserDetailsById($user_id);

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
								
								<span class="float float-right "><button class="btn btn-dark">
									<i class="fa fa-edit">&nbsp;</i>Modify Details</button></span>

							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Owned By</th>
										<td><?php echo ucfirst($user_details['name']); ?></td>	
									</tr>

									<tr>
										<th>Mobile No </th>
										<td><?php echo ucfirst($user_details['mobile_no']); ?></td>	
									
									</tr>

									<tr>
										<th>Landline No</th>
										<td><?php echo ucfirst($user_details['landline']); ?></td>	
									</tr>

									<tr>
										<th>Email</th>
										<td><a href="mailto:<?php echo $user_details['email']; ?>"><?php echo ucfirst($user_details['email']); ?></td>	
									</tr>


									<tr>
										<th>Company Name (Company Alias)</th>
										<td>
											<a href="javascript:void(0);">
												<i>
												        <?php echo ucfirst($user_details['company_name']); ?>
												</i>
											</a>
										</td>	
									</tr>
									


								</table>
							</div>
							<div class="col-md-6">
								<table class="table table-hover" style="border-top: 2px solid orange;">
									<tr>
										<th>Company Details</th>
										<td><?php echo $user_details['company_description']; ?></td>	
									</tr>
									<tr>
										<th>Account Status</th>
										<td>
										<input type="radio" value="enable" name="status"  <?php if($user_details['status']=='enable'):print('checked');endif; ?> >
										Enable
										<input type="radio" value="disable" name="status"  <?php if($user_details['status']=='disable'):print('checked');endif; ?> >
										Disable
										<input type="radio" value="deleted" name="status"  <?php if($user_details['status']=='deleted'):print('checked');endif; ?> >
										Deleted
										</td>	
									</tr>
									<tr>
										<th>Username</th>
										<td><a href="javascript:void(0);"><?php echo $session_data['auth_id']; ?></a></td>	
									</tr>

									<tr>
										<th>Password</th>
										<td>
										    <a href="<?php echo base_url('user/change-password'); ?>">Change</a>
										</td>	
									</tr>
								</table>
								

							</div>
						</div>
						
						<!--<h6>VN Detail</h6>-->
						<!--<div class="row">-->
						<!--    <div class="col-md-6">-->
						<!--        <table class="table table-hover">-->
						<!--           <tr>-->
						<!--                   <th>Total Assigned No(s)</th>-->
						<!--                   <td><?php echo $user_details['assigned_no_count']; ?></td>-->
						<!--          </tr>-->
						              
						<!--          <tr>-->
						<!--                   <th>Maximum VN(s) Allowed</th>-->
						<!--                   <td><input type="text" class="form-control form-control-sm" value="<?php echo $user_details['max_no_count'];?>" style="width:50px;" -->
						<!--                   readonly data-toggle="tooltip" data-placement="top" title="<?php echo $user_details['max_no_count']; ?>" data-original-title="<?php echo $user_details['max_no_count']; ?>" /> -->
						<!--                   <a href="javascript:void(0);">Increase Limit</td>-->
						<!--          </tr>-->
						          
						<!--          </table>  -->
						<!--      </div>-->
						<!-- </div>-->
						 
						 
					</div>
				</div>		
		</div>
		</div>


	</div>

</main>


</div>
