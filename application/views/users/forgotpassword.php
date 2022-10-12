<main class="main-registration login-main sec-padd bg-light">
	<section class="login-sec">
			<div class="container">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 offset-lg-3 col-md-12 card">
							<div class="left-form p-5">
								<div class="main-title">
                				
                				<?php if($this->session->flashdata('msg')) { ?>
									<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
								<?php } elseif ($this->session->flashdata('msg_success')) { ?>
									<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('msg_success'); ?></div>
								<?php } ?>

									<h5>Update your Password</h5>
									<p>Enter your registered Email.</p>
									<p style="font-size: 14px;">We will send your new password in your Registered Email.</p>
								</div>

								<?php  
									if (!empty($success_msg)) { 
										echo '<div class="alert alert-success" role="alert">'.$success_msg.'</div>'; 
									} elseif (!empty($error_msg)) { 
										echo '<div class="alert alert-danger" role="alert">'.$error_msg.'</div>'; 
									} 
    							?>

								<form method="post">

	    							<div class="form-row">
										<div class="form-group col-md-12 cstm-form-grp">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<input type="text" id="email" name="email_id" class="form-control" id="inputEmail" placeholder="enter your email address" required>
										</div>
										
										<div class="form-group col-md-12">
											<div class="send-button">
												<input type="submit" value="Submit" name="resetPassword" class="btn btn-primary btn-noc">
											</div>
										</div>

										<div class="form-group col-md-12">
                                        <hr>
                                            <label>Back to login page</label>
                                            <a href="<?php echo  base_url('users/login') ?>" style="">Login</a>
                                        </div>
									</div>
								</form>
							<!-- <p style="font-style:italic;font-size:14px;color:#dc3545;padding-bottom:1rem">* Don't refresh or reload this page</p> -->
							</div>
						</div>
					</div>
				</div>				
			</div>
	</section>
</main>
	
<script href="<?=base_url();?>assets/js/bootstrap.min.js"></script>