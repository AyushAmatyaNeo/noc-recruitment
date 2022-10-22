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
										if ( $this->session->flashdata('msg') !== NULL ) {

											if( $this->session->flashdata('msg') == 'Password sent to your email!') {

												echo '<div class="status-msg alert alert-success">'.$this->session->flashdata('msg').'</div>';
													
											} else { 

												echo '<div class="status-msg alert alert-danger">'.$this->session->flashdata('msg').'</div>';

											}

										}

									?>

									<h5>Resend Email</h5>
									<p>Please enter registered email address</p>
								</div>

								<?php

									if( !empty( $success_msg ) ) {

										echo '<p class="status-msg alert alert-success">'.$success_msg.'</p>';

									} elseif ( !empty( $error_msg ) ) {

										echo '<p class="status-msg alert alert-danger">'.$error_msg.'</p>'; 

									}

    							?>

    							<?php echo ($this->session->flashdata('error_msg') !== NULL) ? "<p class='alert alert-danger'>".$this->session->flashdata('error_msg')."</p>" : ''; ?>

								<form method="post">
									<div class="form-row">
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<input type="text" name="email" class="form-control" id="inputEmail" placeholder="enter registered email address" required>
											<?php echo form_error('text','<p class="help-block">','</p>'); ?>
										</div>

										<div class=" form-group col-md-12">
											<div class="send-button">
												<input type="submit" class="btn btn-primary btn-noc" name="loginSubmit" value="Resend Activation Email">
											</div>
										</div>

										<!-- <button type="submit" class="btn btn-primary btn-noc" style="width: 100%;">Login</button> -->
									</div>
									<p style="padding-top: 10px;">Back To Login , <a href="<?php echo base_url('users/login'); ?>">please click here</a></p>
								</form>
							</div>
						</div>
					</div>
				</div>				
			</div>
	</section>
</main>
	
<script href="<?=base_url();?>assets/js/bootstrap.min.js"></script>
