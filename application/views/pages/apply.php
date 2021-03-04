<main class="main-recruit-application bg-light sec-padd">
	<section class="top-info-sec">
			 <div class="container-fluid">
			 	<div class="row">
                 <div class="col-md-3">
			 		</div>
			 		<div class="col-md-6">
			 			<div class="text-center">
				 			<h6>Schedule 2</h6>
				 			<h6>Nepal Oil Corporation Limited</h6>
				 			<h6>Application form for new recruitment</h6>
			 			</div>
			 		</div>
			 	</div>
			 </div>
	</section>
	<section class="recruitment-form-sec sec-padd">
        <!-- <form method="post" enctype="multipart/form-data"> -->
			<?php echo form_open_multipart(); ?>
			<?php echo form_hidden('vid', $this->uri->segment('3')); ?>
			<?php  
				if(!empty($success_msg)){ 
					echo '<p class="status-msg success">'.$success_msg.'</p>'; 
				}elseif(!empty($error_msg)){ 
					echo '<p style="text-align: center;" class="status-msg error">'.$error_msg.'</p>'; 
				} ?>
			<div class="container">
            <?php foreach($vacancylists as $vacancylist){ ?>
				<a href="<?php echo base_url('vacancy') ?>" style="text-align: right;"><h6>View all vacancies</h6></a>
				<!-- A. Detail regarding the post filled by the candidate in the application form -->
				<div class="card">
					<h6 class="form-table-title">A. Detail regarding the post filled by the candidate in the application form</h6>
					<div class="col-md-10">                    
						<table class="table table-responsive-md table-sm form-cstm-table">
							<tr>
								<td>
									<div class="form-group">
										<label for="AD_NO">Advertisement No.</label>
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO'] ?>" readonly>
										<input type="text" name="AD_NO" class="form-control form-control-sm" value="<?php echo $vacancylist['VACANCY_ID'] ?>" hidden>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="REG_NO">Registration No. *</label>
										<input type="text" name="REG_NO" class="form-control form-control-sm" value="xx-xx-xxx" readonly>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="REG_DT">Registration Date</label>
										<input type="date" name="REG_DT" class="form-control form-control-sm " value="<?php echo date('Y-m-d'); ?>">
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-responsive-md table-sm form-cstm-table">
							<tr>
								<td>
									<p for="POSITION_ID">Post:</p>
									<select name="POSITION_ID" class="form-control form-control-sm">
											<option value="<?php echo $vacancylist['DESIGNATION_ID'] ?>"><?php echo $vacancylist['DESIGNATION_TITLE']; ?></option>
									</select>
								</td>
								<td>
									<p>Level:</p>
									<h6 style="font-size: 12px;font-weight: bold;">1st</h6>
								</td>
								<td>
									<p>Examination center:</p>
									<h6 style="font-size: 12px;font-weight: bold;">Bhaktapur</h6>
								</td>
								<td width="30%">
									<p>Other detail:</p>
									<h6 style="font-size: 12px;font-weight: bold;">मान्यता प्राप्त विश्वविद्यालयबाट अर्थशास्त्र, कानून, ब्यवस्थापन, सूचना प्रविधि विषयमा प्रथम श्रेष्णीमा स्नातकोत्तर तह उत्तिर्ण भई र नेपाल राष्ट्र बैंकबाट "क" वर्गको ईजाजत प्राप्त बैक तथा वित्तीय संस्थामा अधिकृत स्तरको पदमा कम्तिमा ७ बर्षको कार्य अनुभव भएको ।</h6>
								</td>
							</tr>
						</table>
					</div>
				</div>
                <?php }?>
				<!-- B. Personal Information of Applicant -->
				<div class="card mt-3">
					<h6 class="form-table-title">B. Personal Information of Applicant</h6>
					<div class="col-md-12">
						<table class="table table-responsive-md table-sm form-cstm-table">
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="FULL_NAME_NP">Full Name (In Devnagari)</label>
										<input type="text" name="FULL_NAME_NP" class="form-control form-control-sm" value="<?php if(isset($post)) { echo $post['FULL_NAME_NP'];}?>">
										<?php echo form_error('FULL_NAME_NP','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
								<td colspan="3">
									<div class="form-group">
										<label for="FULL_NAME_EN">Full Name (In English)</label>
										<input type="text" name="FULL_NAME_EN" class="form-control form-control-sm" value="<?php echo $user['FIRST_NAME'].' '. $user['MIDDLE_NAME'].' '.$user['LAST_NAME']; ?>" readonly>
										<?php echo form_error('FULL_NAME_EP','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="GENDER_ID">Gender</label>
										<select name="GENDER_ID" class="form-control form-control-sm">
											<option value="<?php echo $user['GENDER'] ?>"><?php echo $user['GENDER_NAME']; ?></option>
											<?php echo form_error('GENDER_ID','<p class="help-block error">','</p>'); ?>
										</select>
									</div>
								</td>
                                <td>
									<div class="form-group">
										<label for="AGE">Age</label>
										<input type="number" name="AGE" class="form-control form-control-sm" id="age1" onkeyup="ageValid(); return false;" value="<?php if(isset($post)) { echo $post['AGE'];}?>">
										<?php echo form_error('AGE','<p class="help-block error">','</p>'); ?>
									</div>
									<span class="form-group col-md-12" id="demo" style="font-size: 10px;color: red"></span>
								</td>
								<td></td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
							<table class="table table-responsive-lg table-sm form-cstm-table">
								<tr>
									<th scope="row" style="vertical-align: middle; width: 5%;">
										Date of Birth
									</th>
									<th width="5%" style="text-align: right;">
										<div class="form-check" style="margin-top: 35px;">
											<input class="form-check-input" type="checkbox" id="DOB_NP">
											<label class="form-check-label" for="DOB_NP">
											BS</label>
										</div>
									</th>
									<td width="10%">
										<div class="form-group">
											<label for="exampleFormControlInput1">Date</label>
											<input type="date" name="DOB_NP" class="form-control form-control-sm"  style="width:200px">
										</div>
										<?php echo form_error('DOB_NP','<p class="help-block error">','</p>'); ?>
									</td>
									<th width="5%" style="text-align: right;">
										<div class="form-check" style="margin-top: 35px;">
											<input class="form-check-input" type="checkbox" value="" id="ADcheck">
											<label class="form-check-label" for="ADcheck">
											AD</label>
											
										</div>
									</th>
									<td width="15%">
										<div class="form-group">
											<label for="">Date</label>
											<input type="date" class="form-control form-control-sm" name="DOB_EN" style="width:200px">
											<?php echo form_error('DOB_EN','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
								</tr>
							</table>
					</div>
				</div>
				<!-- C. Group wanted to join -->
				<div class="card mt-3">
					<h6 class="form-table-title">C. Group wanted to join * (In case of inclusion, when applying to any group other than women, the certificate must be uploaded in the "Documents" tab)</h6>
					<div class="col-md-12">
						<table class="table table-responsive-md table-sm form-cstm-table">
							<tr>
								<th style="border-right: 1px solid #dee2e6;">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="OPTION_ID">
										<label class="form-check-label" for="OPTION_ID">
									    Open Competition
										</label>
									</div>
								</th>
								<th>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="INCLUSIVE_ID">
										<label class="form-check-label" for="INCLUSIVE_ID">
									    Inclusion
										</label>
									</div>
								</th>
								<td width="35%" style="border-right: 1px solid #dee2e6;">
                                <?php foreach($options as $option) {  ?>
									<div class="form-group form-check form-check-inline">
									 	<input class="form-check-input" type="radio" name="INCLUSIVE_ID"  value="<?php echo $option['OPTION_ID'] ?>">
									 	<label class="form-check-label" for="inlineRadio1"><?php echo $option['OPTION_EDESC'] ?></label>
									</div>
                                    <?php echo form_error('inclusive','<p class="help-block error">','</p>'); ?>
                                    <?php } ?>
								</td>
								<th>Total fee for this application form is Rs</th>
								<td name="AMOUNT" value="<?php $option['NORMAL_AMT'];?>"><?php echo 'NPR: '. $option['NORMAL_AMT']; ?></td>
							</tr>
						</table>
					</div>
				</div>
				<!-- D. Address -->
				<div class="card mt-3">
					<h6 class="form-table-title">D. Address</h6>
					<!-- Permanent Address -->
					<div class="col-md-12">
						<table class="table table-responsive-md form-cstm-table">
							<tr>
								<th width="20%" rowspan="2" style="vertical-align: middle;">Permanent Address<br>(according to citizenship)</th>
								<td>
									<div class="form-group">
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
								</td>
								<td>
									<div class="form-group">
										<label for="PERMANENT_DISTRICT_ID">District</label>
										<select name="PERMANENT_DISTRICT_ID" class="form-control form-control-sm" id="per_district">
											<option value="">----</option>
																					
										</select>
										<?php echo form_error('PERMANENT_DISTRICT_ID','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="PERMANENT_VDC">Muicipality/VDC</label>
										<input type="number	" name="PERMANENT_VDC" class="form-control form-control-sm">
										<?php echo form_error('PERMANENT_VDC','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
							</tr>
							<tr>
								<td style="border-top:0">
									<div class="form-group">
										<label for="PERMANENT_WARD_ID">Ward Number</label>
										<input type="number	" name="PERMANENT_WARD_ID" class="form-control form-control-sm">
										<?php echo form_error('PERMANENT_WARD_ID','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
								<td style="border-top:0">
									<div class="form-group">
										<label for="PERMANENT_TOLE">Tole</label>
										<input type="text" name="PERMANENT_TOLE" class="form-control form-control-sm">
										<?php echo form_error('PERMANENT_TOLE','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
								<td style="border-top:0">
									<div class="form-group">
										<label for="PHONE_NO">Phone number</label>
										<input type="number" name="PHONE_NO" class="form-control form-control-sm">
										<?php echo form_error('PHONE_NO','<p class="help-block error">','</p>'); ?>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<!-- Mailling Address -->
					<div class="col-md-12">
						<table class="table table-responsive-md form-cstm-table">
						<tr>
							<th width="20%" rowspan="2" style="vertical-align: middle;">Mailing address</th>
							<td>
								<div class="form-group">
									<label for="MAILLING_PROVIENCE_ID">Provience</label>
									<select name="MAILLING_PROVIENCE_ID" class="form-control form-control-sm" id="mail_province">
										<option value="">-- Select --</option>
											<?php foreach($proviences as $provience) { ?>
												<option value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
											<?php } ?>
									</select>
									<?php echo form_error('MAILLING_PROVIENCE_ID','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="MAILLING_DISTRICT_ID">District</label>
										<select name="MAILLING_DISTRICT_ID" class="form-control form-control-sm" id="mail_district">
											<option value="">----</option>									
										</select>
										<?php echo form_error('MAILLING_DISTRICT_ID','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="MAILLING_VDC">Muicipality/VDC</label>
									<input type="text" name="MAILLING_VDC" class="form-control form-control-sm">
									<?php echo form_error('MAILLING_VDC','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td style="border-top:0">
								<div class="form-group">
									<label for="MAILLING_WARD_ID">Ward</label>
									<input type="number" name="MAILLING_WARD_ID" class="form-control form-control-sm">
									<?php echo form_error('MAILLING_WARD_ID','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td style="border-top:0">
								<div class="form-group">
									<label for="MAILLING_TOLE">Tole</label>
									<input type="text" name="MAILLING_TOLE" class="form-control form-control-sm">
									<?php echo form_error('MAILLING_TOLE','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td style="border-top:0">
								<div class="form-group">
									<label for="MOBILE_NO">Mobile No. (NTC/Ncell)</label>
									<input type="number" name="MOBILE_NO" class="form-control form-control-sm">
									<?php echo form_error('MOBILE_NO','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td style="border-top:0">
								<div class="form-group">
									<label for="EMAIL_ID">Email address</label>
									<input type="email" name="EMAIL_ID" class="form-control form-control-sm">
									<?php echo form_error('EMAIL_ID','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
						</tr>
						</table>
					</div>
				</div>
				<!-- E. Citizenship Details -->
				<div class="card mt-3">
					<h6 class="form-table-title">E. Citizenship Details</h6>
					<div class="col-md-10">
						<table class="table table-responsive-md table-sm form-cstm-table">
						<tr>
							<td colspan="2">
								<div class="form-group">
									<label for="CITIZENSHIP_NO">Citizenship No.</label>
									<input type="text" name="CITIZENSHIP_NO" class="form-control form-control-sm">
									<?php echo form_error('CITIZENSHIP_NO','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td colspan="3">
								<div class="form-group">
									<label for="CTZ_ISSUE_DATE">Issued Date</label>
									<input type="date" name="CTZ_ISSUE_DATE" class="form-control form-control-sm">
									<?php echo form_error('CTZ_ISSUE_DATE','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="CTZ_ISSUE_DISTRICT_ID">Issued District</label>
									<select name="CTZ_ISSUE_DISTRICT_ID" class="form-control form-control-sm" id="districtSelect2" style="position: inherit !important;">
											<option value="0">-- Select --</option>
											<?php foreach($districts as $district) { ?>												
												<option value="<?php echo $district['DISTRICT_ID'] ?>"><?php echo $district['DISTRICT_NAME'] ?></option>
											<?php } ?>
									</select>
									<?php echo form_error('CTZ_ISSUE_DISTRICT_ID','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td></td>
							<td></td>
						</tr>
						</table>
					</div>
				</div>
				<!-- F. Family Details -->
				<div class="card mt-3">
					<h6 class="form-table-title">F. Family Details</h6>
					<div class="col-md-12">
						<table class="table table-responsive-md table-sm form-cstm-table">
						<tr>
							<td colspan="2">
								<div class="form-group">
									<label for="FATHER_NAME">Father's Name:</label>
									<input type="text" name="FATHER_NAME" class="form-control form-control-sm">
									<?php echo form_error('FATHER_NAME','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td colspan="3">
								<div class="form-group">
									<label for="MOTHER_NAME">Mother's Name:</label>
									<input type="text" name="MOTHER_NAME" class="form-control form-control-sm">
									<?php echo form_error('MOTHER_NAME','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="SPOUSE_NAME">Spouse's Name (If married):</label>
									<input type="text" name="SPOUSE_NAME" class="form-control form-control-sm" placeholder="None">
									<?php echo form_error('SPOUSE_NAME','<p class="help-block error">','</p>'); ?>
								</div>
							</td>
							<td></td>
							<td></td>
						</tr>
						</table>
					</div>
				</div>
				<!-- G. Educational Qualification -->
				<div class="card mt-3">
					<h6 class="form-table-title">G. Educational Qualification</h6>
					<div class="col-md-12 mt-3">
						<table class="table table-responsive-md table-striped table-bordered table-sm" id="education">
							<thead>
								<tr>
									<th width="25%">Educational Institute</th>
									<th>Level</th>
									<th>Faculty</th>
									<th width="12%">Division</th>
									<th>Major Subject</th>
									<th>Passed Year</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="educationalbody">
								<tr>
									<td>
										<div for="EDUCATION_INSTITUTE" class="form-group">
											<input type="text" name="EDUCATION_INSTITUTE[]" class="form-control form-control-sm">
										</div>
										<?php echo form_error('EDUCATION_INSTITUTE','<p class="help-block error">','</p>'); ?>
									</td>
									<td>
										<div for="LEVEL_ID" class="form-group">
											<select name="LEVEL_ID[]" class="form-control form-control-sm">
												<option value="0">-- Select -- </option>
												<?php foreach($degrees as $degree) { ?>
													<option value="<?php echo $degree['ACADEMIC_DEGREE_ID'] ?>"><?php echo $degree['ACADEMIC_DEGREE_NAME'] ?></option>
												<?php } ?>
											</select>
											<?php echo form_error('LEVEL_ID','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
									<td>
										<div for="FACALTY" class="form-group">
											<input type="text" name="FACALTY[]" class="form-control form-control-sm">
											<?php echo form_error('FACALTY','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
									<td>
										<div for="DIVISION_ID" class="form-group">
											<select name="DIVISION_ID[]" class="form-control form-control-sm">
												<option value="0">-- Select -- </option>
											<?php foreach($divisions as $division) { ?>
												<option value="<?php echo $division['DIVISION_ID'] ?>"><?php echo $division['DIVISION_NAME'] ?></option>
												<?php } ?>
											</select>
											<?php echo form_error('DIVISION_ID','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
									<td>
										<div for="MAJOR_SUBJECT" class="form-group">
											<input type="text" name="MAJOR_SUBJECT[]" class="form-control form-control-sm">
											<?php echo form_error('MAJOR_SUBJECT','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
									<td>
										<div for="PASSED_YEAR" class="form-group">
											<input type="number" name="PASSED_YEAR[]" class="form-control form-control-sm">
											<?php echo form_error('PASSED_YEAR','<p class="help-block error">','</p>'); ?>
										</div>
									</td>
									<td>
										<i class="fa fa-plus-circle btn-add-edu" aria-hidden="true" style="color: green; cursor: pointer"></i>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- H. Experience Detail -->
				<div class="card mt-3">
					<h6 class="form-table-title">H. Experience Detail (Mention only if experience is required for the advertisement of the post filled in the application form)</h6>
					<div class="col-md-12 mt-3">
						<table class="table table-responsive-md table-striped table-bordered table-sm">
							<thead>
								<tr>
									<th width="20%">Organisation Name</th>
									<th>Post</th>
									<th>Service/Group</th>
									<th>Level</th>
									<th width="12%">Employee Type</th>
									<th>Start From</th>
									<th>Till Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="experiancebody">
								<tr>
									<td>
										<div for="ORGANISATION_NAME" class="form-group">
											<input type="text" name="ORGANISATION_NAME[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="POST_NAME" class="form-group">
											<input type="text" name="POST_NAME[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="SERVICE_NAME" class="form-group">
											<input type="text" name="SERVICE_NAME[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="LEVEL_ID" class="form-group">
											<input type="number" name="LEVEL_ID[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="EMPLOYEE_TYPE_ID" class="form-group">
											<select name="EMPLOYEE_TYPE_ID[]" class="form-control form-control-sm">
												<option></option>
												<option value="1">Permanent</option>
												<option value="2">Temporary</option>
												<option value="3">Contract</option>
											</select>
										</div>
									</td>
									<td>
										<div for="FROM_DATE" class="form-group">
											<input name="FROM_DATE[]" type="date" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="TO_DATE" class="form-group">
											<input name="TO_DATE[]" type="date" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<i class="fa fa-plus-circle btn-add-exp" aria-hidden="true" style="color: green; cursor: pointer"></i>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- I. Training Detail -->
				<div class="card mt-3">
					<h6 class="form-table-title">I. Training Detail</h6>
					<div class="col-md-12 mt-3">
						<table class="table table-responsive-md table-striped table-bordered table-sm">
							<thead>
								<tr>
									<th>Training Name</th>
									<th>Certificate</th>
									<th>From Date</th>
									<th>To Date</th>
									<th width="12%">Period (Days)</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="trainingbody">
								<tr>
									<td>
										<div for="TRAINING_NAME" class="form-group">
											<input type="text" name="TRAINING_NAME[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="CERTIFICATE_NAME" class="form-group">
											<input type="text" name="CERTIFICATE_NAME[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="FROM_DATE" class="form-group">
											<input type="date" name="TR_FROM_DATE[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="TO_DATE" class="form-group">
											<input type="date" name="TR_TO_DATE[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="PERIOD" class="form-group">
											<input type="number" name="PERIOD[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<div for="DESCRIPTION" class="form-group">
											<input type="text" name="DESCRIPTION[]" class="form-control form-control-sm">
										</div>
									</td>
									<td>
										<i class="fa fa-plus-circle btn-add-tr" aria-hidden="true" style="color: green; cursor: pointer"></i>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- J. Photograph and signature of Applicant (Maximum 1 mb) -->
				<div class="card mt-3">
					<h6 class="form-table-title">J. Photograph and signature of Applicant (Maximum 1 mb)</h6>
					<table class="table table-responsive-md table-sm form-cstm-table">
						<tr>
							<td>
								<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;"><h6 style="padding: 30px; font-size: 12px;">A recent photograph showing the full face</h6></div>
							</td>
							<td>
								<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;"><h6 style="padding: 30px;font-size: 12px;">Sign in a blank white paper, scan it and upload</h6></div>
							</td>
							<td>
								<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;"><h6 style="padding: 30px;font-size: 12px;">Take a finger print of your <span style="font-size: 17px;">Right hand</span> in a blank white paper, scan it and upload</h6></div>
							</td>
							<td>
								<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;"><h6 style="padding: 30px;font-size: 12px;">Take a finger print of your <span style="font-size: 17px;">Left hand</span> in a blank white paper, scan it and upload</h6></div>
							</td>
						</tr>
						<tr>
							<td style="border-top:0;">
								<div class="form-group upload-file">
									<input type="file" name="photograph" class="form-control-file" id="photograph">
									<?php if(isset($upload_error_photo)) {echo $upload_error_photo; } ?>
								</div>
							</td>
							<td style="border-top:0;">
								<div class="form-group upload-file">
									<input type="file" name="signature" class="form-control-file" id="signature">
									<?php if(isset($upload_error_sign)) {echo  $upload_error_sign;} ?>
								</div>
							</td>
							<td style="border-top:0;">
								<div class="form-group upload-file">
									<input type="file" name="fingerright" class="form-control-file" id="fingerRight">
									<?php if(isset($upload_error_right)) {echo $upload_error_right; } ?>
								</div>
							</td>
							<td style="border-top:0;">
								<div class="form-group upload-file">
									<input type="file" name="fingerleft" class="form-control-file" id="fingerLeft">
									<?php if(isset($upload_error_left)) {echo $upload_error_left; } ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<!-- K. Document and Certificate -->
				<!-- <div class="card mt-3">
					<h6 class="form-table-title">K. Document and Certificate</h6>
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div style="font-size: 12px;font-weight: bold;padding: 10px 0;">
									नागरिकताको प्रमाणपत्र र समावेशीको हक़मा समावेशीताको प्रमाणपत्रहरु अनिवार्य रूपमा upload गर्नु पर्नेछ। <br> (साईज: बढिमा 1 MB)
								</div>
								<table class="table table-responsive-md table-striped table-bordered table-sm">
									<thead>
										<tr>
											<th>File Name</th>
											<th>Size</th>
											<th>Name of Document</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
											<td>
										</tr>
										<tr>
											<td colspan="7">
												<a href="" class="bt btn-primary btn-apply" role="button" data-toggle="modal" data-target="#citizenshipModal"><i class="fa fa-plus-circle" aria-hidden="true" style="color: green;margin-right: 5px;"></i>New upload</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-12" style="font-size: 12px;font-weight: bold; padding-bottom: 20px; padding-top: 35px">
								शैक्षिक/समकक्षिताको प्रमाणपत्रहरु (सम्बन्धित पदको लागि आवश्यक अन्तिम शैक्षिक योग्यताको चारित्रिक, ट्रान्सक्रिप्ट तथा समकक्षिताको प्रमाणपत्र, कम्प्युटर तालिमको प्रमाणपत्र, अनुभव तथा विभागिय स्विकृतीपत्र र अन्य आवस्यक कागजात समेत समाबेश गर्ने)<br>
								New Upload मा Click गरी, अपलोड गर्न चाहेको डकुमेन्टको नाम छनौट गर्नुहोस् र पून New Upload मा Click गरी Save मा Click गर्नुहोस । <br>(साईज: बढिमा 1 MB)
								</div>
							<div class="col-md-8">
								
								<table class="table table-responsive-md table-striped table-bordered table-sm">
									<thead>
										<tr>
											<th>File Name</th>
											<th>Size</th>
											<th>Name of Document</th>										
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" class="form-control form-control-sm">
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="7">
												<a href="" class="bt btn-primary btn-apply" role="button" data-toggle="modal" data-target="#educationModal"><i class="fa fa-plus-circle" aria-hidden="true" style="color: green;margin-right: 5px;"></i>New upload</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div> -->
				<div class="mt-5">
					<input type="submit" class="btn btn-primary btn-noc mr-3" name="saveAndFinishLater" value="Save and Finish Later">
					<input type="submit" class="btn btn-primary btn-noc" name="applySubmit" value="Save and Submit">
				</div>
			</div>
        <?php echo form_close(); ?>
	</section>
</main>

<!-- citizenship Modal -->
<div class="modal fade " id="citizenshipModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="citizenshipModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content main-recruit-application">
				<div class="modal-header form-table-title" style="border:0;">
					<h6 class="modal-title" id="staticBackdropLabel">Document and Certificate</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-form" style="background-color: #8fb6cc; padding:10px 10px;">
					<div class="modal-body" style="background-color: #fff; padding:0 10px 10px;">
						<div class="form-group">
							<label for="exampleFormControlInput1">Name</label>
							<select class="form-control form-control-sm" id="exampleFormControlSelect1">
								<option></option>
								<option>Certificate of citizenship</option>
								<option>Certificate of Inclusion</option>
							</select>
						</div>
						<div class="form-group" style="margin:15px 0;">
							<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div>
					</div>
					<div class="modal-footer" style="background-color: #fff;border:0;padding-top:0">
						<button type="button" class="btn btn-primary btn-noc">Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- education Modal -->
	<div class="modal fade " id="educationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content main-recruit-application">
				<div class="modal-header form-table-title" style="border:0;">
					<h6 class="modal-title" id="staticBackdropLabel">Educational or Equivalent Certificate</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-form" style="background-color: #8fb6cc; padding:10px 10px;">
					<div class="modal-body" style="background-color: #fff; padding:0 10px 10px;">
						<div class="form-group">
							<label for="exampleFormControlInput1">Name</label>
							<select class="form-control form-control-sm" id="exampleFormControlSelect1">
								<option></option>
								<option>SLC certificate</option>
								<option>Intermediate certificate</option>
								<option>Bachelor degree certificate</option>
							</select>
						</div>
						<div class="form-group" style="margin:15px 0;">
							<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div>
					</div>
					<div class="modal-footer" style="background-color: #fff;border:0;padding-top:0">
						<button type="button" class="btn btn-primary btn-noc">Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>

				</div>
			</div>
		</div>
	</div>
	