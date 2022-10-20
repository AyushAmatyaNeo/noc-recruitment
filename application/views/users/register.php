<link href="<?= base_url(); ?>assets/css/register.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">


<div class="clearfix"></div>
<section class="recruitment-form-sec bg-light">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-11">

            <div class="card">
               <form id="myForm" method="POST" enctype="multipart/form-data">

                  <input type="hidden" name="base" id="base" value="<?php echo base_url(); ?>">

                  <h2>NOC | Registration Form</h2>
                  <?php echo '<p class="status-msg error">' . $this->session->flashdata('msg') . '</p>' ?>

                  <!-- ACCOUNT INFORMATION -->
                  <div class="tab mb-4">
                     <div class="account_information">
                        <p class="section-head">General Information:</p>
                        <h6 class="form-table-title">Tick any one of the options given below</h6>
                     </div>

                     <div class="row mb-lg-4">
                        <!-- Religion -->
                         <div class="col-md-12">
                           <div class="heading-line mt-3 mb-2">
                             <h6>Religion</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6" id="religion">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="religion" value="Hindu">
                                       <label class="form-check-label">Hindu</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="religion" value="Buddhist">
                                       <label class="form-check-label">Buddhist</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="religion" value="Muslim">
                                       <label class="form-check-label">Muslim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="religion" value="Christian">
                                       <label class="form-check-label">Christian</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="religion" id="religion_others" value="others">
                                       <label class="form-check-label">others</label>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="religion_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>


                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>What do you prefer calling yourself?</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="region" value="Himali">
                                       <label class="form-check-label">Himali</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="region" value="Pahadi">
                                       <label class="form-check-label">Pahadi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="region" value="Madhesi">
                                       <label class="form-check-label">Madhesi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="region" value="Backward community">
                                       <label class="form-check-label">Backward community</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="region" id="region_others" value="others">
                                       <label class="form-check-label">others</label>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="region_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>In which ethnic group do you keep yourself?</h6>
                           </div>
                           <div class="alert-custom alert-custom-info d-flex align-items-center">
                              <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> Ethnic group : Aadibasi/ Janajapt / Dalit / Vaishya / Madhesi ! Required to upload your Scanned Inclusion Group समूह प्रमाणपत्र अपलोड गर्नु पर्नेहुन्छ |
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6" id="ethnicity">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Aadibasi/Janajati">
                                       <label class="form-check-label">Aadibasi/Janajati</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Dalit">
                                       <label class="form-check-label">Dalit</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Vaishya">
                                       <label class="form-check-label">Vaishya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Chhetri">
                                       <label class="form-check-label">Chhetri</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Brahman">
                                       <label class="form-check-label">Brahman</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Madhesi">
                                       <label class="form-check-label">Madhesi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" value="Mushalman">
                                       <label class="form-check-label">Mushalman</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="ethnicity" id="ethnic_others" value="others">
                                       <label class="form-check-label">others</label>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="ethnicity_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group mt-3" id="ethnicity_file" style='display:none;' >
                                    <input class="form-control btn-input form-control-file" type="file" name="ethnicity_file" />
                                    <small class="text-danger">Photo must be smaller than 1MB in image format JPEG/JPG/PNG</small>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Marital status</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="marital" value="Married">
                                       <label class="form-check-label">Married</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="marital" value="Unmarried">
                                       <label class="form-check-label">Unmarried</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="marital" value="Widow">
                                       <label class="form-check-label">Widow/widower</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="marital" value="Divorcee">
                                       <label class="form-check-label">Divorcee</label>
                                    </div>
                                 </div>
                              </div>      
                           </div>
                           <?php echo form_error('marital', '<p class="help-block error">', '</p>');  ?>
                        </div>
                     </div>

                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Employment status</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="employment" value="Unmployed">
                                       <label class="form-check-label">Unmployed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="employment" value="Government Service">
                                       <label class="form-check-label">Government Service</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" id="others-req" type="radio" name="employment" value="others">
                                       <label class="form-check-label"> Others</label>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="employment_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                              <h6>Are you Physically Disabled ?</h6>
                           </div>
                           <div class="alert-custom alert-custom-info d-flex align-items-center">
                              <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> Yes, if you are ! Required to upload your Scanned Inclusion Group यदी हो भने अपाङ्ग समूह प्रमाणपत्र अपलोड गर्नु पर्नेहुन्छ |
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="disability" id="disability_yes" value="Yes">
                                       <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="disability" id="disability_no" value="No">
                                       <label class="form-check-label">No</label>
                                    </div>
                                 </div>
                                 <div class="form-group mt-4" id="disability_file" style='display:none;'>
                                    <input accept="image/png, image/jpeg" class="form-control btn-input form-control-file" type="file" name="disability_file" required />
                                    <small class="text-danger">Photo must be smaller than 1MB in image format JPEG/JPG/PNG</small>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="disability_input" id="disability_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mb-lg-4">
                        <div class="col-md-6">
                           <div class="heading-line mb-2">
                              <h6>Mother Tongue </h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="mother_tongue" placeholder="enter mother tongue">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="heading-line mb-2">
                              <h6>Blood Group</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <select class="form-control" name="blood_group" id="blood_group">
                                      <option value="">---</option>
                                      <?php foreach ($blood_groups as $blood_group) { ?>
                                        <option value="<?php echo $blood_group['BLOOD_GROUP_ID'] ?>"><?php echo $blood_group['BLOOD_GROUP_CODE'] ?></option>
                                      <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                              <h6>Are you NOC Employee?</h6>
                           </div>
                           <div class="alert-custom alert-custom-info d-flex align-items-center">
                              <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> Yes, if you are NOC Employee ! Required to upload your Scanned ID Card यदी हो भने NOC ID Card अपलोड गर्नु पर्नेहुन्छ |
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <select class="form-control" name="in_service" id="in_service">
                                       <option>---</option>
                                       <option value="Y">Yes</option>
                                       <option value="N">No</option>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group" id="inservice_file" style='display:none;'>
                                    <input class="form-control btn-input form-control-file" type="file" name="inservice_file"  accept="image/png,image/jpeg"  />
                                    <small class="text-danger">Photo must be smaller than 1MB in image format JPEG/JPG/PNG</small>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>

                  </div>


                  <!-- PERSONAL INFORMATION -->
                  <div class="tab mb-4">
                     <div class="account_information">
                        <p class="section-head">Personal Information:</p>
                        <h6 class="form-table-title">Please fillup all required field (*)</h6>
                     </div>


                     <div class="row mb-lg-4">
                        <!-- Religion -->
                         <div class="col-md-12">
                           <div class="heading-line mt-3 mb-2">
                             <h6>Basic Information</h6>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="dateOfBirth_bs">Date of Birth (A.D) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="dateOfBirth_ad" id="dateOfBirth_ad" data-single="true" placeholder="Select Date(AD)">
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="dateOfBirth_bs">Date of Birth (B.S) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="dateOfBirth_bs" id="dateOfBirth_bs" data-single="true" placeholder="Date in BS" readonly>
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="age">Age <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="age" id="age" placeholder="enter age">
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="phone_no">Phone Number</label>
                                    <input type="text" name="phone_no" class="form-control" placeholder="enter phone number">
                                 </div>
                              </div>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="gender">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" placeholder="Gender">
                                       <option>Select Gender</option>
                                       <option value="1">Male</option>
                                       <option value="2">Female</option>
                                       <option value="3">Other</option>
                                     </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mb-lg-4">
                         <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Citizenship</h6>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="Citizenship_no">Citizenship Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="citizenship_no" id="Citizenship_no" placeholder="enter Citizenship number">
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="Issued_date_bs">Issue Date (B.S) <span class="text-danger">*</span></label>
                                    <input type="text" name="issued_date_bs" class="date-picker form-control" id="Issue_date_bs" data-single="true" placeholder="Date in BS" readonly>
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="Issued_date_ad">Issue Date (A.D) <span class="text-danger">*</span></label>
                                    <input type="text" name="issued_date_ad" class="date-picker form-control" id="Issue_date_ad" data-single="true" placeholder="Select Date(BS)">
                                 </div>
                              </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                    <label for="Issuedistrict">Issue District <span class="text-danger">*</span></label>
                                    <select class="form-control" id="districtSelect2" name="issuedistrict">
                                      <option value="">--Select District--</option>
                                      <?php foreach ($districts as $district) { ?>
                                        <option value="<?php echo $district['DISTRICT_ID'] ?>"><?php echo $district['DISTRICT_NAME'] ?></option>
                                      <?php } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>


                     <div class="row mb-lg-4">
                         <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Family</h6>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="father_name">Father Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="father_name" placeholder="Father Name" name="father_name" placeholder="enter father name">
                                 </div>
                              </div>

                              <div class="col-lg-8">
                                 <div class="form-group">
                                    <label for="fatherEdu">Father's qualification <span class="text-danger">*</span></label>
                                    <br/>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fatherEdu" value="Literate">
                                       <label class="form-check-label">Literate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fatherEdu" value="Illiterate">
                                       <label class="form-check-label">Illiterate</label>
                                    </div>
                                       <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fatherEdu" value="Upto SLC">
                                       <label class="form-check-label">Upto SLC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fatherEdu" value="Higher Education">
                                       <label class="form-check-label">Higher Education</label>
                                    </div>
                                 </div>
                              </div>
                           </div>


                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mother_name">Mother Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="mother_name" placeholder="Enter mother name" name="mother_name">
                                 </div>
                              </div>

                              <div class="col-lg-8">
                                 <div class="form-group">
                                    <label for="motherEDU">Mother's qualification <span class="text-danger">*</span></label>
                                    <br/>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="motherEdu" value="Literate">
                                       <label class="form-check-label">Literate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="motherEdu" value="Illiterate">
                                       <label class="form-check-label">Illiterate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="motherEdu" value="Upto SLC">
                                       <label class="form-check-label">Upto SLC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="motherEdu" value="Higher Education">
                                       <label class="form-check-label">Higher Education</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mb-lg-4">
                        <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Father / Mother's main occupation</h6>
                           </div>
                           <small class="text-danger">(required *)</small>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" value="Agriculture">
                                       <label class="form-check-label">Agriculture</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" value="Business">
                                       <label class="form-check-label">Business</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" value="Teaching (Private/Government)">
                                       <label class="form-check-label">Teaching (Private/Government)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" value="Non-Government">
                                       <label class="form-check-label">Non-Government</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" value="Government service">
                                       <label class="form-check-label">Government service</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="fmoccupation" id="fm_occupation_others" value="others">
                                       <label class="form-check-label">others</label>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group row">
                                    <label class="col-lg-4">Specify if any other</label>
                                    <div class="col-lg-8">
                                      <input type="text" class="form-control form-control-sm" name="fm_occupation_input" placeholder="specify if any other">
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="grandfather_name">Grandfather Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control" name="grandfather_name" placeholder="Grandfather's Name">
                                    <?php echo form_error('grandfather_name', '<p class="help-block error">', '</p>');  ?>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="grandfather_nationality">Nationality <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control" name="grandfather_nationality" placeholder="Grandfather's Nationality">
                                 </div>
                              </div>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="spouse_name">Husband / Wife Name <small class="text-muted">(if married)</small></label>
                                    <input type="text" class="form-control form-control" name="spouse_name" placeholder="husband or wife name">
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="spouse_nationality">Nationality</label>
                                    <input type="text" class="form-control form-control" name="spouse_nationality" placeholder="Nationality">
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>


                  </div>

                  <!-- ADDRESS -->
                  <div class="tab mb-4">
                     <div class="account_information">
                        <p class="section-head">Address Information:</p>
                        <h6 class="form-table-title">Please fillup all required field (*)</h6>
                     </div>


                     <div class="row mb-lg-4">
                         <div class="col-md-12">
                           <div class="heading-line mt-3 mb-2">
                             <h6>Permanent Address <small>(As per Citizenship)</small></h6>
                           </div>

                           <div class="alert-custom alert-custom-info d-flex align-items-center">
                              <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> On selection Province, District loads on itself please wait few seconds while selecting DISTRICT
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_province">Province <span class="text-danger">*</span></label>
                                    <select name="per_province" class="form-control form-control-sm" id="per_province" required>
                                       <option value="">-- Select --</option>
                                       <?php foreach ($proviences as $provience) { ?>
                                       <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_district">District <span class="text-danger">*</span></label>
                                    <select name="per_district" class="form-control form-control-sm" id="per_district">
                                       <option value="">----</option>

                                    </select>
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_vdc">Muicipality / VDC <span class="text-danger">*</span></label>
                                    <select name="per_vdc" class="form-control form-control-sm" id="per_vdc">
                                       <option value="">----</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_ward">Ward Number <span class="text-danger">*</span></label>
                                    <input type="number" name="per_ward" class="form-control form-control-sm">
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_tole">Tole Name <span class="text-danger">*</span></label>
                                    <input type="text" name="per_tole" class="form-control form-control-sm">
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="per_house_no">House Number</label>
                                    <input type="text" name="per_house_no" class="form-control form-control-sm">
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>

                     <div class="row mb-lg-4">
                         <div class="col-md-12">
                           <div class="heading-line mb-2">
                             <h6>Mailing Address</h6>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mail_province">Province <span class="text-danger">*</span></label>
                                    <select name="mail_province" class="form-control form-control-sm" id="mail_province">
                                       <option value="">-- Select --</option>
                                       <?php foreach ($proviences as $provience) { ?>
                                       <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mail_district">District <span class="text-danger">*</span></label>
                                    <select name="mail_district" class="form-control form-control-sm" id="mail_district">
                                       <option value="">----</option>

                                    </select>
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mail_vdc">Muicipality/VDC <span class="text-danger">*</span></label>
                                    <select name="mail_vdc" class="form-control form-control-sm" id="mail_vdc">
                                       <option value="">----</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row card-inner">
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mail_ward">Ward Number <span class="text-danger">*</span></label>
                                    <input type="number" name="mail_ward" class="form-control form-control-sm">
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mail_tole">Tole Name <span class="text-danger">*</span></label>
                                    <input type="text" name="mail_tole" class="form-control form-control-sm">
                                 </div>
                              </div>

                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label for="mali_house_no">House Number</label>
                                    <input type="text" name="mali_house_no" class="form-control form-control-sm">
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>

                  </div>


                  <div class="row justify-content-end">
                     <div>
                        <span class="step">1</span>
                        <span class="step">2</span>
                        <span class="step">3</span>
                     </div>


                     <div class="next-btn" >
                        <button type="button" class="btn previous">Previous</button>
                        <button type="button" class="btn btn-noc next text-light">Next</button>
                        <button type="submit" name="registration" value="submit" class="submit btn btn-noc">Submit</button>
                     </div>
                     
                  </div>


               </form>
            </div>

         </div>
      </div>
   </div>
</section>


<script type='text/javascript' src='<?php echo base_url('assets/js/Datepicker/custom.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>'></script>
<script type="text/javascript">
  // window.onload = function() {
  //   var mainInput = document.getElementById("nepali-datepicker");
  //   var dobInput = document.getElementById("dateOfBirth");
  //   dobInput.nepaliDatePicker({
  //     dateFormat: "YYYY-MM-DD",
  //     ndpYear: true,
  //     ndpMonth: true
  //   });
  //   mainInput.nepaliDatePicker({
  //     dateFormat: "YYYY-MM-DD",
  //     ndpYear: true,
  //     ndpMonth: true
  //   });
  // };

  $(document).ready(function() {
    app.startEndDatePickerWithNepali('dateOfBirth_bs', 'dateOfBirth_ad', 'Issue_date_bs', 'Issue_date_ad');

    $("input[type=radio][name=ethnicity]").on('change', function() {
      // alert ('Hello');
      if (this.value == 'others') {
        $("input[name='ethnicity_input']").prop('required', true);
      } else {
        $("input[name='ethnicity_input']").removeAttr('required');
      }
    });
    // Ethnic Name

    // Religion
    $('input[type=radio][name=religion]').on('change', function() {
      // alert ('dHello');
      if (this.value == 'others') {
        $("input[name='religion_input']").prop('required', true);
      } else {
        $("input[name='religion_input']").removeAttr('required');
      }
    });
    // Region
    $('input[type=radio][name=region]').on('change', function() {
      // alert ('dHello');
      if (this.value == 'others') {
        $("input[name='region_input']").prop('required', true);
      } else {
        $("input[name='region_input']").removeAttr('required');
      }
    });
    // Father Mother Occupation
    $("input[type=radio][name=fmoccupation]").click(function() {
      if (this.value == 'others') {
        $("input[name='fm_occupation_input']").prop('required', true);
      } else {
        $("input[name='fm_occupation_input']").removeAttr('required');
      }
    });

  });
</script>
<script type='text/javascript' src='<?php echo base_url('assets/js/regform.js'); ?>'></script>