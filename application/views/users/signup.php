<link href="<?= base_url(); ?>assets/css/signup.css" rel="stylesheet">

<form id="signupform" method="post">
    <h2>NOC Signup Form</h2>
    <?php
    if (!empty($success_msg)) {
        echo '<p class="status-msg success">' . $success_msg . '</p>';
    } elseif (!empty($error_msg)) {
        echo '<p style="text-align: center;" class="status-msg error">' . $error_msg . '</p>';
    } ?>
    <!--1. Account Information -->
    <div class="tab">
        <p class="section-head">Account Information:</p>
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        <p><input type="text" name="first_name" class="form-control w-border" placeholder="First Name"></p>
            <?php echo form_error('first_name','<p class="help-block error">','</p>'); ?>
        <p><input type="text" name="middle_name" class="form-control" placeholder="Middle Name"></p>
        <p><input type="text" name="last_name" class="form-control w-border" placeholder="Last Name"></p>
            <?php echo form_error('last_name','<p class="help-block error">','</p>'); ?>
        <p><input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Mobile No (NTC/Ncell)"> </p>
            <?php echo form_error('mobile_no','<p class="help-block error">','</p>'); ?>
        <p><input type="email" name="email_id" class="form-control" id="email_id" placeholder="Email" aria-describedby="emailHelp"></p>
            <?php echo form_error('email_id','<p class="help-block error">','</p>'); ?>
        <p><input type="text" placeholder="Username" class="form-control w-border" name="username"></p>
            <?php echo form_error('username','<p class="help-block error">','</p>'); ?>
        <p><input type="password" placeholder="Password" class="form-control w-border" name="password" id="password"></p>
            <?php echo form_error('password','<p class="help-block error">','</p>'); ?>
        <p><input type="password" placeholder="Confirm Password" class="form-control w-border" name="conf_password"></p>
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
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'users/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>