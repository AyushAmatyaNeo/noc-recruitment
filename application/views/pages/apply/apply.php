<link href="<?= base_url(); ?>assets/css/apply.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<main class="main-recruit-application bg-light sec-padd">
	<section class="top-info-sec">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h6>Nepal Oil Corporation Limited</h6>
					<h3>Application form</h3>
				</div>
			</div>
		</div>
	</section>

	<!-- Personal Details of applicant  -->
	<section class="readonly-info-sec">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<button type="button" class="btn form-table-title" data-toggle="collapse" data-target="#apply">
						Personal Details of applicant (Note: please edit the informations from 
						<a href="<?php echo base_url('profile/edit') ?>" style="color: #fff;"> 
							<i class="fa fa-pencil-square-o" aria-hidden="true" aria-expanded="false"></i> here
						</a> if required) 
						<i class="fa fa-chevron-down float-right" aria-hidden="true"></i>
					</button>
					<div class="card">
						<form>
							<?php foreach ($vacancylists as $vacancylist) { ?>
								<?php
								foreach ($user_details as $user_detail) {
								?>
									<div class="card-body collapse" id="apply">
										<section class="mb-3">
											<div class="heading-line mt-3 mb-3">
												<h5>Basic</h5>
											</div>
											<div class="row">

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">First Name</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['FIRST_NAME']; ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Middle Name</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MIDDLE_NAME']; ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Last Name</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['LAST_NAME']; ?>">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="col-form-label">Gender</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['GENDER_NAME'] ?>">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="col-form-label">Age</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['AGE']?>">
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="col-form-label">Date of Birth</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DOB'] ?>">
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="col-form-label">Marital status</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MARITAL_STATUS'] ?>">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<label class="col-form-label">Father's Name</label>
													<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['FATHER_NAME'] ?>">
												</div>

												<div class="col-md-6">
													<label class="col-form-label">Mother's Name</label>
													<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MOTHER_NAME'] ?>">
												</div>
											</div>
										</section>

										<section class="mb-3">
											<div class="heading-line mt-3 mb-3">
												<h5>Contact</h5>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Phone No.</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['PHONE_NO']; ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Mobile No.</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['MOBILE_NO']; ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Email.</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['EMAIL_ID']; ?>">
													</div>
												</div>
											</div>
										</section>

										<section class="mb-3">
											<div class="heading-line mt-3 mb-3">
												<h5>Citizenship</h5>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Citizenship No.</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['CITIZENSHIP_NO'] ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Citizenship Issued Date</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['CTZ_ISSUE_DATE'] ?>">
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Citizenship Issued District</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DISTRICT_NAME'] ?>">
													</div>
												</div>
												
											</div>
										</section>

										<section class="mb-3">
											<div class="heading-line mt-3 mb-3">
											</div>
											<div class="row">

												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Are you Physically Disabled?</label>

														<div class="row">
															<div class="col-md-4">
																<div>
																	<div class="form-check form-check-inline mr-1">
																		<input class="form-check-input" type="radio" name="disability" id="disability-y" disabled="" value="Yes" <?php echo ($user_detail['DISABILITY'] == 'Yes') ? 'checked' : ''; ?>>
																		<label class="form-check-label" for="disability-y">Yes</label>
																	</div>

																	<div class="form-check form-check-inline mr-1">
																		<input class="form-check-input" type="radio" name="disability" id="disability-n" disabled="" value="No" <?php echo ($user_detail['DISABILITY'] == 'No') ? 'checked' : ''; ?>>
																		<label class="form-check-label" for="disability-n">No</label>
																	</div>
																</div>
															</div>

															<div class="com-md-8">
																<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['DISABILITY']; if($user_detail['DISABILITY'] == 'Yes' && !empty($user_detail['DISABILITY_INPUT'])){ echo ' - '. $user_detail['DISABILITY_INPUT']; } ?>">
															</div>
														</div>
													</div>
													
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Employment Status</label>
														<input type="text" readonly class="form-control form-control-sm" value="<?php echo $user_detail['EMPLOYMENT_STATUS']; if($user_detail['EMPLOYMENT_STATUS'] == 'others' && !empty($user_detail['EMPLOYMENT_INPUT'])){ echo  ' - '.$user_detail['EMPLOYMENT_INPUT']; } ?>">
													</div>
												</div>
											</div>
										</section>

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
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<button type="button" class="btn form-table-title" data-toggle="collapse" data-target="#vacancyDetail" aria-expanded="true">Application Details<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></button>
					<div class="card">
						<form>
							<?php foreach ($vacancylists as $vacancylist) { ?>
								<div class="card-body collapse show" id="vacancyDetail">

									<div class="row">

										<div class="col-md-3">
											<div class="form-group">
												<label class="col-form-label">Advertisement No.</label>
												<input type="text" name="vacancy_name" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO']; ?>">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label class="col-form-label">Registration No.</label>
												<input type="text" name="registration_no" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO'] . "-" . isset($vacancylist['maxregId'])? $vacancylist['AD_NO'].'-'.$registration_no : '' ?>">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Post</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['DESIGNATION_TITLE']; ?>">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Qualification</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['ACADEMIC_DEGREE_NAME']; ?>">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Registration Date</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Service / Group</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['DEPARTMENT_NAME']; ?>">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Level</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['FUNCTIONAL_LEVEL_EDESC']; ?>">
												<input type="hidden" name="functional_level_id" id="functional_level_id" value="<?php echo $vacancylist['FUNCTIONAL_LEVEL_ID']; ?>">
												<input type="hidden" name="position_id" id="position_id" value="<?php echo $vacancylist['DESIGNATION_ID']; ?>">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="col-form-label">Experience</label>
												<input type="text" readonly class="form-control form-control-sm" value="<?php $exp =  ($vacancylist['EXPERIENCE'] > 0) ?  ' Years' : '0'; echo $vacancylist['EXPERIENCE'].' '.$exp; ?>">
											</div>
										</div>
										
									</div>

									<div class="row">
										<div class="col-md-12">
											<label class="col-form-label">Other Details</label>
											<textarea name="message" readonly class="form-control form-control-sm" rows="4"><?php echo $vacancylist['INSTRUCTION_EDESC'] ?></textarea>
										</div>
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
		<?php echo form_open_multipart('', ['name' => 'applyForm', 'id' => 'applyForm']); ?>
			<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" >
			<input type="hidden" name="registration_no" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO'] . "-" . isset($vacancylist['maxregId'])? $vacancylist['AD_NO'].'-'.$registration_no : '' ?>">
		<h2>Application Form</h2>
		<!-- Circles which indicates the steps of the form: -->
		<div style="text-align:center;margin-top:40px;margin-bottom:40px;">
			<!-- <span class="step">Details</span> -->
			<span class="step">Details & Qualifications</span>
			<span class="step">Documents</span>
		</div>	
		<div class="alert-custom alert-custom-info d-flex align-items-center">
           <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> 1) Please fillup Details and Qualifications First <br>   2) Then Proceed with Documents
       	</div>
		<!-- Qualification -->
		<div class="tab">
			<h6 class="blockquote text-center">Please check above personal details to match vacancy description</h6>
			
			<?php foreach ($vacancylists as $vacancylist) { ?>
				<?php echo form_hidden('vacancy_id', $vacancylist['VACANCY_ID']); ?>
				<?php echo form_hidden('ad_no', $vacancylist['AD_NO']); ?>
			<?php } ?>
			
			<!-- Select inclusion -->
			<?php
				if ($inclusions != []) { ?>
					
			
			<h6 class="form-table-title">Select</h6>
			<div class="col-md-12">
				<div class="row card-inner">
					<div class="col-lg-2">
						<p class="sm-bold-text"></p>
					</div>
					<?php
					   foreach($inclusions as $inclusion) {?>
						<div class="col-lg-12">
							<div class="form-check form-check-inline">
								<input class="form-check-input inclusion" type="checkbox" name="inclusion[]" value="<?php echo $inclusion['INCLUSION_ID'] ?>" inclusionName="<?php echo $inclusion['OPTION_EDESC'];?>">
								<label class="form-check-label"><?php echo $inclusion['OPTION_EDESC'] ?></label>
							</div>
							<?php if($inclusion['UPLOAD_FLAG'] == 'Y'){ ?>
								<input type="file" accept=".png,.jpg,.pdf" class="form-control-file inclusion_file" id="<?php $inclusionId = str_replace(' ', '_', $inclusion['OPTION_EDESC']); echo $inclusionId ?>" name="<?php echo $inclusion['OPTION_EDESC'];?>" onchange="return fileValidation($id = '<?php $inclusionId = str_replace(' ', '_', $inclusion['OPTION_EDESC']); echo $inclusionId  ?>')"/>								
							<?php } ?>
						</div>
					<?php } ?>
					<div class="col-lg-3">
						<div class="form-group row">
							<label class="col-lg-5">Total Amount:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control form-control-sm" name="inclusion_amount" id="inclusion_amount" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php	}else { ?>
				<div class="col-lg-3">
						<div class="form-group row">
							<label class="col-lg-5">Total Amount:</label>
							<div class="col-lg-7">
								<input type="text" class="form-control form-control-sm" name="inclusion_amount" value="600" readonly>
							</div>
						</div>
					</div>
			<?php }
			?>
			<?php /*
			<?php
			if ($vacancylists[0]['SKILL_ID'] != "") { ?>
			<!-- Select Skills -->
			<h6 class="form-table-title">Select Skills - PNG, JPG & PDF format only (All fields are mandatory for application approval) </h6>
			<?php
			if ($vacancylists[0]['SKILL_ID'] != "") {
			foreach($vacancylists[0]['SKILL_ID'] as $Skills) {?>
			<div class="col-md-12">
				<div class="row card-inner">
					<!-- <div class="col-lg-2">
						<p class="sm-bold-text">Skills</p>
					</div> -->					
					<div class="col-md-6">
						<div class="form-check form-check-inline">
							<!-- <input type="hidden" name="image_ids[]" value="<?php //echo $Skills['SKILL_NAME']; ?>" /> -->
							<input class="form-check-input skills" type="checkbox" name="skills[]"  value="<?php echo $Skills['SKILL_ID'] ?>" skillname="<?php echo $Skills['SKILL_NAME']; ?>" />
							<label class="form-check-label"><?php echo $Skills['SKILL_NAME']; ?></label>							
						</div>
						<?php if($Skills['UPLOAD_FLAG'] == 'Y'){ ?>
							<input type="file" accept=".png,.jpg,.pdf" class="form-control-file skill_name" id="<?php $skillId = str_replace(' ', '_', $Skills['SKILL_NAME']); echo $skillId ?>" name="<?php echo $Skills['SKILL_NAME'];?>" onchange="return fileValidation($id = '<?php $skillId = str_replace(' ', '_', $Skills['SKILL_NAME']); echo $skillId  ?>')"/>								
							<?php } ?>
					</div>					
				</div>				
			</div>
			<?php } } }?>
			*/ ?>
			<!-- G. Educational Qualification -->
			<div class="card mt-3">
				<h6 class="form-table-title">Educational Qualification</h6>
				<div class="card-body">
					<div class="alert-custom alert-custom-info d-flex align-items-center">
                      <i class="fa fa-info-circle mr-2" aria-hidden="true"></i> Please tick maximum level of education qualification 
                   	</div>
					<div class="col-lg-12 my-3" id="max_education">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="1">
							<label class="form-check-label">SLC</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="2">
							<label class="form-check-label">+2 / Intermediate</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="3">
							<label class="form-check-label">Bachelors</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="4">
							<label class="form-check-label">Masters</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="5">
							<label class="form-check-label">M.phil</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="max_education" value="11">
							<label class="form-check-label">others</label>
						</div>
					</div>

					<div class="alert-custom alert-custom-info d-flex align-items-center">
                      <i class="fa fa-info-circle mr-2" aria-hidden="true"></i>Add all relevant educational informational in below input section.
                   	</div>

                   	<div class="row">
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
										<th rowspan="2"></th>
									</tr>
									<tr>
										<th>Rank Type</th>
										<th width="10%">Rank Value</th>
									</tr>
								</thead>
								<tbody id="educationalbody">
									<tr>
										<td>
											<div for="edu_institute" class="form-group">
												<input type="text" name="edu_institute[]" id="edu_institute" class="form-control form-control-sm">
											</div>
											<?php echo form_error('edu_institute', '<p class="help-block error">', '</p>'); ?>
										</td>
										<td>
											<div for="level_id" class="form-group">
												<select class="form-control form-control-sm" name="level_id[]" id="level_id">
													<option value="">-- Select Degree -- </option>
													<?php foreach ($degrees as $degree) { ?>
														<option value="<?php echo $degree['ACADEMIC_DEGREE_ID'] ?>"><?php echo $degree['ACADEMIC_DEGREE_NAME'] ?></option>
													<?php } ?>
												</select>
												<?php echo form_error('level_id', '<p class="help-block error">', '</p>'); ?>
											</div>
										</td>
										<td>
											<div for="facalty" class="form-group">
											
												<select class="form-control form-control-sm" name="facalty[]" id="FACULTY_id">
													<option value="">-- Select Program -- </option>
													<?php foreach ($faculties as $faculty) { ?>
														<option value="<?php echo $faculty['ACADEMIC_PROGRAM_ID'] ?>"><?php echo $faculty['ACADEMIC_PROGRAM_NAME'] ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td>
											<div class="form-group">
												<select class="form-control form-control-sm" id="rank_type" name="rank_type[]">
													<option value="">--Select Rank Type--</option>
													<option value="GPA">GPA</option>
													<option value="Percentage">Percentage</option>
													<option value="Division/grade">Division/grade</option>
												</select>
											</div>
										</td>									
										<td>
											<div for="rank_value" class="form-group" id="rank_value_error">
												<input type="text" name="rank_value[]" id="rank_value" class="form-control form-control-sm">
												<label id="rank_value-error" class="error" for="rank_value" style="display: none">Please enter above 32.</label>
												<?php echo form_error('rank_value', '<p class="help-block error">', '</p>'); ?>
											</div>
										</td>
										<td>
											<div for="university_board" class="form-group" id="rank_value_error">
												<select class="form-control form-control-sm" name="university_board[]" id="UNIV">
													<option value="">-- Select University -- </option>
													<?php foreach ($univs as $univ) { ?>
														<option value="<?php echo $univ['ACADEMIC_UNIVERSITY_ID'] ?>"><?php echo $univ['ACADEMIC_UNIVERSITY_NAME'] ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td>
											<div for="major_subject" class="form-group">
												<select class="form-control form-control-sm" name="major_subject[]" id="major_subject">
													<option value="">-- Select Majors -- </option>
													<?php foreach ($majors as $major) { ?>
														<option value="<?php echo $major['ACADEMIC_COURSE_ID'] ?>"><?php echo $major['ACADEMIC_COURSE_NAME'] ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td>
											<div for="passed_year" class="form-group">
												<input type="text" name="passed_year[]" id="passed_year" class="form-control form-control-sm">
												<?php echo form_error('passed_year', '<p class="help-block error">', '</p>'); ?>
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
				</div>
			</div>
			<!-- H. Experience Detail -->
			<div class="card mt-3">
				<h6 class="form-table-title">
				Experience Detail (Mention only if experience is required for the advertisement of the post filled in the application form)</h6>

				<div class="col-md-12 mt-3">
					<?php if(!empty($vacancylist['EXPERIENCE']) && $vacancylist['EXPERIENCE'] != 0){ echo '<p style="color:#c75216">This vacancy require <b> '. $vacancylist['EXPERIENCE']. ' </b>years of experiance, please add using <i class="fa fa-plus-circle" aria-hidden="true" style="color: green; cursor: pointer"></i> sign.</p>';
					?>
					<label for="yourExp">Your total Experience:</label>
					<input class="form-control" type="text" val='0' style="height: 25px;width: 300px;" id="yourTotalExp" disabled>
					<?php
					} ?>
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
								<th><i class="fa fa-plus-circle btn-add-exp" id="btn-add-exp" aria-hidden="true" style="color: green; cursor: pointer"></i></th>
							</tr>
						</thead>
						<tbody id="experiancebody">
							
						</tbody>
						<tfoot>
							<tr>
									<!-- <td colspan="8">
										<div class="form-group row">
											<label class="col-lg-4">Total Experience</label>
											<div class="col-lg-8 d-flex">
												<button type="button" class="btn btn-primary" id="expcalculate">Calculate</button>
												<input type="number" class="form-control form-control-sm mr-1 years" placeholder="Years" readonly>
												<input type="number" class="form-control form-control-sm mr-1 months" placeholder="Months" readonly>
												<input type="number" class="form-control form-control-sm days" placeholder="Days" readonly>
											</div>
										</div>
									</td> -->
							</tr>
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
								<th>Period</th>
								<th>Description</th>
								<th><i class="fa fa-plus-circle btn-add-tr" aria-hidden="true" style="color: green; cursor: pointer"></i></th>
							</tr>
						</thead>
						<tbody id="trainingbody">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- Photograph and signature Documents -->
		<div class="tab">
			<!-- Citizenship Documents -->
			<h6 class="form-table-title">Citizenship of Applicant (Maximum 1 mb - JPG | PNG Only)</h6>
			<table class="table table-responsive-lg table-sm form-cstm-table">
				<tr>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="nagrita_front" src="<?php echo base_url('assets/images/ctz_front.png'); ?>" alt="nagrita_front" />
						</div>
					</td>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="nagrita_back" src="<?php echo base_url('assets/images/ctz_back.png'); ?>" alt="nagrita_back" />
						</div>
					</td>
				</tr>
				<tr>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="nagrita_frontimg" />
							<input type="file" class="form-control-file" name="nagrita_front" id="nagrita_frontimg" onchange="return fileValidation($id = 'nagrita_frontimg')" />
							<p class="size"></p>
						</div>
					</td>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="nagrita_backimg" />
							<input type="file" class="form-control-file" name="nagrita_back" id="nagrita_backimg" onchange="return fileValidation($id = 'nagrita_backimg')" />
							<p class="size"></p>
						</div>
					</td>
				</tr>
			</table>
			<h6 class="form-table-title">Photograph and signature of Applicant (Maximum 1 mb - JPG | PNG Only)</h6>
			<table class="table table-responsive-lg table-sm form-cstm-table">
				<tr>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="photograph" src="<?php echo base_url('assets/images/recent_ph2.png'); ?>" alt="photograph" />
						</div>
					</td>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="recent_sign" src="<?php echo base_url('assets/images/recent_sign.png'); ?>" alt="Signature" />
						</div>
					</td>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="right_finger" src="<?php echo base_url('assets/images/recent_right_finger.png'); ?>" alt="finger_right" />
						</div>
					</td>
					<td>
						<div style="border: 1px solid; width: 160px; height: 140px;background-color:#f2f2f2;">
							<img style="width: 100%; height: 100%" id="left_finger" src="<?php echo base_url('assets/images/recent_left_finger.png'); ?>" alt="finger_left" />
						</div>
					</td>
				</tr>
				<tr>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="recent_photo" />
							<input type="file" class="form-control-file" name="recent_photo" id="recent_photo" onchange="return fileValidation($id = 'recent_photo')">
							<p class="size"></p>
							<?php if (isset($upload_error_photo)) {
								echo $upload_error_photo;
							} ?>
						</div>
					</td>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="signature" />
							<input type="file" class="form-control-file" name="signature" id="signature" onchange="return fileValidation($id = 'signature')">
							<p class="size"></p>
						</div>
					</td>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="right_finger_scan" />
							<input type="file" class="form-control-file" name="right_finger_scan" id="right_finger_scan" onchange="return fileValidation($id = 'right_finger_scan')">
							<p class="size"></p>
						</div>
					</td>
					<td style="border-top:0;">
						<div class="form-group">
							<input type="hidden" name="image_ids[]" value="left_finger_scan" />
							<input type="file" class="form-control-file" name="left_finger_scan" id="left_finger_scan" onchange="return fileValidation($id = 'left_finger_scan')">
							<p class="size"></p>
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
							<h6>Note: 1. This vacancy require up to <strong> <?= $vacancylist['ACADEMIC_DEGREE_NAME'];  ?> </strong> degree documents, please upload it all else your application will not get approved.</h6>
							<h6>  2. Please upload all respective document in single a file.</h6>
						</div>
						<table class="table table-responsive-lg table-striped table-bordered table-sm">
							<thead>
								<tr class="UploadDoc">
									<td>S.No</td>
									<td>Document Name</td>
									<td>Upload</td>
									<!-- <td>Add</td> -->
								</tr>
							</thead>							
							<tbody>
								<tr>
									<input type="hidden" value="0" id="certImageId">
									<?php $c = 1; foreach($certificates as $certificate) {?>
									<tr class="certificate">
										<td><?php echo $c; ?></td>
										<td>											
											<div class="form-group">
												<p><?php echo ucfirst($certificate['ACADEMIC_DEGREE_NAME']);  ?></p>										
											</div>
										</td>
										<td class='certInput' id="td<?php echo $c; ?>">

										<?php
											$b = str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME']);
										?>
											<div class="row">
												<div class="col-md-10">
													<label for="trascript">Trabscript/Grade Sheet/Marksheet <span style="color: red;">*</span></label>
													<input required type="file" class="form-control-file" id="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_trascript'; echo $CertId;  ?>" name="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_trascript'; echo $CertId;  ?>" onchange="return fileValidation($id = '<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_trascript'; echo $CertId;  ?>')" accept=".png,.pdf,.jpg,.jpeg"/>
													<label style="margin-top:20px;" for="character">Character Certificate <span style="color: red;">*</span></label>
													<input required type="file" class="form-control-file" id="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_character'; echo $CertId;  ?>" name="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_character'; echo $CertId;  ?>" onchange="return fileValidation($id = '<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_character'; echo $CertId;  ?>')" accept=".png,.pdf,.jpg,.jpeg"/>
													<label style="margin-top:20px;" for="equivalent">Equivalent Certificate</label>
													<input type="file" class="form-control-file" id="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_equivalent'; echo $CertId;  ?>" name="<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_equivalent'; echo $CertId;  ?>" onchange="return fileValidation($id = '<?php $CertId = strtolower(str_replace(' ', '_', $certificate['ACADEMIC_DEGREE_NAME'])).'_equivalent'; echo $CertId;  ?>')" accept=".png,.pdf,.jpg,.jpeg"/>
												</div>
											</div>
										</td>										
									</tr>
									<?php $c++; } ?>
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
				<button type="button" class="previous ">Previous</button>
				<button type="button" class="next ">Next</button>
				<button type="submit" class="submit" name="applySubmit" value="submit">Submit</button>
			</div>
		</div>
		<?= form_close(); ?>
	</section>
</main>
<script type='text/javascript' src='<?php echo base_url('assets/js/Datepicker/custom.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/applytab.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/apply_edit.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/apply.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>'></script>

<script>
    document.levellist =<?=json_encode($degrees);?>;
	document.faculties = <?=json_encode($faculties);?>;
	document.univs = <?=json_encode($univs);?>;
	document.majors = <?=json_encode($majors);?>;
</script>
<script type="text/javascript">
	
	app.startEndDatePickerWithNepali('from_date_ad', 'from_date_bs', 'to_date_ad', 'to_date_bs');
	app.startEndDatePickerWithNepali('from_date_ad1', 'from_date_bs1', 'to_date_ad1', 'to_date_bs1');	
	app.startEndDatePickerWithNepali('tr_from_date', 'tr_from_date_bs', 'tr_to_date', 'tr_to_date_bs');
	$( document ).ready(function() {
    	$('#certImageId').val(0);
	});	

	function fileValidation($id) {
		var fileInput =
		document.getElementById($id);
		var filePath = fileInput.value;
		// Allowing file type
		var allowedExtensions =
			/(\.jpg|\.jpeg|\.png|\.pdf)$/i;
		if (!allowedExtensions.exec(filePath)) {
			alert('Invalid file type, please select - JPG | PNG | JPEG | PDF');
			fileInput.value = '';
			return false;
		} else {
			// Image preview
			if (fileInput.files && fileInput.files[0]) {
				// var reader = new FileReader();
				// reader.onload = function(e) {
				// 	document.getElementById(
				// 			'imagePreview').innerHTML =
				// 		'<img src="' + e.target.result +
				// 		'"/>';
				// };

				// reader.readAsDataURL(fileInput.files[0]);
			}
		}
		if (fileInput.files.length > 0) {
			for (let i = 0; i <= fileInput.files.length - 1; i++) {

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


	function addNewImage(params,b) {
		var certIdImage = $('#certImageId').val();
		
		// console.log(b);
		$('#td'+params).append(`
		 <div class = "row" id = "deleteAdded`+certIdImage+`" >
			<div class="col-md-8">
				<input type = "file" name = "`+b+``+certIdImage+`" class="form-control-file" id="`+b+`" accept=".png,.pdf,.jpg,.jpeg">
			</div>
			<div class="col-md-4">
				<i class="fa fa-minus-circle" onclick= "removeCertImage('`+certIdImage+`')" aria-hidden="true" style="color: red; cursor: pointer"></i>
			</div>
		 </div>
			
		`);
		certIdImage++
		// console.log(certIdImage);
		$('#certImageId').val(certIdImage);
	}
	function removeCertImage(params) {
		console.log(params);
		$('#deleteAdded'+params).remove();
	}
</script>

