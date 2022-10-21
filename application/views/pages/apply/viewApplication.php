<link href="<?= base_url(); ?>assets/css/apply.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<main class="main-recruit-application bg-light sec-padd">
	<section class="top-info-sec">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="text-center">
						<h6>Schedule 2</h6>
						<h6>Nepal Oil Corporation Limited</h6>
						<h6>Application form for new recruitment</h6>
						<?php echo $this->session->flashdata('success_msg'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Personal Details of applicant  -->
	<section class="readonly-info-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<a href="">
						<!-- <p>View all vacancies</p> -->
					</a>
					<div class="card">
						<button type="button" class="btn form-table-title" data-toggle="collapse" data-target="#apply">Personal Details of applicant (Note: please edit the informations from <a href="<?php echo base_url('profile/edit') ?>" style="color: #fff;"> <i class="fa fa-pencil-square-o" aria-hidden="true" aria-expanded="false"></i> here</a> if required) <i class="fa fa-chevron-down float-right" aria-hidden="true"></i></button>
						<form>
							<?php foreach ($vacancylists as $vacancylist) { ?>
								<?php
								foreach ($user_details as $user_detail) {
								?>
									<div class="row card-body collapse" id="apply">
										<div class="col-lg-6">
											<table class="table table-lg-responsive">
												<tr>
													<th><label class="col-form-label"> Full Name</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['FIRST_NAME'] . ' ' . $user_detail['MIDDLE_NAME'] . ' ' . $user_detail['LAST_NAME'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Age</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['AGE']?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label"> Mobile No.</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MOBILE_NO'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Citizenship Issued Date</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['CTZ_ISSUE_DATE'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Father's Name</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['FATHER_NAME'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Marital status</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MARITAL_STATUS'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Disability status</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DISABILITY']; if($user_detail['DISABILITY'] == 'Yes' && !empty($user_detail['DISABILITY_INPUT'])){ echo ' - '. $user_detail['DISABILITY_INPUT']; } ?>"></td>
												</tr>
											</table>
										</div>
										<div class="col-lg-6">
											<table class="table table-lg-responsive">

												<tr>
													<th><label class="col-form-label"></label>Gender</th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['GENDER_NAME'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label"></label>Date of Birth</th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DOB'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Citizenship No.</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['CITIZENSHIP_NO'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Citizenship Issued District</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DISTRICT_NAME'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Mother's Name</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MOTHER_NAME'] ?>"></td>
												</tr>
												<tr>
													<th><label class="col-form-label">Employment Status</label></th>
													<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['EMPLOYMENT_STATUS']; if($user_detail['EMPLOYMENT_STATUS'] == 'others' && !empty($user_detail['EMPLOYMENT_INPUT'])){ echo  ' - '.$user_detail['EMPLOYMENT_INPUT']; } ?>"></td>
												</tr>
											</table>
										</div>
									</div>
							<?php }
							} ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Vacancy Details -->
	<section class="readonly-info-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<button type="button" class="btn form-table-title" data-toggle="collapse" data-target="#vacancyDetail">Application Details<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></button>
						<form>
							<?php foreach ($vacancylists as $vacancylist) { ?>
								<div class="row card-body collapse show" id="vacancyDetail">
									<div class="col-lg-6">
										<table class="table table-lg-responsive">
											<tr>
												<th><label class="col-form-label">Advertisement No.</label></th>
												<td>
													<input type="text" name="vacancy_name" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO']; ?>">
												</td>
											</tr>
											<tr>
												<th><label class="col-form-label"></label>Registration No.</th>
												<td><input type="text" name="registration_no" readonly class="form-control form-control-sm" value="<?php echo $applications[0]['REGISTRATION_NO'] ?>"></td>
											</tr>
											<tr>
												<th><label class="col-form-label"></label>Post</th>
												<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['DESIGNATION_TITLE']; ?>"></td>
												<input type="hidden" name="position_id" id="position_id" value="<?php echo $vacancylist['DESIGNATION_ID']; ?>">
											</tr>
										</table>
									</div>
									<div class="col-lg-6">
										<table class="table table-lg-responsive">
											<tr>
												<th><label class="col-form-label"></label>Registration Date </th>
												<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"></td>
											</tr>
											<tr>
												<th><label class="col-form-label"></label>Service/Group</th>
												<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['DEPARTMENT_NAME']; ?>"></td>
											</tr>
											<tr>
												<th><label class="col-form-label"></label>Level</th>
												<td>
													<input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['FUNCTIONAL_LEVEL_EDESC']; ?>">
													<input type="hidden" name="functional_level_id" id="functional_level_id" value="<?php echo $vacancylist['FUNCTIONAL_LEVEL_ID']; ?>">
												</td>
											</tr>

										</table>
									</div>
									<div class="col-lg-12">
										<table>
											<tr>
												<th><label class="col-form-label"></label>Other Details</th>
												<td class="col-lg-12"><textarea name="message" readonly class="form-control form-control-sm" rows="4"><?php echo $vacancylist['INSTRUCTION_EDESC'] ?></textarea>
											</tr>
										</table>
									</div>
								</div>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Application Details -->
	<section class="recruitment-form-sec">
		<?php echo form_open_multipart('', ['name' => 'EditapplyForm', 'id' => 'EditapplyForm']); ?>
		<input type="hidden" name="base" id="baseurl" value="<?php echo base_url(); ?>" />
		<h2>Application Form</h2>
		<!-- Circles which indicates the steps of the form: -->
		<div style="text-align:center;margin-top:40px;margin-bottom:40px;">
			<span class="step">Details & Qualifications</span>
			<span class="step">Documents</span>
		</div>		
		<!-- Qualification -->
		<div class="tab">
		<h6 class="blockquote text-center">Please check above personal details to match vacancy description</h6>			
			<?php foreach ($vacancylists as $vacancylist) { ?>
				<?php echo form_hidden('vacancy_id', $vacancylist['VACANCY_ID']); ?>
				<?php echo form_hidden('ad_no', $vacancylist['AD_NO']); ?>
				<?php echo form_hidden('application', $vacancylist['AD_NO']); ?>
			<?php } ?>
			<?php echo form_hidden('application_id', $applications[0]['APPLICATION_ID']) ?>
		
			<h6 class="form-table-title">Select inclusion</h6>
			<div class="col-md-12">
				<div class="row card-inner">
					<div class="col-lg-2">
						<p class="sm-bold-text">Inclusion</p>
					</div>
					<?php $inc=0; foreach($vacancylists[0]['INCLUSION_ID'] as $inclusion) {?>
					<div class="col-lg-12">
						<div class="form-check form-check-inline">
							<input disabled <?php foreach($Selectedinclusions as $Selectedinclusion){ $checked = ($Selectedinclusion == $inclusion['INCLUSION_ID']) ? 'checked' :'' ;  echo $checked; }?> 
							class="form-check-input inclusion" type="checkbox" name="inclusion_id[]" value="<?php echo $inclusion['INCLUSION_ID'] ?>" >
							<label class="form-check-label"><?php echo $inclusion['OPTION_EDESC'] ?></label>
							
						</div>
						<?php if($inclusion['UPLOAD_FLAG'] == 'Y'){ ?>
							<div class="col-md-8 form-check-inline">
							<div class="col-md-4">
								<?php if(!empty($documents['inclusionDocs'][$inclusion['INCLUSION_ID']]['DOC_PATH'])) { ?>
							<input type="hidden" name="inclusion_id[]" value="<?php  echo $documents['inclusionDocs'][$inclusion['INCLUSION_ID']]['REC_DOC_ID']; ?>" />
							<?php } ?>
							<?php if(!empty($documents['inclusionDocs'][$inclusion['INCLUSION_ID']]['DOC_PATH'])) { ?>
							<a href="<?php echo $documents['inclusionDocs'][$inclusion['INCLUSION_ID']]['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">View</a>
							<?php } ?>
							</div>
							</div>								
							<?php $inc++; } ?>
					</div>
					<?php } ?>
					<div class="col-lg-3">
						<div class="form-group row">
							<label class="col-lg-5">Total Amount: </label>
							<div class="col-lg-7">
								<input type="text" class="form-control form-control-sm" name="inclusion_amount" id="inclusion_amount" value="<?php echo $applications[0]['APPLICATION_AMOUNT'] ?>" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<!-- Select Skills -->
			<?php /*
			<h6 class="form-table-title">Select Skills (Choose from the list below )</h6>
			<?php $s=0; foreach($vacancylists[0]['SKILL_ID'] as $Skills) {?>
			<div class="col-md-12">
				<div class="row card-inner">									
					<div class="col-md-8">
						<div class="form-check form-check-inline">
							<input  <?php foreach($selectedskills as $selectedskill) {$checked = ($selectedskill == $Skills['SKILL_ID']) ? 'checked' :'' ; echo $checked;}?> 
							class="form-check-input skills" type="checkbox" name="skills[]" value="<?php echo $Skills['SKILL_ID'] ?>" skillname="<?php echo $Skills['SKILL_NAME']; ?>" />
							<label class="form-check-label"><?php echo $Skills['SKILL_NAME']; ?></label>			
						</div>
						<?php if($Skills['UPLOAD_FLAG'] == 'Y'){ ?>
							<div class="col-md-8 form-check-inline">
							<input type="file" class="form-control-file skill_name"  name="<?php echo $Skills['SKILL_NAME'];?>" />
							<div class="col-md-4">
								<?php if(!empty($documents['skills'][$s]['DOC_PATH'])) { ?>
							<input type="hidden" name="skill_id[]" value="<?php  echo $documents['skills'][$s]['REC_DOC_ID']; ?>" />
							<?php } ?>
							<?php if(!empty($documents['skills'][$s]['DOC_PATH'])) { ?>
							<a href="<?php echo $documents['skills'][$s]['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">View</a>
							<?php } ?>
							</div>
							</div>								
							<p style="color: #47759e;">Only choose new file to update previous one.</p>							
							<?php $s++; } ?>
							
					</div>					
				</div>				
			</div>
			<?php } ?>
			*/ ?>
			<!-- G. Educational Qualification -->
			<div class="card mt-3">
			<h6 class="form-table-title">Education Description</h6>
					<div class="col-lg-12 my-3" id="max_education">
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="1" <?php $checked =  ($applications[0]['MAX_QUALIFICATION_ID'] == '1') ? 'checked' : ''; echo $checked; ?> />
							<label class="form-check-label">SLC</label>
						</div>
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="2" <?php  $checked = ($applications[0]['MAX_QUALIFICATION_ID'] == '2') ? 'checked' : ''; echo $checked; ?> />
							<label class="form-check-label">+2 / Intermediate</label>
						</div>
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="3" <?php  $checked = ($applications[0]['MAX_QUALIFICATION_ID'] == '3') ? 'checked' : ''; echo $checked; ?>>
							<label class="form-check-label">Bachelors</label>
						</div>
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="4" <?php  $checked = ($applications[0]['MAX_QUALIFICATION_ID'] == '4') ? 'checked' : ''; echo $checked; ?>>
							<label class="form-check-label">Masters</label>
						</div>
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="5" <?php  $checked = ($applications[0]['MAX_QUALIFICATION_ID'] == '5') ? 'checked' : ''; echo $checked; ?>>
							<label class="form-check-label">M.phil</label>
						</div>
						<div class="form-check form-check-inline">
							<input disabled class="form-check-input" type="radio" name="max_education" value="11" <?php  $checked = ($applications[0]['MAX_QUALIFICATION_ID'] == '11') ? 'checked' : ''; echo $checked; ?>>
							<label class="form-check-label">others</label>
						</div>
					</div>
			</div>
			<div class="card mt-3">
				<h6 class="form-table-title">Educational Qualification</h6>
				<div class="card-body">
					
					<div class="col-md-12">
						<table class="table table-responsive-md table-striped table-bordered table-sm" id="education">
							<thead>
								<tr>
									<th rowspan="2" width="25%">Educational Institute</th>
									<th rowspan="2">Level</th>
									<th rowspan="2">Faculty</th>
									<th colspan="2">Division</th>
									<th rowspan="2">University/Board</th>
									<th rowspan="2">Major Subject</th>
									<th rowspan="2" width="10%">Passed Year (AD)</th>
								</tr>
								<tr>
									<th>Rank Type</th>
									<th width="10%">Rank Value</th>
								</tr>
							</thead>
							<tbody id="educationalbody">
							<?php if(!empty($educations)){  $counter = 0; ?>
								<?php foreach($educations as $education ) { $counter++?>
								<tr>
									<td>
										<div for="edu_institute" class="form-group">
											<input readonly type="text" name="edu_institute[]" id="edu_institute<?php echo $counter;?>" class="form-control form-control-sm" value="<?php echo $education['EDUCATION_INSTITUTE']  ?>">
											<input type="hidden" name="education_id[]" value="<?php echo $education['EDUCATION_ID'] ?>" class="form-control form-control-sm" >
										</div>
										<?php echo form_error('edu_institute', '<p class="help-block error">', '</p>'); ?>
									</td>
									<td>
										<div for="level_id" class="form-group">
											<select disabled class="form-control form-control-sm" name="level_id[]" id="level_id<?php echo $counter;?>">
												<option value="">-- Select -- </option>
												<?php foreach ($degrees as $degree) { ?>
													<?php $selected = ($education['LEVEL_ID'] == $degree['ACADEMIC_DEGREE_ID'])? 'selected': '' ?>
													<option <?php echo $selected ?> value="<?php echo $degree['ACADEMIC_DEGREE_ID'] ?>"><?php echo $degree['ACADEMIC_DEGREE_NAME'] ?></option>
												<?php } ?>
											</select>
											<?php echo form_error('level_id', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="facalty" class="form-group">
											<input readonly type="text" name="facalty[]" id="facalty<?php echo $counter;?>" class="form-control form-control-sm" value="<?php echo $education['FACALTY'] ?>">
											<?php echo form_error('facalty', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select disabled class="form-control form-control-sm" id="rank_type<?php echo $counter;?>" name="rank_type[]">
												<option value="">---</option>
												<option <?php if($education['RANK_TYPE'] === 'GPA') { echo 'selected';} ?> value="GPA">GPA</option>
												<option <?php if($education['RANK_TYPE'] === 'Percentage'){ echo 'selected';} ?> value="Percentage">Percentage</option>
												<option <?php if($education['RANK_TYPE'] === 'Division/grade'){ echo 'selected';} ?> value="Division/grade">Division/grade</option>
											</select>
										</div>
									</td>
									<td>
										<div for="rank_value" class="form-group">
											<input readonly type="text" name="rank_value[]" id="rank_value<?php echo $counter;?>" class="form-control form-control-sm" value="<?php echo $education['RANK_VALUE'] ?>">
											<?php echo form_error('rank_value', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="university_board" class="form-group" id="rank_value_error">
											<input readonly type="text" name="university_board[]" id="university_board" class="form-control form-control-sm" value="<?php echo $education['UNIVERSITY_BOARD'] ?>">
											<?php echo form_error('university_board', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="major_subject" class="form-group">
											<input readonly type="text" name="major_subject[]" id="major_subject<?php echo $counter;?>" class="form-control form-control-sm" value="<?php echo $education['MAJOR_SUBJECT'] ?>">
											<?php echo form_error('major_subject', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="passed_year" class="form-group">
											<input readonly type="text" name="passed_year[]" id="passed_year<?php echo $counter;?>" class="form-control form-control-sm" value="<?php echo $education['PASSED_YEAR'] ?>">
											<?php echo form_error('passed_year', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
								</tr>
								<?php } }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- H. Experience Detail -->
			<div class="card mt-3">
				<h6 class="form-table-title">Experience Detail (Mention only if experience is required for the advertisement of the post filled in the application form)</h6>
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
							</tr>
						</thead>
						<tbody id="experiancebody">
						<?php if(!empty($experiences)){  ?>
						<?php foreach($experiences as $experience ) { ?>
							<tr>
								<td>
									<div for="org_name" class="form-group">
										<input readonly type="text" name="org_name[]" id="org_name" class="form-control form-control-sm validate-field" value="<?php echo $experience['ORGANISATION_NAME'] ?>">
										<input type="hidden" name="experience_id[]" value="<?php echo $experience['EXPERIENCE_ID'] ?>" class="form-control form-control-sm" >
									</div>
								</td>
								<td>
									<div for="post_name" class="form-group">
										<input readonly type="text" name="post_name[]" id="post_name" class="form-control form-control-sm validate-field" value="<?php echo $experience['POST_NAME'] ?>">
									</div>
								</td>
								<td>
									<div for="service_name" class="form-group">
										<input readonly type="text" name="service_name[]" id="service_name" class="form-control form-control-sm validate-field" value="<?php echo $experience['SERVICE_NAME'] ?>">
									</div>
								</td>
								<td>
									<div for="org_level" class="form-group">
										<input readonly type="number" name="org_level[]" id="org_level" class="form-control form-control-sm validate-field" value="<?php echo $experience['LEVEL_ID'] ?>">
									</div>
								</td>
								<td>
									<div for="employee_type" class="form-group">
										<select disabled name="employee_type[]" id="employee_type" class="form-control form-control-sm">
											<option></option>
											<option <?php if($experience['EMPLOYEE_TYPE_ID'] == 1) { echo 'selected'; } ?> value="1">Permanent</option>
											<option <?php if($experience['EMPLOYEE_TYPE_ID'] == 2) { echo 'selected'; } ?> value="2">Temporary</option>
											<option <?php if($experience['EMPLOYEE_TYPE_ID'] == 3) { echo 'selected'; } ?> value="3">Contract</option>
										</select>
									</div>
								</td>
								<td>
									<div for="from_date" class="form-group">
										<!-- <input name="from_date" type="text" class="date-picker form-control form-control-sm"> -->
										
										<input readonly type="text" class="date-picker form-control selectNepaliDate1 fromDate" name="from_date[]" id="from_date_ad" data-single="true" placeholder="Date(AD)" value="<?php echo $experience['FROM_DATE'] ?>">
									</div>
								</td>
								<td>
									<div for="to_date" class="form-group">
										<!-- <input name="to_date" type="text" class="form-control form-control-sm"> -->
										
										<input readonly type="text" class="date-picker form-control selectNepaliDate1 toDate" name="to_date_bs[]" id="to_date_ad" data-single="true" placeholder=" Date(AD)" value="<?php echo $experience['TO_DATE'] ?>">
									</div>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
						<tfoot>
							<!-- <tr>
								<td colspan="8">
									<div class="form-group row">
										<label class="col-lg-4">Total Experience</label>
										<div class="col-lg-8 d-flex">
											<input type="number" class="form-control form-control-sm mr-1" placeholder="Years" readonly>
											<input type="number" class="form-control form-control-sm mr-1" placeholder="Months" readonly>
											<input type="number" class="form-control form-control-sm" placeholder="Days" readonly>
										</div>
									</div>
								</td>
							</tr> -->
						</tfoot>
					</table>
				</div>
			</div>
			<!-- I. Training Detail -->
			<div class="card mt-3">
				<h6 class="form-table-title">Training Detail</h6>
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
							</tr>
						</thead>
						<tbody id="trainingbody">
						<?php if(!empty($trainings)){  ?>
						<?php foreach($trainings as $training ) { ?>
							<tr>
								<td>
									<div for="training_name" class="form-group">
										<input readonly type="text" name="training_name[]" id="training_name" class="form-control form-control-sm" value="<?php echo $training['TRAINING_NAME'] ?>">
										<input type="hidden" name="training_id[]" value="<?php echo $training['TRAINING_ID'] ?>" class="form-control form-control-sm" >
									</div>
								</td>
								<td>
									<div for="certificate" class="form-group">
										<input readonly type="text" name="certificate[]" id="certificate" class="form-control form-control-sm" value="<?php echo $training['CERTIFICATE'] ?>">
									</div>
								</td>
								<td>
									<div for="tr_from_date" class="form-group">
										<input readonly type="text" name="tr_from_date[]" id="tr_from_date" class="form-control form-control-sm selectNepaliDate tr_from_date" data-single="true" placeholder="Select Date(s)" value="<?php echo $training['FROM_DATE'] ?>">
									</div>
								</td>
								<td>
									<div for="tr_to_date" class="form-group">
										<input readonly type="text" name="tr_to_date[]" id="tr_to_date" class="form-control form-control-sm selectNepaliDate tr_to_date" data-single="true" placeholder="Select Date(s)" value="<?php echo $training['TO_DATE'] ?>">
									</div>
								</td>
								<td>
									<div for="period" class="form-group">
										<input readonly type="number" name="period[]" id="total_days" class="form-control form-control-sm period" value="<?php echo $training['TOTAL_DAYS'] ?>">
									</div>
								</td>
								<td>
									<div for="description" class="form-group">
										<input readonly type="text" name="description[]" id="description" class="form-control form-control-sm" value="<?php echo $training['DESCRIPTION'] ?>">
									</div>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- Photograph and signature Documents -->
		<div class="tab">
			<!-- Citizenship Documents -->
			<h6 class="form-table-title">Citizenship of Applicant (Maximum 1 mb - JPG | PNG | PDF Only)</h6>
			<table class="table table-responsive-lg table-sm form-cstm-table">
				<tr>
					<td>
						<p>Front citizenship</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="nagrita_front" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['nagrita_front']['DOC_PATH']; } else { echo base_url('assets/images/ctz_front.png');} ?>" alt="nagrita_front" />
						</div>
					</td>
					<td>
						<p>Back citizenship</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="nagrita_back" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['nagrita_back']['DOC_PATH']; } else { echo base_url('assets/images/ctz_back.png');} ?>" alt="nagrita_back" />
						</div>
					</td>
				</tr>
			</table>
			<h6 class="form-table-title">Photograph and signature of Applicant (Maximum 1 mb - JPG | PNG | PDF Only)</h6>
			<table class="table table-responsive-lg table-sm form-cstm-table">
				<tr>
					<td>
						<p>Photograph</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="photograph" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['photograph']['DOC_PATH']; } else { echo base_url('assets/images/recent_ph2.png');} ?>" alt="photograph" />
						</div>
					</td>
					<td>
						<p>Signature</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="recent_sign" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['signature']['DOC_PATH']; } else { echo base_url('assets/images/recent_sign.png');} ?>" alt="Signature" />
						</div>
					</td>
					<td>
						<p>Right finger thumb</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="right_finger" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['fingerright']['DOC_PATH']; } else { echo base_url('assets/images/recent_right_finger.png');} ?>" alt="finger_right" />
						</div>
					</td>
					<td>
						<p>Left finger thumb</p>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="left_finger" src="<?php if (!empty($documents)){ echo $documents['userdocnew']['fingerleft']['DOC_PATH']; } else { echo base_url('assets/images/recent_left_finger.png');} ?>" alt="finger_left" />
						</div>
					</td>
				</tr>
			</table>
			<!-- Academic Document Upload -->
			<h6 class="form-table-title">Document and Certificate (JPG | PNG Only)</h6>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-12">
						<div style="font-size: 12px;font-weight: bold;padding: 10px 0;">							
							<h6>Note: This vacancy require up to <?= $vacancylist['ACADEMIC_DEGREE_NAME'];  ?> degree documents, please upload it all else your application will not get approved.</h6>
							<h6>  2. Please upload all respective document in single a file.</h6>
						</div>
						<table class="table table-responsive-lg table-striped table-bordered table-sm">
							<thead>
								<tr class="UploadDoc">
									<td>S.No</td>
									<td>Document Name</td>
									<td>View</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php $c = 1; $d=0; foreach($certificates as $certificate) {?>
									<tr class="certificate">
										<td><?php echo $c; ?></td>
										<td>											
											<div class="form-group">
												<p><?php echo ucfirst($certificate['ACADEMIC_DEGREE_NAME']);  ?></p>										
											</div>
										</td>
										<td colspan="7">
											<a href="<?php echo $documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_trascript']['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">Transcript</a>
											<a href="<?php echo $documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_character']['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">Character</a>
											<?php if(!empty($documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_equivalent']['DOC_PATH'])){ ?>
											<a href="<?php echo $documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_equivalent']['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">Equivalent</a>
											<?php } ?>
											<?php if(!empty($documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_council']['DOC_PATH'])){ ?>
											<a href="<?php echo $documents['userdocnew'][strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_council']['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">Council</a>
											<?php } ?>
										</td>
									</tr>
									<?php $c++; $d++;} ?>

									<tr class="certificate">
										<td><?php echo $c; ?></td>
										<td>											
											<div class="form-group">
												<p>Experience</p>										
											</div>
										</td>
										<td colspan="7">
											<?php foreach($documents['experience'] as $experienceDoc){ ?>
												<a href="<?php echo$experienceDoc['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">View</a>
											<?php } ?>
										</td>
									</tr>

									<tr class="certificate">
										<td><?php echo $c; ?></td>
										<td>											
											<div class="form-group">
												<p>Training</p>										
											</div>
										</td>
										<td colspan="7">
											<?php foreach($documents['training'] as $experienceDoc){ ?>
												<a href="<?php echo$experienceDoc['DOC_PATH']; ?>" target="_blank" class="btn btn-primary">View</a>
											<?php } ?>
										</td>
									</tr>
								</tr>
								<tr>
									<!-- <td colspan="7">
										<a href="" class="bt btn-apply" role="button" data-toggle="modal" data-target="#citizenshipModal"><i class="fa fa-plus-circle" aria-hidden="true" style="color: green;margin-right: 5px;"></i>New upload</a>
									</td> -->
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- <div class="form-group col-md-3 mb-3 mt-3">
					<label for="">Voucher/Receipt Number</label>
					<input type="text" name="" class="form-control form-control-sm">
				</div> -->
			</div>
		</div>
		<div style="overflow:auto;">
			<div style="float:right; margin-top: 5px;">
				<button type="button" class="previous">Previous</button>
				<button type="button" class="next">Next</button>
				<a  class="btn btn-primary submit" href="<?php echo base_url('vacancy');; ?>">
				Back
				</a>
			</div>
		</div>
		<?= form_close(); ?>
	</section>
</main>
<script type="text/javascript">
	// function myFunction() {

	// 	var trDateInput = document.getElementsByClassName("selectNepaliDate");
	// 	trDateInput.nepaliDatePicker({
	// 		dateFormat: "YYYY-MM-DD",
	// 		disableAfter: "2077-12-15",
	// 		ndpYear: true,
	// 		ndpMonth: true
	// 	});
	// };
	// window.onload = myFunction();
	// Allowed File Type

	function fileValidation($id) {
		var fileInput =
			document.getElementById($id);

		var filePath = fileInput.value;

		// Allowing file type
		var allowedExtensions =
			/(\.jpg|\.jpeg|\.png|\.pdf)$/i;

		if (!allowedExtensions.exec(filePath)) {
			alert('Invalid file type, please select JPG|PNG|JPEG|PDF');
			fileInput.value = '';
			return false;
		} else {
			// Image preview
		}
		if (fileInput.files.length > 0) {
			for (const i = 0; i <= fileInput.files.length - 1; i++) {

				const fsize = fileInput.files.item(i).size;
				const file = Math.round((fsize / 1024));
				// The size of the file.
				if (file >= 1024) {
					alert(
						"File too Big, please select a file less than 1mb");
					fileInput.value = '';
					return false;
				} else {
					document.getElementsByClassName('size').innerHTML = '<b>' +
						file + '</b> KB';
				}
			}
		}
	}
</script>
<script type='text/javascript' src='<?php echo base_url('assets/js/Datepicker/custom.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/applytab.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/apply_edit.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/edit.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>'></script>
