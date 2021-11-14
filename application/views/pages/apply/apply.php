<link href="<?= base_url(); ?>assets/css/apply.css" rel="stylesheet">
<main class="main-recruit-application bg-light sec-padd">
	<section class="top-info-sec">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="text-center">
						<h6>Schedule 2</h6>
						<h6>Nepal Oil Corporation Limited</h6>
						<h6>Application form for new recruitment</h6>
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
						<p>View all vacancies</p>
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
						<button type="button" class="btn form-table-title" data-toggle="collapse" data-target="#vacancyDetail" aria-expanded="true">Application Details<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></button>
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
												<td><input type="text" name="registration_no" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO'] . "-" . isset($vacancylist['maxregId'])? $vacancylist['AD_NO'].'-'.$registration_no : '' ?>"></td>
											</tr>
											<tr>
												<th><label class="col-form-label"></label>Post</th>
												<td><input type="text" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['DESIGNATION_TITLE']; ?>"></td>
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
													<input type="hidden" name="position_id" id="position_id" value="<?php echo $vacancylist['DESIGNATION_ID']; ?>">
												</td>
											</tr>

										</table>
									</div>
									<div class="col-lg-12">
										<table>
											<tr>
												<th><label class="col-form-label"></label>Other Details</th>
												<td class="col-lg-6"><textarea name="message" readonly class="form-control form-control-sm" rows="4"><?php echo $vacancylist['INSTRUCTION_EDESC'] ?></textarea>
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
		<?php echo form_open_multipart('', ['name' => 'applyForm', 'id' => 'applyForm']); ?>
			<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" >
			<input type="hidden" name="registration_no" readonly class="form-control form-control-sm" value="<?php echo $vacancylist['AD_NO'] . "-" . isset($vacancylist['maxregId'])? $vacancylist['AD_NO'].'-'.$registration_no : '' ?>">
		<h2>Application Form</h2>
		<!-- Circles which indicates the steps of the form: -->
		<div style="text-align:center;margin-top:40px;margin-bottom:40px;">
			<span class="step">Details</span>
			<span class="step">Qualifications</span>
			<span class="step">Documents</span>
		</div>
		<!-- Personal Details -->
		<div class="tab">
			<h6 class="form-table-title">Tick any one of the options given below</h6>
			<!-- Marital -->
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
			<?php foreach ($vacancylists as $vacancylist) { ?>
				<?php echo form_hidden('vacancy_id', $vacancylist['VACANCY_ID']); ?>
				<?php echo form_hidden('ad_no', $vacancylist['AD_NO']); ?>
			<?php } ?>
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
							<input class="form-check-input" type="radio" name="disability" value="Yes">
							<label class="form-check-label">Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="disability" value="No">
							<label class="form-check-label">No</label>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group row">
							<label class="col-lg-5">Specify the type if any</label>
							<div class="col-lg-7">
								<input type="text" class="form-control form-control-sm" name="disability_input">
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<!-- Select inclusion -->
			<h6 class="form-table-title">Select inclusion</h6>
			<div class="col-md-12">
				<div class="row card-inner">
					<div class="col-lg-2">
						<p class="sm-bold-text">Inclusion</p>
					</div>
					<?php foreach($inclusions as $inclusion) {?>
					<div class="col-lg-2">
						<div class="form-check form-check-inline">
							<input class="form-check-input inclusion" type="checkbox" name="inclusion[]" value="<?php echo $inclusion['INCLUSION_ID'] ?>">
							<label class="form-check-label"><?php echo $inclusion['OPTION_EDESC'] ?></label>
						</div>
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
		</div>
		<hr>
		<!-- Qualification -->
		<div class="tab">
			<!-- G. Educational Qualification -->
			<div class="card mt-3">
				<h6 class="form-table-title">Educational Qualification</h6>
				<div class="card-body">
					<div class="col-lg-12 my-3">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="education" value="option1">
							<label class="form-check-label">SLC</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="education" value="option2">
							<label class="form-check-label">+2</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="education" value="option3">
							<label class="form-check-label">Bachelors</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="education" value="option4">
							<label class="form-check-label">Masters</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="education" value="option4">
							<label class="form-check-label">Others</label>
						</div>
					</div>
					<div class="col-md-12">
						<table class="table table-responsive-md table-striped table-bordered table-sm" id="education">
							<thead>
								<tr>
									<th rowspan="2" width="25%">Educational Institute</th>
									<th rowspan="2">Level</th>
									<th rowspan="2">Faculty</th>
									<th colspan="2">Division</th>
									<th rowspan="2">Major Subject</th>
									<th rowspan="2" width="10%">Passed Year</th>
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
												<option value="">-- Select -- </option>
												<?php foreach ($degrees as $degree) { ?>
													<option value="<?php echo $degree['ACADEMIC_DEGREE_ID'] ?>"><?php echo $degree['ACADEMIC_DEGREE_NAME'] ?></option>
												<?php } ?>
											</select>
											<?php echo form_error('level_id', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="facalty" class="form-group">
											<input type="text" name="facalty[]" id="facalty" class="form-control form-control-sm">
											<?php echo form_error('facalty', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control form-control-sm" id="rank_type" name="rank_type[]">
												<option value="">---</option>
												<option value="GPA">GPA</option>
												<option value="Percentage">Percentage</option>
											</select>
										</div>
									</td>
									<td>
										<div for="rank_value" class="form-group">
											<input type="text" name="rank_value[]" id="rank_value" class="form-control form-control-sm">
											<?php echo form_error('rank_value', '<p class="help-block error">', '</p>'); ?>
										</div>
									</td>
									<td>
										<div for="major_subject" class="form-group">
											<input type="text" name="major_subject[]" id="major_subject" class="form-control form-control-sm">
											<?php echo form_error('major_subject', '<p class="help-block error">', '</p>'); ?>
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
								<th></th>
							</tr>
						</thead>
						<tbody id="experiancebody">
							<tr>
								<td>
									<div for="org_name" class="form-group">
										<input type="text" name="org_name[]" id="org_name" class="form-control form-control-sm validate-field">
									</div>
								</td>
								<td>
									<div for="post_name" class="form-group">
										<input type="text" name="post_name[]" id="post_name" class="form-control form-control-sm validate-field">
									</div>
								</td>
								<td>
									<div for="service_name" class="form-group">
										<input type="text" name="service_name[]" id="service_name" class="form-control form-control-sm validate-field">
									</div>
								</td>
								<td>
									<div for="org_level" class="form-group">
										<input type="number" name="org_level[]" id="org_level" class="form-control form-control-sm validate-field">
									</div>
								</td>
								<td>
									<div for="employee_type" class="form-group">
										<select name="employee_type[]" id="employee_type" class="form-control form-control-sm">
											<option></option>
											<option value="1">Permanent</option>
											<option value="2">Temporary</option>
											<option value="3">Contract</option>
										</select>
									</div>
								</td>
								<td>
									<div for="from_date" class="form-group">
										<!-- <input name="from_date" type="text" class="date-picker form-control form-control-sm"> -->
										<input type="text" class="date-picker form-control selectNepaliDate fromDate" name="from_date[]" data-single="true" placeholder="Select Date(s)">
									</div>
								</td>
								<td>
									<div for="to_date" class="form-group">
										<!-- <input name="to_date" type="text" class="form-control form-control-sm"> -->
										<input type="text" class="date-picker form-control selectNepaliDate toDate" name="to_date[]" data-single="true" placeholder="Select Date(s)">
									</div>
								</td>
								<td>
									<i class="fa fa-plus-circle btn-add-exp" id="btn-add-exp" aria-hidden="true" style="color: green; cursor: pointer"></i>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="8">
									<div class="form-group row">
										<label class="col-lg-4">Total Experience</label>
										<div class="col-lg-8 d-flex">
											<button type="button" class="btn btn-primary" id="expcalculate">Calculate</button>
											<input type="number" class="form-control form-control-sm mr-1 years" placeholder="Years" readonly>
											<input type="number" class="form-control form-control-sm mr-1 months" placeholder="Months" readonly>
											<input type="number" class="form-control form-control-sm days" placeholder="Days" readonly>
										</div>
									</div>
								</td>
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
								<th width="12%">Period (Days)</th>
								<th>Description</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="trainingbody">
							<tr>
								<td>
									<div for="training_name" class="form-group">
										<input type="text" name="training_name[]" id="training_name" class="form-control form-control-sm">
									</div>
								</td>
								<td>
									<div for="certificate" class="form-group">
										<input type="text" name="certificate[]" id="certificate" class="form-control form-control-sm">
									</div>
								</td>
								<td>
									<div for="tr_from_date" class="form-group">
										<input type="text" name="tr_from_date[]" id="tr_from_date" class="form-control form-control-sm selectNepaliDate tr_from_date" data-single="true" placeholder="Select Date(s)">
									</div>
								</td>
								<td>
									<div for="tr_to_date" class="form-group">
										<input type="text" name="tr_to_date[]" id="tr_to_date" class="form-control form-control-sm selectNepaliDate tr_to_date" data-single="true" placeholder="Select Date(s)">
									</div>
								</td>
								<td>
									<div for="period" class="form-group">
										<input type="number" name="period[]" id="total_days" class="form-control form-control-sm period">
									</div>
								</td>
								<td>
									<div for="description" class="form-group">
										<input type="text" name="description[]" id="description" class="form-control form-control-sm">
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
			<h6 class="form-table-title">Document and Certificate (JPG | PNG Only)</h6>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-12">
						<div style="font-size: 12px;font-weight: bold;padding: 10px 0;">
							नागरिकताको प्रमाणपत्र र समावेशीको हक़मा समावेशीताको प्रमाणपत्रहरु अनिवार्य रूपमा upload गर्नु पर्नेछ। <br> (साईज: बढिमा 1 MB)
						</div>
						<table class="table table-responsive-lg table-striped table-bordered table-sm">
							<thead>
								<tr>
									<th>File Name</th>
									<th>Size</th>
									<th>Name of Document</th>
									<th></th>
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
										<button class="btn"><i class="fa fa-minus-circle" aria-hidden="true" style="color: red; cursor: pointer"></i></button>
									</td>
								</tr>
								<tr>
									<td colspan="7">
										<a href="" class="bt btn-apply" role="button" data-toggle="modal" data-target="#citizenshipModal"><i class="fa fa-plus-circle" aria-hidden="true" style="color: green;margin-right: 5px;"></i>New upload</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group col-md-3 mb-3 mt-3">
					<label for="">Voucher/Receipt Number</label>
					<input type="text" name="" class="form-control form-control-sm">
				</div>
			</div>
		</div>
		<div style="overflow:auto;">
			<div style="float:right; margin-top: 5px;">
				<button type="button" class="previous">Previous</button>
				<button type="button" class="next">Next</button>
				<button type="submit" class="submit" name="applySubmit" value="submit">Submit</button>
			</div>
		</div>
		<?= form_close(); ?>
	</section>
</main>
<script type="text/javascript">
	
	
	function myFunction() {

		var trDateInput = document.getElementsByClassName("selectNepaliDate");
		trDateInput.nepaliDatePicker({
			dateFormat: "YYYY-MM-DD",
			// disableAfter: today,	//'"'+today+'"',
			disableDaysAfter: 0,
			ndpYear: true,
			ndpMonth: true
		});
	};
	window.onload = myFunction();
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
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/applytab.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/apply/apply.js'); ?>'></script>