<main class="main-registration login-main sec-padd bg-light">
	<section class="login-sec">
			<div class="container">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 offset-lg-3 col-md-12 card">
							<div class="left-form p-5">
								<div class="main-title">
                				<?php
									if($this->session->flashdata('msg')) {
								?>
								<div class="status-msg error"><?php echo $this->session->flashdata('msg'); ?>

										</div>
										<?php } ?>
									<h5>Forgot Password</h5>
									<p>Enter your registered Email.</p>
								</div>
								<?php  
									if(!empty($success_msg)){ 
										echo '<p class="status-msg success">'.$success_msg.'</p>'; 
									}elseif(!empty($error_msg)){ 
										echo '<p class="status-msg error">'.$error_msg.'</p>'; 
									} 
    							?>
							<form method="post">
								<table class="table table-bordered table-hover table-striped">                                      
									<tbody>
										<tr>
											<td>Enter Email: </td>
											<td>
											<input type="email" name="EMAIL_ID" id="email" style="width:250px" required>
											</td>
											<td><input type = "submit" value="submit" name="resetPassword" class="button"></td>
										</tr>							
									</tbody>               
								</table>
							</form>
							<p style="font-style:italic;font-size:14px;color:#dc3545;padding-bottom:1rem">* Don't refresh or reload this page</p>
							</div>
						</div>
					</div>
				</div>				
			</div>
	</section>
</main>
	
<script href="<?=base_url();?>assets/js/bootstrap.min.js"></script>