<link href="<?= base_url(); ?>assets/css/register.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<section class="recruitment-form-sec">
  <form id="myForm" method="post" enctype="multipart/form-data">
    <h2>NOC | Registration Form</h2>
    <!-- One "tab" for each step in the form: -->
    <?php //if(isset($registerData)){ //echo $registerData;} 
    ?>
    <?php echo '<p class="status-msg error">' . $this->session->flashdata('msg') . '</p>' ?>
    <!--1. Account Information -->
    <div class="tab">
      <p class="section-head">Personal Information:</p>
      <h6 class="form-table-title">Tick any one of the options given below</h6>
      <!-- Religion -->
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">Religion</p>
          </div>
          <div class="col-lg-5" id="religion">
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
          <div class="col-lg-5">
            <div class="form-group row">
              <label class="col-lg-5">Specify if any other</label>
              <div class="col-lg-7">
                <input type="text" class="form-control form-control-sm" name="religion_input">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- What do you prefer calling yourself? -->
      <hr>
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">What do you prefer calling yourself?</p>
          </div>
          <div class="col-lg-5">
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
          <div class="col-lg-5">
            <div class="form-group row">
              <label class="col-lg-5">Specify if any other</label>
              <div class="col-lg-7">
                <input type="text" class="form-control form-control-sm" name="region_input">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ethnic group do you keep yourself? -->
      <hr>
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">In which ethnic group do you keep yourself?</p>
          </div>
          <div class="col-lg-5" id="ethnicity">
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
            <input class="form-control btn-input form-control-file" type="file" name="ethnicity_file" id="ethnicity_file" style='display:none;margin-left:12px' />
          </div>
          <div class="col-lg-5">
            <div class="form-group row">
              <label class="col-lg-5">Specify if any other</label>
              <div class="col-lg-7">
                <input type="text" class="form-control form-control-sm" name="ethnicity_input">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Marital status -->
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">Marital status</p>
          </div>
          <div class="col-lg-10">
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
        <?php echo form_error('marital', '<p class="help-block error">', '</p>');  ?>
      </div>
      <hr>
      <!-- Employment status -->
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">Employment status</p>
          </div>
          <div class="col-lg-5">
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
          <div class="col-lg-5">
            <div class="form-group row">
              <label class="col-lg-5">Specify if any other</label>
              <div class="col-lg-7">
                <input type="text" class="form-control form-control-sm" name="employment_input">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Physical disability -->
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">Physical disability</p>
          </div>
          <div class="col-lg-5">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="disability" id="disability_yes" value="Yes">
              <label class="form-check-label">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="disability" id="disability_no" value="No">
              <label class="form-check-label">No</label>
            </div>
            <input class="form-control btn-input form-control-file" type="file" name="disability_file" id="disability_file" style='display:none;margin-left:12px' />
          </div>

          <div class="col-lg-5">
            <div class="form-group row">
              <label class="col-lg-5">Specify the type if any</label>
              <div class="col-lg-7">
                <input type="text" class="form-control form-control-sm" name="disability_input" id="disability_input">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Mother Tongue -->
      <div class="col-md-12">
        <div class="row card-inner">
          <div class="col-lg-2">
            <p class="sm-bold-text">Mother tongue</p>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control form-control-sm" name="mother_tongue">
          </div>
          <!-- Blood group -->
          <div class="col-lg-2">
            <p class="sm-bold-text">Blood Group</p>
          </div>
          <div class="col-lg-3">
            <select class="form-control" name="blood_group" id="blood_group">
              <option value="">---</option>
              <?php foreach ($blood_groups as $blood_group) { ?>
                <option value="<?php echo $blood_group['BLOOD_GROUP_ID'] ?>"><?php echo $blood_group['BLOOD_GROUP_CODE'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row card-inner">
          <!-- IN SERVICE -->
          <div class="col-lg-2">
            <p class="sm-bold-text">Are you NOC Employee?</p>
          </div>
          <div class="col-lg-3">
            <select class="form-control" name="in_service" id="in_service">
              <option value="">---</option>
              <option value="Y">Yes</option>
              <option value="N">No</option>
            </select>
          </div>
          <div class="col-lg-4">
            <input class="form-control btn-input form-control-file" type="file" name="inservice_file" id="inservice_file" style='display:none;margin-left:12px' />

          </div>
        </div>
      </div>
    </div>
    <!--2. Personal Information -->
    <div class="tab">
      <p class="section-head">Personal Information:</p>
      <!-- Citizenship Number -->
      <div class="row">
        <div class="form-group col-4">
          <label for="Citizenship_no">Citizenship Number</label>
          <input type="text" class="form-control" name="Citizenship_no" id="Citizenship_no" placeholder="1234/56">
        </div>
        <div class="form-group col-4">
          <label for="Issued_date">Issue Date</label>
          <p>
            <input type="text" name="Issued_date_bs" class="date-picker form-control" id="Issue_date_ad" data-single="true" placeholder="Select Date(BS)">
            <input type="text" name="Issued_date" class="date-picker form-control" id="Issue_date_bs" data-single="true" placeholder="Date in BS" readonly>
          </p>
        </div>
        <div class="form-group col-4">
          <label for="Issuedistrict">Issue District</label>
          <p><select class="form-control" id="districtSelect2" name="Issuedistrict">
              <option value="">--Select District--</option>
              <?php foreach ($districts as $district) { ?>
                <option value="<?php echo $district['DISTRICT_ID'] ?>"><?php echo $district['DISTRICT_NAME'] ?></option>
              <?php } ?>
            </select></p>
        </div>
      </div>
      <!-- Date of Birth -->
      <div class="row">
        <div class="form-group col-3">
          <label for="dateOfBirth_bs">Date of Birth</label>
          <p>
            <input type="text" class="form-control" name="dateOfBirth_bs" id="dateOfBirth_ad" data-single="true" placeholder="Select Date(AD)">
            <input type="text" class="form-control" name="dateOfBirth" id="dateOfBirth_bs" data-single="true" placeholder="Date in BS" readonly>
          </p>
        </div>
        <div class="form-group col-1">
          <label for="age">Age</label>
          <input type="text" class="form-control" name="age" id="age" placeholder="xx">
        </div>
        <div class="form-group col-4">
          <label for="phone_no">Phone Number</label>
          <p><input type="text" name="phone_no" class="form-control" placeholder="01123456"></p>
        </div>
        <div class="form-group col-4">
          <label for="phone_no">Gender</label>
          <select class="form-control" id="gender" name="gender" placeholder="Gender">
            <option value="">Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Other</option>
          </select>
        </div>
      </div>
      <!-- Family Information: -->
      <hr>
      <p class="section-head">Family Information:</p>
      <hr>
      <!-- Father Qualification -->
      <div class="row">
        <p class="col-4"><input class="form-control" type="text" placeholder="Father Name" name="father_name"></p>
        <div class="col-md-10">
          <div class="row card-inner">
            <div class="col-lg-2">
              <p class="sm-bold-text">Father's qualification</p>
            </div>
            <div class="col-lg-8">
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
      </div>
      <hr>
      <div class="row">
        <p class="col-4"><input class="form-control" type="text" placeholder="Mother Name" name="mother_name"></p>
        <div class="col-md-10">
          <div class="row card-inner">
            <div class="col-lg-2">
              <p class="sm-bold-text">Mother's qualification</p>
            </div>
            <div class="col-lg-8">
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
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="row card-inner">
            <div class="col-lg-2">
              <p class="sm-bold-text">Father/Mother's main occupation</p>
            </div>
            <div class="col-lg-5">
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
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-lg-5">Specify if any other</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control form-control-sm" name="fm_occupation_input">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!-- Grand Father Section -->
      <div class="row">
        <p class="col-4">
          <input type="text" class="form-control form-control" name="grandfather_name" placeholder="Grandfather's Name">
          <?php echo form_error('grandfather_name', '<p class="help-block error">', '</p>');  ?>
        </p>
        <p class="col-4">
          <select class="form-control form-control" name="grandfather_nationality">
            <option selected disabled>Nationality</option>
            <option>Nepali</option>
            <option>Others</option>
          </select>
        </p>
      </div>
      <div class="row">
        <div class="col-4">
          <p><input type="text" class="form-control form-control" name="spouse_name" placeholder="Spouse name (if married)"></p>
        </div>
        <div class="col-4">
          <div class="form-group">
            <p>
              <select class="form-control form-control" name="spouse_nationality">
                <option selected disabled>Nationality</option>
                <option value="Nepali">Nepali</option>
                <option value="others">Others</option>
              </select>
            </p>
          </div>
        </div>
      </div>

    </div>
    <!--3. Address -->
    <div class="tab">
      <!-- Permanent Address -->
      <p class="section-head">Permanent Address (As per Citizenship)</p>
      <div class="row">
        <div class="form-group col-4">
          <label for="per_province">Provience</label>
          <input type="hidden" id="base" value="<?php echo base_url(); ?>">
          <p><select name="per_province" class="form-control form-control-sm" id="per_province">
              <option value="">-- Select --</option>
              <?php foreach ($proviences as $provience) { ?>
                <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
              <?php } ?>
            </select></p>
        </div>
        <div class="form-group col-4">
          <label for="per_district">District</label>
          <select name="per_district" class="form-control form-control-sm" id="per_district">
            <option value="">----</option>

          </select>
        </div>
        <div class="form-group col-4">
          <label for="per_province">Muicipality/VDC</label>
          <select name="per_vdc" class="form-control form-control-sm" id="per_vdc">
            <option value="">----</option>

          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-4">
          <label for="per_ward">Ward Number</label>
          <input type="number" name="per_ward" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
          <label for="per_tole">Tole Name</label>
          <input type="text" name="per_tole" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
          <label for="per_tole">House Number</label>
          <input type="text" name="per_house_no" class="form-control form-control-sm">
        </div>
      </div>
      <!-- Mailling Address -->
      <hr>
      <p class="section-head">Mailling Address</p>
      <div class="row">
        <div class="form-group col-4">
          <label for="mail_province">Provience</label>
          <select name="mail_province" class="form-control form-control-sm" id="mail_province">
            <option value="">-- Select --</option>
            <?php foreach ($proviences as $provience) { ?>
              <option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-4">
          <label for="mail_district">District</label>
          <select name="mail_district" class="form-control form-control-sm" id="mail_district">
            <option value="">----</option>

          </select>
        </div>
        <div class="form-group col-4">
          <label for="mail_vdc">Muicipality/VDC</label>
          <select name="mail_vdc" class="form-control form-control-sm" id="mail_vdc">
            <option value="">----</option>

          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-4">
          <label for="mail_ward">Ward Number</label>
          <input type="number" name="mail_ward" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
          <label for="mail_tole">Tole Name</label>
          <input type="text" name="mail_tole" class="form-control form-control-sm">
        </div>
        <div class="form-group col-4">
          <label for="per_tole">House Number</label>
          <input type="text" name="mail_house_no" class="form-control form-control-sm">
        </div>
      </div>
    </div>
    <!-- <div class="tab"> Info:
      
	  </div> -->
    <div style="overflow:auto;">
      <hr>
      <div style="float:right; margin-top: 5px;">
        <button type="button" class="previous">Previous</button>
        <button type="button" class="next">Next</button>
        <button type="submit" name="registration" value="submit" class="submit">Submit</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step">1</span>
      <span class="step">2</span>
      <span class="step">3</span>
      <!-- <span class="step">4</span> -->
    </div>
  </form>
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