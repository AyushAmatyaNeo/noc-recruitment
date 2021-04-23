<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Sign Up Your User Account</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="signupForm" method="post" action="users/registration">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="payment"><strong>Address</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <!-- Account Information -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Account Information</h2> 
                                    <input type="email" name="email_id" class="form-control" id="inputEmail" placeholder="Email Id  (This email is used to recover your account information if you forget.)" value="<?php echo !empty($user['EMAIL_ID'])?$user['EMAIL_ID']:''; ?>" required>
                                    <input type="text" name="username" placeholder="UserName" />
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Create a Password" required>
                                    <input type="password" name="conf_password" class="form-control" id="inputPassword2" placeholder="Confirm your Password" required>
                                    
                                </div> 
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <!-- Personal Information -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2> 
                                    <input type="text" name="FIRST_NAME" class="form-control w-border" id="inputFirstName" placeholder="First Name" value="<?php echo !empty($user['FIRST_NAME'])?$user['FIRST_NAME']:''; ?>" required>
                                    <input type="text" name="MIDDLE_NAME" class="form-control" id="inputMiddleName" placeholder="Middle Name" value="<?php echo !empty($user['MIDDLE_NAME'])?$user['MIDDLE_NAME']:''; ?>">
                                    <input type="text" name="LAST_NAME" class="form-control w-border" id="inputLastleName" placeholder="Last Name" value="<?php echo !empty($user['LAST_NAME'])?$user['LAST_NAME']:''; ?>" required> 
                                    <input type="text" name="father_name" placeholder="Father Name" />
                                    <input type="text" name="mother_name" placeholder="Mother Name" />
                                    <input type="text" name="spouse_name" placeholder="Spouse Name (if Married)" />
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" name="MOBILE_NO" class="form-control" id="inputMobile" placeholder="Mobile No (NTC/Ncell)" value="<?php echo !empty($user['MOBILE_NO'])?$user['MOBILE_NO']:''; ?>" required>
                                            
                                        </div>
                                        <div class="col-4">
                                            <input type="number" name="PHONE_NO" class="form-control form-control-sm" placeholder="Phone No.">
                                            <?php echo form_error('PHONE_NO','<p class="help-block error">','</p>'); ?>
									    </div>
                                        <div class="col-4">
                                            <select class="form-control" id="inputTitle" placeholder="Gender" required>
                                                <option selected>Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="next" class="next action-button" value="Next Step" id="nextBtn" />
                            </fieldset>
                            <!-- Address -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="fs-title">
                                        <h5>Permanent Address</h5>
                                    </div>
                                    <div class="row">                                      
                                        <div class="form-group col-4">
                                            <label for="PERMANENT_PROVIENCE_ID">Provience</label>
                                            <input type="hidden" id="base" value="<?php echo base_url(); ?>">									
                                            <select name="PERMANENT_PROVIENCE_ID" class="form-control form-control-sm" id="per_province">
                                            <option value="">-- Select --</option>
                                            <?php foreach($proviences as $provience) { ?>
                                                <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
                                            <?php } ?>											
                                            </select>
                                            <?php echo form_error('PERMANENT_PROVIENCE_ID','<p class="help-block error">','</p>'); ?>					
                                        </div> 
                                        <div class="form-group col-4">
                                            <label for="PERMANENT_DISTRICT_ID">District</label>
                                            <select name="PERMANENT_DISTRICT_ID" class="form-control form-control-sm" id="per_district">
                                                <option value="">----</option>
                                                                                        
                                            </select>
										    <?php echo form_error('PERMANENT_DISTRICT_ID','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="PERMANENT_VDC">Muicipality/VDC</label>
                                            <!-- <input type="number	" name="PERMANENT_VDC" class="form-control form-control-sm" id="per_vdc"> -->
                                            <select name="PERMANENT_VDC" class="form-control form-control-sm" id="per_vdc">
                                                <option value="">----</option>
                                                                                        
                                            </select>
                                            <?php echo form_error('PERMANENT_VDC','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="PERMANENT_WARD_ID">Ward Number</label>
                                            <input type="number	" name="PERMANENT_WARD_ID" class="form-control form-control-sm">
                                            <?php echo form_error('PERMANENT_WARD_ID','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="PERMANENT_TOLE">Tole</label>
                                            <input type="text" name="PERMANENT_TOLE" class="form-control form-control-sm">
                                            <?php echo form_error('PERMANENT_TOLE','<p class="help-block error">','</p>'); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fs-title">
                                        <h5>Malling Address</h5>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="MAILLING_PROVIENCE_ID">Provience</label>
                                                <select name="MAILLING_PROVIENCE_ID" class="form-control form-control-sm" id="mail_province">
                                                    <option value="">-- Select --</option>
                                                    <?php foreach($proviences as $provience) { ?>
                                                        <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('MAILLING_PROVIENCE_ID','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="MAILLING_DISTRICT_ID">District</label>
                                                <select name="MAILLING_DISTRICT_ID" class="form-control form-control-sm" id="mail_district">
                                                    <option value="">----</option>									
                                                </select>
                                                <?php echo form_error('MAILLING_DISTRICT_ID','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="MAILLING_VDC">Muicipality/VDC</label>
                                            <!-- <input type="text" name="MAILLING_VDC" class="form-control form-control-sm"> -->
                                            <select name="MAILLING_VDC" class="form-control form-control-sm" id="mail_vdc">
                                                    <option value="">----</option>																					
                                                </select>
                                            <?php echo form_error('MAILLING_VDC','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="MAILLING_WARD_ID">Ward</label>
                                            <input type="number" name="MAILLING_WARD_ID" class="form-control form-control-sm">
                                            <?php echo form_error('MAILLING_WARD_ID','<p class="help-block error">','</p>'); ?>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="MAILLING_TOLE">Tole</label>
                                            <input type="text" name="MAILLING_TOLE" class="form-control form-control-sm">
                                            <?php echo form_error('MAILLING_TOLE','<p class="help-block error">','</p>'); ?>
                                        </div>
                                    </div>
                                </div> 
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                    <input type="submit" name="signupconfirm" class="btn-noc" value="Submit" />
                                    <!-- <input type="submit" class="btn btn-primary btn-noc" name="applySubmit" value="Save and Submit"> class="next action-button btn-noc" -->
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>