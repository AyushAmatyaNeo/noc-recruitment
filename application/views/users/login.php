<main class="main-registration login-main sec-padd bg-light">
	<section class="login-sec">
			<div class="container">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 offset-lg-3 col-md-12 card">
							<div class="left-form p-5">
								<div class="main-title">
								<?php
								// Reset Password Notification message!
									if($this->session->flashdata('msg') == 'Password sent to your email!') {
								?>
									<div class="status-msg success"><?php echo $this->session->flashdata('msg'); ?></div>

								<?php } else { ?>
									<div class="status-msg error"><?php echo $this->session->flashdata('msg'); ?></div>
										<?php }	?>
									<h5>User Login</h5>
									<p>Login with your registered Email & Password.</p>
								</div>
								<?php  
									if(!empty($success_msg)){ 
										echo '<p class="status-msg success">'.$success_msg.'</p>'; 
									}elseif(!empty($error_msg)){ 
										echo '<p class="status-msg error">'.$error_msg.'</p>'; 
									} 
    							?>
								<form method="post">
									<div class="form-row">
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email | Username">
											<?php echo form_error('text','<p class="help-block">','</p>'); ?>
										</div>
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-lock" aria-hidden="true"></i>
											<input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
											<?php echo form_error('password','<p class="help-block">','</p>'); ?>
										</div>	
										<div class="form-group form-check pl-4">
											<input type="checkbox" class="form-check-input" id="rememberMe">
											<label class="form-check-label" for="rememberMe">Remember me</label>
										</div>	
										<div class="form-group col-md-12">
											<a href="<?php echo base_url('users/forgotpassword'); ?>" style="font-style:italic;font-size:13px;color:#0749ab;padding-bottom:1rem">Forgot password?</a>
										</div>

										<div class=" form-group col-md-12">
											<div class="send-button">
												<input type="submit" class="btn btn-primary btn-noc" name="loginSubmit" value="Login">
											</div>
										</div>

										<!-- <button type="submit" class="btn btn-primary btn-noc" style="width: 100%;">Login</button> -->
									</div>
									<p style="padding-top: 10px;">If you are not yet registered, <a href="<?php echo base_url('users/signup'); ?>">please click here</a></p>
								</form>
							</div>
						</div>
					</div>
				</div>				
			</div>
	</section>
</main>
	
<script href="<?=base_url();?>assets/js/bootstrap.min.js"></script>
