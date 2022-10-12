<!-- <link href="<?= base_url(); ?>assets/css/signup.css" rel="stylesheet"> -->

<main class="main-registration login-main sec-padd bg-light">
    <section class="login-sec">
            <div class="container">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12 card">
                            <div class="left-form p-5">
                                <div class="main-title">

                                    <?php echo validation_errors(); ?>

                                    <form id="signupform" method="post">

                                        <h2 class="text-center"><strong>Registration Form</strong></h2>

                                        <?php
                                            if (!empty($success_msg)) {

                                                echo '<div class="alert alert-success" role="alert">' . $success_msg . '</div>';

                                            } elseif (!empty($error_msg)) {

                                                echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
                                            
                                            } 
                                        ?>
                                        

                                        <p class="section-head">Account Information:</p>

                                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="first_name">First Name:</label>
                                                <input type="text" name="first_name" class="form-control w-border" id="first_name" placeholder="enter your first name" value="<?php echo set_value('first_name'); ?>">
                                                <?php echo form_error('first_name','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="middle_name">Middle Name:</label>
                                                <input type="text" name="middle_name" class="form-control w-border" id="middle_name" placeholder="enter your middle name" value="<?php echo set_value('middle_name'); ?>">
                                                <?php echo form_error('middle_name','<p class="help-block error">','</p>'); ?>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <label for="last_name">Last Name:</label>
                                                <input type="text" name="last_name" class="form-control w-border" id="last_name" placeholder="enter your last name" value="<?php echo set_value('last_name'); ?>">
                                                <?php echo form_error('last_name','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="mobile_no">Mobile No:</label>
                                                <input type="text" name="mobile_no" class="form-control w-border" id="mobile_no" placeholder="enter your mobile no (Ncell/NTC)" value="<?php echo set_value('mobile_no'); ?>">
                                                <?php echo form_error('mobile_no','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="email_id">Email:</label>
                                                <input type="email" name="email_id" class="form-control w-border" aria-describedby="emailHelp" id="email_id" placeholder="enter your email address" value="<?php echo set_value('email_id'); ?>">
                                                <?php echo form_error('email_id','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="username">Username:</label>
                                                <input type="text" name="username" class="form-control w-border" id="username" placeholder="enter username" value="<?php echo set_value('username'); ?>">
                                                <?php echo form_error('username','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="password">Password:</label>
                                                <input type="password" name="password" class="form-control w-border" id="password" placeholder="enter password">
                                                <?php echo form_error('password','<p class="help-block error">','</p>'); ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="conf_password">Confirm Password:</label>
                                                <input type="password" name="conf_password" class="form-control w-border" id="conf_password" placeholder="enter confirm password" >
                                                
                                            </div>

                                            <div class="form-group col-md-12">
                                                <p id="captImg"><?php echo $captchaImg; ?></p>
                                                <small>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</small>
                                                <div class="status-msg error">
                                                    <?php echo $this->session->flashdata('error_msg'); ?>
                                                </div>
                                                <p><input class="form-control w-border" type="text" name="captcha" value="" placeholder="enter reCaptcha here" /></p>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" name="signup" value="submit" class="btn btn-primary btn-noc">Register</button>
                                            </div>


                                            <div class="form-group col-md-12">
                                            <hr>
                                                <label>Already have account!</label>
                                                <a href="<?php echo  base_url('users/login') ?>" style="">Login</a>
                                            </div>


                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<script src='<?php echo base_url('assets/js/signup.js'); ?>'></script>
<!-- captcha refresh code -->

<script>

    $(document).ready(function() {

        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'users/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });

    });
    
</script>