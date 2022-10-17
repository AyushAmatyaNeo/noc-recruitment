<!-- <link href="<?= base_url(); ?>assets/css/signup.css" rel="stylesheet"> -->

<main class="main-registration login-main sec-padd bg-light">
    <section class="login-sec">
            <div class="container">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-12 card">
                            <div class="left-form p-5">
                                <div class="main-title">

                                    <?php echo validation_errors(); ?>

                                    <form id="signupform" method="post">

                                        <h2>Registration Form</h2>

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
                                            <div class="form-group col-md-12">
                                                <label for="first_name">First Name:</label>
                                                <input type="text" name="first_name" class="form-control w-border" id="first_name" placeholder="enter your first name" value="<?php echo set_value('first_name'); ?>">
                                                <?php echo form_error('first_name','<p class="help-block error">','</p>'); ?>
                                            </div>


                                            
                                        </div>



                                        <!--1. Account Information -->
                                        <div class="tab">
                                            

                                            <!-- <p>
                                                
                                            </p>
                                                <?php echo form_error('first_name','<p class="help-block error">','</p>'); ?> -->
                                            
                                            <p>
                                                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo set_value('middle_name'); ?>">
                                            </p>
                                            
                                            <p>
                                                <input type="text" name="last_name" class="form-control w-border" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
                                            </p>
                                                <?php echo form_error('last_name','<p class="help-block error">','</p>'); ?>
                                            
                                            <p>
                                                <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Mobile No (NTC/Ncell)" value="<?php echo set_value('mobile_no'); ?>">
                                            </p>
                                                <?php echo form_error('mobile_no','<p class="help-block error">','</p>'); ?>
                                            
                                            <p>
                                                <input type="email" name="email_id" class="form-control" id="email_id" placeholder="Email" aria-describedby="emailHelp" value="<?php echo set_value('email_id'); ?>">
                                            </p>
                                                <?php echo form_error('email_id','<p class="help-block error">','</p>'); ?>
                                            
                                            <p>
                                                <input type="text" placeholder="Username" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>">
                                            </p>
                                                <?php echo form_error('username','<p class="help-block error">','</p>'); ?>
                                            
                                            <p>
                                                <input type="password" placeholder="Password" class="form-control w-border" name="password" id="password">
                                            </p>
                                                <?php echo form_error('password','<p class="help-block error">','</p>'); ?>
                                            
                                            <p>
                                                <input type="password" placeholder="Confirm Password" class="form-control w-border" name="conf_password">
                                            </p>
                                            
                                            <p id="captImg"><?php echo $captchaImg; ?></p>

                                            <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
                                            <div class="status-msg error"><?php echo $this->session->flashdata('error_msg'); ?></div>
                                            <p><input class="form-control w-border" type="text" name="captcha" value=""/></p>

                                        </div>

                                        <div style="overflow:auto;">
                                            <div>
                                                <hr>
                                                <label>Already have account!</label>
                                                <a href="<?php echo  base_url('users/login') ?>" style="">Login</a>
                                            </div>

                                            <div style="float:right; margin-top: 5px;">
                                                <button type="submit" name="signup" value="submit" class="submit">Submit</button>
                                            </div>
                                        </div>
                                        <!-- Circles which indicates the steps of the form: -->

                                    </form>

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