<main class="main-registration sec-padd bg-light">
		<section class="registration-sec">
			<div class="container">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 col-md-12 card">
							<div class="left-form p-5">
								<h5 class="main-title">Edit Profile</h5>
								<?php  
									if(!empty($success_msg)){ 
										echo '<p class="status-msg success">'.$success_msg.'</p>'; 
									}elseif(!empty($error_msg)){ 
										echo '<p class="status-msg error">'.$error_msg.'</p>'; 
									} 
    							?>
								<form method="post">
									<div class="form-row">
										<div class="form-group col-md-4 cstm-form-grp">
											<i class="fa fa-user" aria-hidden="true"></i>
											<select class="form-control" name="SR_NO" id="inputTitle" placeholder="Title">
												<option>Mr</option>
												<option>Mrs</option>
												<option>Miss</option>
											</select>
											<?php echo form_error('SR_NO','<p class="help-block">','</p>'); ?>
										</div>
										<div class="form-group col-md-8 cstm-form-grp">
											<!-- <i class="fa fa-user" aria-hidden="true"></i> -->
											<input type="text" name="FIRST_NAME" class="form-control w-border" id="inputFirstName" placeholder="First Name" value="<?php echo !empty($user['FIRST_NAME'])?$user['FIRST_NAME']:''; ?>" required>
											<?php echo form_error('FIRST_NAME','<p class="help-block">','</p>'); ?>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6 cstm-form-grp">
											<i class="fa fa-user" aria-hidden="true"></i>
											<input type="text" name="MIDDLE_NAME" class="form-control" id="inputMiddleName" placeholder="Middle Name" value="<?php echo !empty($user['MIDDLE_NAME'])?$user['MIDDLE_NAME']:''; ?>">
											<?php echo form_error('MIDDLE_NAME','<p class="help-block">','</p>'); ?>
										</div>
										<div class="form-group col-md-6 cstm-form-grp">
											<!-- <i class="fa fa-user" aria-hidden="true"></i> -->
											<input type="text" name="LAST_NAME" class="form-control w-border" id="inputLastleName" placeholder="Last Name" value="<?php echo !empty($user['LAST_NAME'])?$user['LAST_NAME']:''; ?>" required>
											<?php echo form_error('LAST_NAME','<p class="help-block">','</p>'); ?>
										</div>
									</div>
									<div class="form-row col-md-12">
										<div class="form-group form-check cstm-form-check form-check-inline col-md-2">
                                        <?php $checked = $user['GENDER'] == 1 ? 'checked' : '' ; ?>
											<input class="form-check-input" name='GENDER' type="radio" id="inlineRadio1" <?=$checked?> value="1">
											<label class="form-check-label" for="GENDER">Male</label>
										</div>
										<div class="form-group form-check cstm-form-check form-check-inline col-md-2">
                                        <?php $checked = $user['GENDER'] == 2 ? 'checked' : '' ; ?>
											<input class="form-check-input" name='GENDER' type="radio" id="inlineRadio2" <?=$checked?> value="2">
											<label class="form-check-label" for="GENDER">Female</label>
										</div>
										<div class="form-group form-check cstm-form-check form-check-inline col-md-2">
                                        <?php $checked = $user['GENDER'] == 3 ? 'checked' : '' ; ?>
											<input class="form-check-input" name='GENDER' type="radio" id="inlineRadio2" <?=$checked?> value="3">
											<label class="form-check-label" for="GENDER">Others</label>
										</div>
									</div>
									<?php echo form_error('GENDER','<p class="help-block error">','</p>'); ?>
									<div class="form-row ">
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<input type="email" name="EMAIL_ID" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo !empty($user['EMAIL_ID'])?$user['EMAIL_ID']:''; ?>" required>
										</div>
										<?php echo form_error('EMAIL_ID','<p class="help-block error">','</p>'); ?>
										<span style="font-style:italic;font-size:11px;color:#ff1901;padding-bottom:1rem">This email is used to recover your account information if you forget.</span>
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-phone" aria-hidden="true"></i>
											<input type="number" name="MOBILE_NO" class="form-control" id="inputMobile" placeholder="Mobile No (NTC/Ncell)" value="<?php echo !empty($user['MOBILE_NO'])?$user['MOBILE_NO']:''; ?>" required>	
										</div>
										<?php echo form_error('MOBILE_NO','<p class="help-block">','</p>'); ?>									
										
										<div class="send-button">
											<input type="submit" class="btn btn-primary btn-noc" name="signupSubmit" value="Update">
										</div>
									</div>
									<!-- <p style="padding-top: 10px;">If you already have an account, please login from <a href="<?php echo base_url('users/login'); ?>">here</a></p> -->
								</form>
							</div>
						</div>

						<div class="col-lg-6 d-none d-lg-block p-0">
							<div class="right-content p-5">
								<h5 class="main-title">Register for a better opportunity!</h5>
								<div class="right-content-inner d-flex">
									<i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>
									<div class="right-content-text">
										<h6>Lorem ipsum dolor sit amet, consectetur</h6>
										<small>Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur</small>
									</div>
								</div>
								<div class="right-content-inner d-flex">
									<i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>
									<div class="right-content-text">
										<h6>Lorem ipsum dolor sit amet, consectetur</h6>
										<small>Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur</small>
									</div>
								</div>
								<div class="right-content-inner d-flex">
									<i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>
									<div class="right-content-text">
										<h6>Lorem ipsum dolor sit amet, consectetur</h6>
										<small>Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur</small>
									</div>
								</div>
								<div class="right-content-inner d-flex">
									<i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>
									<div class="right-content-text">
										<h6>Lorem ipsum dolor sit amet, consectetur</h6>
										<small>Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur</small>
									</div>
								</div>
								<div class="right-content-inner d-flex">
									<i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>
									<div class="right-content-text">
										<h6>Lorem ipsum dolor sit amet, consectetur</h6>
										<small>Lorem ipsum dolor sit amet, consecteturLorem ipsum dolor sit amet, consectetur</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</section>
	</main>
	
	<script href="<?php base_url() ?>assets/js/bootstrap.min.js"></script>