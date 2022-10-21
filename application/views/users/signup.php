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

                                            <!-- <div class="form-group col-md-12">
                                                <label for="name_nepali">Full Name (नेपालीमा):</label>
                                                <input type="text" name="name_nepali" class="form-control w-border" id="name_nepali" placeholder="हजुर को नाम नेपालीमा लेख्नुस" value="<?php echo set_value('name_nepali'); ?>">
                                                <?php echo form_error('name_nepali','<p class="help-block error">','</p>'); ?>
                                            </div> -->

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

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-inner modal-notice">
                    <h4>नेपाल आयल निगम लि. को मिति २०७९।०7।04 गते प्रकाशित सूचना अनुसारका विभिन्न पदहरुमा आवेदन गर्न दरखास्त फाराम भर्ने प्रकृया:</h4>
                    <ul>
                        <li>1. सर्वप्रथम <span>Sign-Up</span>  गर्नुपर्नेछ । त्यसको लागि <span>Screen</span> मा <span>Registration</span> मा <span>Click</span> गर्नुपर्नेछ ।</li>
                        <ul>
                            <li><span>Password</span> कम्तिमा <span>६ Character</span> को हुनु पर्नेछ, जसमध्ये कम्तिमा एउटा <span>Capital Letter</span>, एउटा <span>Symbol</span> र एउटा <span>Number</span> हुनुपर्नेछ ।</li>
                            <li><span>Captcha Code</span> राख्दा देखिए अनुरुप लेखी <span>Continue</span> मा <span>Click</span> गर्नुपर्नेछ ।</li>
                            <li><span>Registration</span> गर्दा राखिने इमेलमा दरखास्त स्वीकृत वा अस्वीकृत भएको जानकारी प्राप्त हुने भएकोले प्रयोग भइरहने आफ्नै इमेल राख्नु पर्नेछ ।</li>
                            <li> <span>Register</span> मा <span>Click</span> गरेपछि आफ्नो <span>Email</span> मा <span>Verification Link</span> प्राप्त हुनेछ । उक्त <span>Link Verification</span> गरेर <span>Login Process</span> सम्पन्न भएपश्चात <span>Dashboard</span> मा प्रवेश गर्न सक्नुहुनेछ ।</li>
                        </ul>
                        <li>2. <span>Login Process</span> पहिले नै सम्पन्न भईसकेको भए सोझै आफ्नो <span>Email/Username</span> र <span>Password</span> को प्रयोग गरी <span>Login</span> गर्न सक्नुहुनेछ ।</li>
                        <li>3. <span>Dashboard</span> मा <span>Click</span> गरी हाल चालू रहेका विज्ञापनहरूको विवरण हेर्न सक्नुहुनेछ ।</li>
                        <li>4. यसपछि क्रमशः <span>Registration Details, Other Details, Contact Details, Education, Training</span> तथा <span>Experience</span> को विवरण नेपाली युनिकोडमा भरी आवश्यक <span>Document</span> हरु अनिवार्य रूपमा <span>jpg</span> वा <span>png format</span> मा <span>maximum 1MB</span> फाइल साइज प्रत्येक <span>document</span>  को <span>Upload</span> गर्नुपर्नेछ ।</li>
                        <li>5. यस पश्चात आफूले भरेका सम्पूर्ण विवरणहरूको <span>Preview</span> हेरी <span>Submit</span> मा <span>Click</span> गरेर उपलब्ध बिज्ञापनहरू मध्य एक पटकमा एक पदको दर्खास्तमा <span>Apply</span> गरी सो पदको लागि खुलेको बिज्ञापन नम्बर/हरू Select गरी तोकिएको परीक्षा दस्तुर <span>Khalti</span>, वा <span>Connect IPS</span> मध्य कुनै एक माध्यम को प्रयोग गरि बुझाउनु पर्नेछ ।</li>
                        <li>6. दरखास्त <span>Accept</span> वा <span>Incomplete</span> वा <span>Cancel</span> भएको जानकारी <span>Email</span> वा <span>Mobile</span> मार्फत प्राप्त हुनेछ वा <span>Login</span> गरी पनि हेर्न सकिनेछ । कारणबस <span>Incomplete</span> दरखास्तहरू दरखास्त दिने अन्तिम दिनसम्ममा सोही <span>Login</span> बाट आफैले सच्याउनु पर्ने भएमा सच्याएर पूनः पेश गर्न सकिनेछ ।</li>
                        <li>7. दरखास्त दस्तुर भुक्तानी गर्दा कुनै समस्या आएमा, <span>Khalti</span> : <span class="text-primary">16600158888</span> र <span>Connect IPS</span> : <span class="text-primary">16600155306</span> मा सम्पर्क गर्न सक्नुहुनेछ ।</li>
                        <li>8. दर्खास्त फारम भर्दा कुनै द्विविधा भएमा निगमको टेलिफोन नं. <span class="text-primary">01-5359548</span> (प्रशासनिक सहयोग), <span class="text-primary">०१-५908590</span> (प्राविधिक सहयोग) मा सम्पर्क गरी बुझ्न सकिनेछ ।</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

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

    $(window).on('load', function() {
        $('.bd-example-modal-xl').modal('show');
    });

    // $('.modal').modal('show');
    
</script>