
<main class="main-registration login-main sec-padd bg-light">
	<section class="login-sec">
			<div class="container">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 offset-lg-3 col-md-12 card">
							<div class="left-form p-5">
								<div class="main-title">
                                    <h5>Welcome, <?php echo ucfirst($user['USERNAME']) ?>!</h5>
									<h6>Please update your password from here.</h6>
									<?php
								// Reset Password Notification message!
									if($this->session->flashdata('msg') == 'Password sent to your email!') {
								?>
									<div class="status-msg success"><?php echo $this->session->flashdata('msg'); ?></div>

								<?php } else { ?>
									<div class="status-msg error"><?php echo $this->session->flashdata('msg'); ?></div>
										<?php }	?>
								</div>
								<?php  
									if(!empty($success_msg)){ 
										echo '<p class="status-msg success">'.$success_msg.'</p>'; 
									}elseif(!empty($error_msg)){ 
										echo '<p class="status-msg error">'.$error_msg.'</p>'; 
									} 
    							?>
								<form method="post" id="updatepassword">
									<div class="form-row">
										<div class="form-group col-md-12">
											<input type="password" name="old_password" class="form-control" id="old_password" placeholder="Current Password" >
										</div>
                                        <div class="form-group col-md-12">
											<input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password" >
										</div>
                                        <div class="form-group col-md-12">
											<input type="password" name="conf_password" class="form-control" id="conf_password" placeholder="Confirm New Password" >
										</div>										
										<div class=" form-group col-md-12">
											<!-- <a href="<?php //echo base_url('users/forgotpassword'); ?>" style="font-style:italic;font-size:13px;color:#e54d06;padding-bottom:1rem">Forgot password?</a><span style="font-size: 13px;color:#0749ab"> Request new one! </span> -->
										</div>
										<div class="send-button">
											<input type="submit" class="btn btn-primary btn-noc" name="update_password" value="UPDATE">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>				
			</div>
	</section>
</main>
	
<script href="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script>
$.validator.addMethod("pwcheck", function (value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
      && /[a-z]/.test(value) // has a lowercase letter
      && /\d/.test(value) // has a digit
  });
  $("#updatepassword").validate({
    rules: {
      new_password: {
        required: true,
        minlength: 8,
        maxlength: 40,
        pwcheck: true
      },
      conf_password: {
        minlength: 8,
        equalTo: "#new_password"
      }
    },
    messages:{
      new_password: {
        required: "Password is required",
        minlength: "Password should be minimum 8 characters",
        maxlength: "Password should be maximum 40 characters",
        pwcheck: "The password does not meet the criteria! (Atleast one digit,one lower case, Allowed Characters: A-Z a-z 0-9 @ * _ - . !)"
      }
    }
  });
</script>
