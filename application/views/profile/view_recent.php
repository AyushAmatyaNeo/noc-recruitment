<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<main class="main-user-profile bg-light">
	<section class="user-profile-sec sec-padd">
		<div class="container">
			<div class="col-lg-12">
				<div class="card">
					<div class="left-form p-5">
						<div class="status-msg success" style="padding-bottom: 10px;"><?php echo $this->session->flashdata('success_msg'); ?></div>
						<div class="d-flex" style="justify-content: space-between;align-items: baseline;">
							<h5 class="main-title"><i class="fa fa-user pr-2" aria-hidden="true"></i>Welcome <?php echo $user['FIRST_NAME']; ?>!</h5>
							<a href="<?php echo base_url('profile/edit') ?>"><i class="fa fa-pencil-square-o pr-1" aria-hidden="true"></i><small>Edit Profile</small></a>
						</div>
								<?php  
									if(!empty($success_msg)){ 
										echo '<p class="status-msg success">'.$success_msg.'</p>'; 
									}elseif(!empty($error_msg)){ 
										echo '<p class="status-msg error">'.$error_msg.'</p>'; 
									} 
    							?>
								<?php echo '<p class="status-msg error">'. $this->session->flashdata('msg').'</p>' ?>
						

						<!-- tab content -->

						<div class="container-content">
							<div class="heading">
								<h6 class="text-black font-bold">My Profile</h6>
							</div>

							<ul class="nav nav-tabs" id="myTab" role="tablist">

								<!-- Personal Extra Contact Education Training Professional Council Experience Documents Preview -->
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'personal') ? 'active' : ''; ?>" id="personal-tab" data-toggle="tab" onclick="viewAction()" role="tab" aria-controls="personal" aria-selected="true" name="personal">Personal</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'extra') ? 'active' : ''; ?>" id="extra-tab" data-toggle="tab" onclick="viewAction()" role="tab" aria-controls="extra" aria-selected="false" name="extra">Extra</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'contact') ? 'active' : ''; ?>" id="contact-tab" data-toggle="tab" onclick="viewAction()" name="contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'education') ? 'active' : ''; ?>" id="education-tab" data-toggle="tab" onclick="viewAction()" name="education" role="tab" aria-controls="education" aria-selected="false">Education</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'training') ? 'active' : ''; ?>" id="training-tab" data-toggle="tab" onclick="viewAction()" name="training" role="tab" aria-controls="training" aria-selected="false">Training</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'experience') ? 'active' : ''; ?>" id="experience-tab" data-toggle="tab" onclick="viewAction()" name="experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'documents') ? 'active' : ''; ?>" id="document-tab" data-toggle="tab" onclick="viewAction()" name="documents" role="tab" aria-controls="document" aria-selected="false">Documents</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo ($tabcontent == 'preview') ? 'active' : ''; ?>" id="preview-tab" data-toggle="tab" onclick="viewAction()" name="preview" role="tab" aria-controls="preview" aria-selected="false">Preview</a>
								</li>
							</ul>


							<div class="tab-content mb-lg-4" id="myTabContent">

								<div class="tab-pane fade <?php echo ($tabcontent == 'personal') ? 'show active' : ''; ?>" id="personal" role="tabpanel" aria-labelledby="personal-tab">
									<div class="card-bordered card-body">

										<form method="POST" action="<?php echo base_url('profile/editNew'); ?>">
											<section class="col-lg-12 col-md-3 col-sm-2 col-2 mb-lg-4">
												<div class="mb-3">
													<h6>Basic</h6>
												</div>

												<div class="row">
													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Name (in English)</h6>
														</div>

														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="firstName" class="">First Name <span class="text-danger">*</span></label>
																	<input name="firstName" type="text" id="firstName" class="form-control" disabled="" value="<?php echo $user['FIRST_NAME']; ?>" required>
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="middleName" class="">Middle Name</label>
																	<input name="middleName" type="text" id="middleName" class="form-control" disabled="" value="<?php echo $user['MIDDLE_NAME']; ?>">
																</div>
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label for="lastName" class="">Last Name <span class="text-danger">*</span></label>
																	<input name="lastName" type="text" id="lastName" class="form-control" disabled="" value="<?php echo $user['LAST_NAME']; ?>" required>
																</div>
															</div>

														</div>
													</div>

													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Name (in Nepali)</h6>
														</div>

														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label for="fullName" class="">Full Name <span class="text-danger">*</span></label>
																	<input name="fullName" type="text" id="fullName" class="form-control" disabled="" value="<?php echo $user['NAME_NEPALI']; ?>" required>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2 col-xl-2">
														<div class="form-group">
															<label for="dob_ad" class="">Date of Birth (B.S.) <span class="text-danger">*</span></label>
															<input class="form-control " name="dob" id="dob_ad" value="<?php echo $user['DOB']; ?>" required />
														</div>
													</div>
													<div class="col-md-2 col-xl-2">
														<div class="form-group">
															<label for="dobAD" class="">Date of Birth (A.D.) <span class="text-danger">*</span></label>
															<input class="form-control " name="dob_ad" id="dob" placeholder="Select dates" required value="<?php echo $user['DOB_AD']; ?>" />
														</div>
													</div>
													<div class="col-md-3 col-xl-3">
														<div class="form-group">
															<label for="gender" class="">Gender</label>
															<div>
																<div class="form-check form-check-inline mr-1">
																	<input class="form-check-input" type="radio" name="gender" id="gender-M" disabled="" value="1" <?php echo ($user['GENDER_ID'] == '1') ? 'checked' : ''; ?>>
																	<label class="form-check-label" for="gender-M">Male</label>
																</div>
																<div class="form-check form-check-inline mr-1">
																	<input class="form-check-input" type="radio" name="gender" id="gender-F" disabled="" value="2" <?php echo ($user['GENDER_ID'] == '2') ? 'checked' : ''; ?>>
																	<label class="form-check-label" for="gender-F">Female</label>
																</div>
																<div class="form-check form-check-inline mr-0">
																	<input class="form-check-input" type="radio" name="gender" id="gender-O" disabled="" value="3" <?php echo ($user['GENDER_ID'] == '3') ? 'checked' : ''; ?>>
																	<label class="form-check-label" for="gender-O">Other</label>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-2 col-xl-2">
														<div class="form-group">
															<label for="age">Age</label>
															<input name="age" type="text" id="age" class="form-control" disabled="" value="<?php echo $user['AGE']; ?>">
														</div>
													</div>

													<div class="col-md-2 col-xl-2">
														<div class="form-group">
															<label for="maritalStatus">Marital Status</label>
															<select class="form-control" id="marital" name="marital" placeholder="marital" style="margin-bottom:10px;" required>
																<option value="Married" <?php echo ($user['MARITAL_STATUS'] == 'Married') ? 'selected' : '';?>>Married</option>
																<option value="Unmarried" <?php echo($user['MARITAL_STATUS'] == 'Unmarried') ? 'selected' : '';?>>Unmarried</option>
															</select>
														</div>
													</div>

												</div>
											</section>

											<section class="col-lg-12 col-md-3 col-sm-2 col-2 mb-lg-4">
												<div class="mb-3">
													<h6>Family</h6>
												</div>

												<div class="row mb-lg-4">
													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Father's Name</h6>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="fatherName">Full Name<span class="text-danger"> *</span></label>
																	<input name="fatherName" type="text" id="fatherName" class="form-control" value="<?php echo $user['FATHER_NAME']; ?>">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="father_qualification">Qualification</label>
																	<select class="form-control" name="father_qualification" required>
																		<option value="Literate" <?php echo ($user['FATHER_QUALIFICATION'] == 'Literate') ? 'selected' : ''; ?>>Literate</option>
																		<option value="Illiterate" <?php echo ($user['FATHER_QUALIFICATION'] == 'Illiterate') ? 'selected' : ''; ?>>Illiterate</option>
																		<option value="Upto SLC" <?php echo ($user['FATHER_QUALIFICATION'] == 'Upto SLC') ? 'selected' : ''; ?>>Upto SLC</option>
																		<option value="Higher Education" <?php echo ($user['FATHER_QUALIFICATION'] == 'Higher Education') ? 'selected' : ''; ?>>Higher Education</option>
																	</select>
																</div>
															</div>

															<div class="col-md-6">
																<label for="">Father's Occupation</label>
																<select class="form-control" id="fm_occupation" name="fm_occupation" placeholder="occupation" onchange='checkvalue(this.value,"fm_occupation_input")' style="margin-bottom: 5px;" required>

																	<option value="Agriculture" <?php echo ($user['FM_OCCUPATION'] == 'Agriculture') ? 'selected' : ''; ?>>Agriculture</option>
																	<option value="Business" <?php echo ($user['FM_OCCUPATION'] == 'Business') ? 'selected' : ''; ?>>Business</option>
																	<option value="Teaching (Private/Government)" <?php echo ($user['FM_OCCUPATION'] == 'Teaching (Private/Government)') ? 'selected' : ''; ?>>Teaching (Private/Government)</option>
																	<option value="Non-Government" <?php echo ($user['FM_OCCUPATION'] == 'Non-Government') ? 'selected' : ''; ?>>Non-Government</option>
																	<option value="Government service" <?php echo ($user['FM_OCCUPATION'] == 'Government service') ? 'selected' : ''; ?>>Government service</option>

																	<option value="other" <?php echo ($user['FM_OCCUPATION'] == 'other') ? 'selected' : ''; ?>>Others</option>
																</select>
															</div>

															<div class="col-md-6">
																<label>Specify if any (Father's Occupation)</label>
																<input class="form-control btn-input" placeholder="enter father's occupation" type="text" name="fm_occupation_input" value="<?php echo $user['FM_OCCUPATION_INPUT']; ?>" id="fm_occupation_input" <?php echo ($user['FM_OCCUPATION'] == 'other') ? 'required' : 'disabled'; ?>/>
															</div>
														</div>
													</div>

													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Mother's Name</h6>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="motherName" class="">Full Name<span class="text-danger"> *</span></label>
																	<input name="motherName" type="text" id="motherName" class="form-control" value="<?php echo $user['MOTHER_NAME']; ?>">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="mother_qualification" class="">Qualification</label>
																	<input name="mother_qualification" type="text" id="mother_qualification" class="form-control" value="<?php echo $user['MOTHER_QUALIFICATION']; ?>">
																</div>
															</div>
														</div>
													</div>

												</div>

												<div class="row">
													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Grand Father's Name</h6>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="grandfatherName" class="">Full Name<span class="text-danger"> *</span></label>
																	<input name="grandfatherName" type="text" id="grandfatherName" class="form-control" value="<?php echo $user['GRANDFATHER_NAME']; ?>">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="grandfather_nationality" class="">Nationality</label>
																	<input name="grandfather_nationality" type="text" id="grandfather_nationality" class="form-control" value="<?php echo $user['GRANDFATHER_NATIONALITY']; ?>">
																</div>
															</div>
														</div>
													</div>

													<div class="col-xl-6">
														<div class="heading-line mb-3">
															<h6>Husband's/Wife's Name</h6>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="spouseName" class="">Full Name</label>
																	<input name="spouseName" type="text" id="spouseName" class="form-control" value="<?php echo $user['SPOUSE_NAME']; ?>">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="spouse_nationality" class="">Nationality</label>
																	<input name="spouse_nationality" type="text" id="spouse_nationality" class="form-control" value="<?php echo $user['SPOUSE_NATIONALITY']; ?>">
																</div>
															</div>
														</div>
													</div>
												</div>

											</section>

											<section class="col-lg-12 col-md-3 col-sm-2 col-2 mb-lg-4">
												<div class="mb-3">
													<h6>Citizenship</h6>
												</div>

												<div class="row">
													<div class="col-md-4 col-xl-2">
														<div class="form-group">
															<label for="citizenship_no" class="">Citizenship No. <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="citizenship_no" id="citizenship_no" value="<?php echo $user['CITIZENSHIP_NO']; ?>" required>
														</div>
													</div>

													<div class="col-md-4 col-xl-2">
														<div class="form-group">
															<label for="citizenShipIssueDistrict" class="">Issuing District <span class="text-danger">*</span></label>
															<input type="hidden" class="form-control" name="ctz_issue_district_id" value="<?php echo $user['DISTRICT_ID']; ?>">
															
															<select class="form-control" name="ctz_issue_district_id">
																
																<?php
																	foreach ( $districts as $district ) {
																		$selected = ($district['DISTRICT_ID'] == $user['CTZ_ISSUE_DISTRICT_ID']) ? 'selected' : "";

																		echo '<option ' .$selected. ' value="'.$district['DISTRICT_ID'].'">'.$district['DISTRICT_NAME'].'</option>';
																	}
																?>
															</select>
														</div>
													</div>

													<div class="col-md-4 col-xl-2">
														<div class="form-group">
															<label for="issuedDateBs" class="">Issued Date(B.S.) <span class="text-danger">*</span></label>
															
															<input type="text" placeholder="YYYY-MM-DD" class="form-control " id="issue_date_ad" name="ctz_issue_date" value="<?php echo $user['CTZ_ISSUE_DATE']; ?>" required>
														</div>
													</div>

													<div class="col-md-4 col-xl-2">
														<div class="form-group">
															<label for="issuedDate" class="">Issued Date(A.D.) <span class="text-danger">*</span></label>
															<input type="text" class="form-control selectNepaliDate" id="issue_date" name="ctz_issue_date_ad" placeholder="Select dates" required value="<?php echo $user['CTZ_ISSUE_DATE_AD']; ?>">
														</div>
													</div>
												</div>
											</section>
											<input type="hidden" name="basic" value="basic">
											<button class="btn btn-noc text-light" type="submit" name="submit">Update</button>
										</form>
										
									</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'extra') ? 'show active' : ''; ?>" id="extra" role="tabpanel" aria-labelledby="extra-tab">
									<div class="card-bordered card-body">

								 		<form>
								 			<section class="mb-4">
								 				<div class="row">
								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="">Religion <span class="text-danger"> *</span></label>
															<select class="form-control" id="religion" name="religion" placeholder="religion" onchange='checkvalue(this.value,"religion_input")' style="margin-bottom:10px;" required>

																<option value=""> -- </option>
																<option value="Hindu" <?php echo ($user['RELIGION'] == 'Hindu') ? 'selected' : '';?>>Hindu</option>
																<option value="Buddhist" <?php echo ($user['RELIGION'] == 'Buddhist') ? 'selected' : '';?>>Buddhist</option>
																<option value="Muslim" <?php echo ($user['RELIGION'] == 'Muslim') ? 'selected' : '';?>>Muslim</option>
																<option value="Christian" <?php echo ($user['RELIGION'] == 'Christian') ? 'selected' : '';?>>Christian</option>

																<?php if (($user['RELIGION_INPUT'] != '') && $user['RELIGION'] == 'others') {
																	echo '<option value="others" selected>' . $user['RELIGION_INPUT']  . '</option>';
																} ?>
																<option value="other">others</option>
															</select>
															
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label>Specify if any others (Religion):</label>
								 							<input class="form-control btn-input" placeholder="specify religion" type="text" name="religion_input" id="religion_input" value="<?php echo $user['RELIGION_INPUT']; ?>" disabled />
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
															<label for="region_input">Region <span class="text-danger"> *</span></label>
															<select class="form-control" id="region" name="region" placeholder="Region" onchange='checkvalue(this.value,"region_input")' style="margin-bottom:10px;" required>
																<option value="Himali" <?php echo ($user['REGION'] == 'Himali') ? 'selected' : '';?>>Himali</option>
																<option value="Pahadi" <?php echo ($user['REGION'] == 'Pahadi') ? 'selected' : '';?>>Pahadi</option>
																<option value="Madhesi" <?php echo ($user['REGION'] == 'Madhesi') ? 'selected' : '';?>>Madhesi</option>
																<option value="Backward community" <?php echo ($user['REGION'] == 'Backward community') ? 'selected' : '';?>>Backward community</option>
																<option value="other" <?php echo ($user['REGION'] == 'others') ? 'selected' : '';?>>others</option>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="region_input">Specify if any others (Region):</label>
								 							<input class="form-control btn-input" placeholder="Specify Region" type="text" name="region_input" value="<?php echo $user['REGION_INPUT']; ?>" id="region_input" disabled />
								 						</div>
								 					</div>
								 				</div>

								 				<div class="row">
								 					<div class="col-md-3">
								 						<div class="form-group">
															<label>Employment status <span class="text-danger"> *</span></label>
															<select class="form-control" id="employment" name="employment" placeholder="select employment" onchange='checkvalue(this.value,"employment_input")' required>

																<option value="Unmployed" <?php echo ($user['EMPLOYMENT_STATUS'] == 'Unmployed') ? 'selected' : '';?>>
																	Unmployed
																</option>
																<option value="Government Service" <?php echo ($user['EMPLOYMENT_STATUS'] == 'Government Service') ? 'selected' : '';?>>
																	Government Service
																</option>
																<option value="other" <?php echo ($user['EMPLOYMENT_STATUS'] == 'others') ? 'selected' : '';?>>
																	Others
																</option>
															</select>
														</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="employment_input">Specify if any others (Employment):</label>
								 							<input class="form-control btn-input" placeholder="Employment Status" type="text" name="employment_input" id="employment_input" value="<?php echo $user['EMPLOYMENT_INPUT']; ?>" disabled />
								 						</div>
								 					</div>

													<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="mother_tongue">Mother Tongue <span class="text-danger"> *</span></label>
								 							<input class="form-control" name="mother_tongue" id="mother_tongue" value="<?php echo $user['MOTHER_TONGUE']; ?>" required>
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="blood_group">Blood Group</label>
															<select class="form-control" name="blood_group" id="blood_group">
																<?php foreach ($blood_groups as $blood_group) { ?>
																	<option value="<?php echo $blood_group['BLOOD_GROUP_ID'] ?>" 
																		<?php echo ($user['BLOOD_GROUP_ID'] == $blood_group['BLOOD_GROUP_ID']) ? 'selected' : ''; ?>>
																		<?php echo $blood_group['BLOOD_GROUP_CODE'] ?>
																	</option>
																<?php } ?>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label>Are you physically disabled? <span class="text-danger"> *</span></label>
								 							<!-- <div>
																<div class="form-check form-check-inline mr-1">
																	<input class="form-check-input" type="radio" name="disability" id="disability-y" disabled="" value="Yes" <?php echo ($user['DISABILITY'] == 'Yes') ? 'checked' : ''; ?>>
																	<label class="form-check-label" for="disability-y">Yes</label>
																</div>

																<div class="form-check form-check-inline mr-1">
																	<input class="form-check-input" type="radio" name="disability" id="disability-n" disabled="" value="No" <?php echo ($user['DISABILITY'] == 'No') ? 'checked' : ''; ?>>
																	<label class="form-check-label" for="disability-n">No</label>
																</div>
															</div> -->
															<select class="form-control" id="disability" name="disability" placeholder="select --" style="margin-bottom:10px;" onchange='checkvalue(this.value,"disability_input")' required>
																<option value="Yes" <?php echo ($user['DISABILITY'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
																<option value="No" <?php echo ($user['DISABILITY'] == 'No') ? 'selected' : ''; ?>>No</option>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-3">
								 						<div class="form-group">
								 							<label for="disability_input">Specify if yes (Physical Disability):</label>
								 							<input class="form-control btn-input" placeholder="specify physical disability" type="text" name="disability_input" id="disability_input" value="<?php echo $user['DISABILITY_INPUT'];?>" <?php echo ($user['DISABILITY_INPUT'] !== '') ? '' : 'disabled'; ?> />
								 						</div>
								 					</div>
								 				</div>

								 			</section>
								 		</form>
								 	</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'contact') ? 'show active' : ''; ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								 	<div class="card-bordered card-body">

								 		<form>
								 			<section class="mb-4">
								 				<div class="heading-line mb-3">
								 					<h6>Permanent Address</h6>
								 				</div>
								 				<div class="row">
								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="per_province">Province</label>
															<input type="hidden" id="base" value="<?php echo base_url(); ?>">
															<input type="hidden" class="form-control" name="per_province_id" value="<?php echo $user['PER_PROVINCE_ID']; ?>">
															<p>
																<select name="per_province" class="form-control form-control-sm" id="per_province">
																	<option value="">-- Select --</option>
																	<?php foreach ($proviences as  $provience) {
																		$selected = ($provience['PROVINCE_ID'] == $user['PER_PROVINCE_ID']) ? "selected" . " id='per_province_selected'" : "";
																	?>
																		<option <?php echo $selected; ?> value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
																	<?php } ?>
																</select>
															</p>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="">District</label>
								 							<label for="per_district">District</label>
															<input type="hidden" class="form-control" name="per_district_id_selected" id="per_district_id_selected" value="<?php echo $user['PER_DISTRICT_ID']; ?>">
															<select name="per_district" class="form-control form-control-sm" id="per_district">
																<option value="">---</option>

															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="per_province">Municipality / VDC</label>
															<input type="hidden" class="form-control" name="per_vdc_id" id="per_vdc_id_selected" value="<?php echo $user['PER_VDC_ID']; ?>">
															<select name="per_vdc" class="form-control form-control-sm" id="per_vdc">
																<option value="">---</option>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="per_ward_no">Ward Number</label>
															<input type="text" class="form-control" name="per_ward_no" value="<?php echo $user['PER_WARD_NO']; ?>">
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="">Tole Name</label>
															<input type="text" class="form-control" name="per_tole" value="<?php echo $user['PER_TOLE']; ?>">
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="per_house_no">House Number</label>
															<input type="text" class="form-control" name="per_house_no" value="<?php echo $user['PER_HOUSE_NO']; ?>" >
								 						</div>
								 					</div>


								 				</div>
								 			</section>


								 			<section class="mb-4">
								 				<div class="heading-line mb-3">
								 					<h6>Mailing Address</h6>
								 				</div>
								 				<div class="row">
								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="">Province</label>
															<input type="hidden" class="form-control" name="mail_province_id" value="<?php echo $user['MAIL_PROVINCE_ID']; ?>">
															<p>
																<select name="mail_province" class="form-control form-control-sm" id="mail_province">
																	<option value="">-- Select --</option>
																	<?php foreach ($proviences as  $provience) {
																		$selected = ($provience['PROVINCE_ID'] == $user['MAIL_PROVINCE_ID']) ? "selected" . " id='mail_province_selected'" : "";
																	?>
																		<option <?php echo $selected; ?> value="<?php echo $provience['PROVINCE_ID'] ?>"><?php echo $provience['PROVINCE_NAME'] ?></option>
																	<?php } ?>
																</select>
															</p>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="">District</label>
															<input type="hidden" class="form-control" name="mail_district_id_selected" id="mail_district_id_selected" value="<?php echo $user['MAIL_DISTRICT_ID']; ?>">
															<select name="mail_district" class="form-control form-control-sm" id="mail_district">
																<option value="">---</option>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="mail_province">Muicipality/VDC</label>
															<input type="hidden" class="form-control" name="mail_vdc_id" id="mail_vdc_id_selected" value="<?php echo $user['MAIL_VDC_ID']; ?>">
															<select name="mail_vdc" class="form-control form-control-sm" id="mail_vdc">
																<option value="">---</option>
															</select>
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="mail_ward_no">Ward Number</label>
															<input type="text" class="form-control" name="mail_ward_no" value="<?php echo $user['MAIL_WARD_NO']; ?>">
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="mail_tole">Tole Name</label>
															<input type="text" class="form-control" name="mail_tole" value="<?php echo $user['MAIL_TOLE']; ?>">
								 						</div>
								 					</div>

								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="mail_house_no">House Number</label>
															<input type="text" class="form-control" name="mail_house_no" value="<?php echo $user['MAIL_HOUSE_NO']; ?>" >
								 						</div>
								 					</div>


								 				</div>
								 			</section>

								 			<section>
								 				<div class="heading-line mb-3">
								 					<h6>Phone Number</h6>
								 				</div>

								 				<div class="row">
								 					<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="mobile_no">Mobile No.</label>
							 								<input type="text" class="form-control" name="mobile_no" value="<?php echo $user['MOBILE_NO']; ?>">
							 							</div>
							 						</div>

							 						<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="phone_no">Phone Number</label>
															<input type="text" class="form-control" name="phone_no" value="<?php echo $user['PHONE_NO']; ?>">
							 							</div>
							 						</div>

							 						<div class="col-sm-4">
								 						<div class="form-group">
								 							<label for="email_id">Email</label>
															<input type="email" class="form-control" name="email_id" value="<?php echo $user['EMAIL_ID']; ?>">
							 							</div>
							 						</div>
								 				</div>
								 			</section>


								 		</form>

								 	</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'education') ? 'show active' : ''; ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								 	<div class="card-bordered card-body">

							 			<section class="mb-4">
							 				<div class="heading-line mb-3">
							 					<h6>Education Description</h6>
							 				</div>
							 				<div class="table-responsive">
							 					<table role="table" class="table table-striped table-rounded table-sm">
							 						<thead>
							 							<tr role="row">
							 								<th colspan="1">
							 									Board Name
							 								</th>
							 							</tr>
							 						</thead>
							 						
							 					</table>
							 				</div>
							 			</section>
								 	</div>
								</div>


								<div class="tab-pane fade <?php echo ($tabcontent == 'training') ? 'show active' : ''; ?>" id="training" role="tabpanel" aria-labelledby="training-tab">
								 	<div class="card-bordered card-body">

								 	</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'experience') ? 'show active' : ''; ?>" id="experience" role="tabpanel" aria-labelledby="experience-tab">
								 	<div class="card-bordered card-body">
								 		<form>
								 			<section class="mb-4">
								 				<div class="mb-3">
								 					<div class="d-flex align-items-center justify-content-between mb-2">
									 					<h6>Experience Description (If any)</h6>
									 					<button type="button" class="btn btn-primary">
									 						Add
									 					</button>
									 				</div>
								 				<p class="text-muted">For applying in internal category and age relaxation, please metion working status (रोजगारीको अवस्था) as 'Working' in your current experience only and for previous experience please mention working status (रोजगारीको अवस्था) as 'Transfered'</p>
								 				</div>
								 				<div class="row">
								 					<div class="col-md-4">
								 						<div class="form-group col-md-3">
															<label for="">Are you NOC Employee?</label>
															<select class="form-control" name="in_service" id="in_service">
																<option value="">---</option>
																<option value="Y" <?php echo ($user['IN_SERVICE'] == 'YES') ? 'selected' : '';  ?>>Yes</option>
																<option value="N" <?php echo ($user['IN_SERVICE'] == 'NO') ? 'selected' : ''; ?>>No</option>
															</select>
															<?php if (!empty($documents)) {
																foreach ($documents as $doc) {
																	if (($doc['DOC_FOLDER'] == 'in_service') && ($user['IN_SERVICE'] == 'YES')) {
																		echo '<a href="' . $doc['DOC_PATH'] . '" target= "_blank" class="btn btn-primary" id="inservice_view" style="margin:10px">View File</a>';
																	}
																}
															}  ?>
															<input class="form-control btn-input form-control-file" type="file" name="inservice_file" id="inservice_file" style='display:none;' />
														</div>
								 					</div>

								 				</div>
								 			</section>
								 		</form>
								 	</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'documents') ? 'show active' : ''; ?>" id="documents" role="tabpanel" aria-labelledby="documents-tab">
								 	<div class="card-bordered card-body">
								 		<section class="mb-4">
								 			<div class="mb-3">
								 				<h6>Documents Description</h6>
								 			</div>
								 		</section>

								 		<section class="mb-4">
								 			<div class="row">
								 				<div class="col-md-12">
								 					<h6 class="heading-line mb-2">Your Scanned Inclusion Group अपाङ्ग समूह प्रमाणपत्र<span class="text-danger">*</span></h6>
								 					<p class="mb-3">Upload your scanned Inclusion Group</p>

								 					<div class="row">
								 						<div class="col-md-8">
								 							<div class="img-wrapper img-profile mb-3">
										 						<div class="img-overlay"></div>
										 						<?php 
																	if(!empty($documents)){
																		foreach($documents as $doc){
																			if(($doc['DOC_FOLDER'] == 'disability') && $user['DISABILITY'] == "Yes"){
																				echo '<img src="'.$doc['DOC_PATH'].'" style="width:30%"/>';
																				echo '<a href="'. $doc['DOC_PATH'].'" target= "_blank" class="btn btn-primary" id="disability_view" style="margin:10px">View File</a>';
																			} 



																		}
																	}
																?>
										 					</div>

										 					<div class="img-border">
										 						<div class="row">
										 							<div class="col-md-6">
										 								<div class="form-group">
												 							<label>Update Scanned Update Inclusion Group</label>
												 							<input type="file" accept="image/png, image/jpeg" name="disability_file" id="disability_file">
												 						</div>
										 							</div>
										 							<div class="col-md-2">
										 								<div class="form-group img-border-btn">
										 									<button type="submit" class="btn btn-noc text-light">Update</button>
										 								</div>
										 							</div>
										 						</div>
										 						
										 					</div>
								 						</div>
								 					</div>

								 					
								 				</div>
								 				
								 			</div>

								 			<div class="row">
								 				<div class="col-md-12">
								 					<h6 class="heading-line mb-2">Your Scanned Inclusion Group Aadibasi/ Janajapt / Dalit / Vaishya / Madhesi <span class="text-danger">*</span></h6>
								 					<p class="mb-3">Upload your scanned Inclusion Group.</p>

								 					<div class="row">
								 						<div class="col-md-8">
								 							<div class="img-wrapper img-profile mb-3">
										 						<div class="img-overlay"></div>
																<?php
																	if (!empty($documents)) {
																		foreach ($documents as $doc) {
																			if ($doc['DOC_FOLDER'] == 'ethnicity') {
																				echo '<img src="'.$doc['DOC_PATH'].'" style="width:30%"/>';
																				echo '<a href="' . $doc['DOC_PATH'] . '" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
																			}
																		}
																	}
																?>
										 					</div>

										 					<div class="img-border">
										 						<div class="row">
										 							<div class="col-md-6">
										 								<div class="form-group">
												 							<label>Update Scanned Update Inclusion Group</label>
												 							<input type="file" accept="image/png, image/jpeg" name="ethnicity_file" id="ethnicity_file">
												 						</div>
										 							</div>
										 							<div class="col-md-2">
										 								<div class="form-group img-border-btn">
										 									<button type="submit" class="btn btn-noc text-light">Update</button>
										 								</div>
										 							</div>
										 						</div>
										 						
										 					</div>
								 						</div>
								 					</div>

								 					
								 				</div>
								 				
								 			</div>

								 			<div class="row">
								 				<div class="col-md-12">
								 					<h6 class="heading-line mb-2">Your Scanned NOC Employee ID Card  <span class="text-danger"> (optional)</span></h6>
								 					<p class="mb-3">Upload your scanned NOC Employee ID Card.</p>

								 					<div class="row">
								 						<div class="col-md-8">
								 							<div class="img-wrapper img-profile mb-3">
										 						<div class="img-overlay"></div>
																<?php
																	if (!empty($documents)) {
																		foreach ($documents as $doc) {
																			if (($doc['DOC_FOLDER'] == 'in_service') && ($user['IN_SERVICE'] == 'YES')) {
																				echo '<img src="'.$doc['DOC_PATH'].'" style="width:30%"/>';
																				echo '<a href="' . $doc['DOC_PATH'] . '" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
																			}
																		}
																	}
																?>

										 					</div>

										 					<div class="img-border">
										 						<div class="row">
										 							<div class="col-md-6">
										 								<div class="form-group">
												 							<label>Update Scanned NOC Employee ID Card</label>
												 							<input type="file" accept="image/png, image/jpeg" name="inservice_file" id="inservice_file">
												 						</div>
										 							</div>
										 							<div class="col-md-2">
										 								<div class="form-group img-border-btn">
										 									<button type="submit" class="btn btn-noc text-light">Update</button>
										 								</div>
										 							</div>
										 						</div>
										 						
										 					</div>
								 						</div>
								 					</div>

								 					
								 				</div>
								 				
								 			</div>
								 		</section>
								 	</div>
								</div>

								<div class="tab-pane fade <?php echo ($tabcontent == 'preview') ? 'show active' : ''; ?>" id="preview" role="tabpanel" aria-labelledby="preview-tab">
								 	<div class="card-bordered card-body">

								 	</div>
								</div>
								
							</div>


							<!-- <div class="footer-btn">
								<button type="submit" class="prevtab btn btn-primary">
									<div class="">
										<div>Prev</div>
									</div>
								</button>
								<button type="submit" class="nexttab btn btn-danger">
									<div class="">
										<div>Next</div>
									</div>
								</button>
							</div> -->
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script type='text/javascript' src='<?php echo base_url('assets/js/Datepicker/custom.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>'></script>
 <script type="text/javascript">
      /* -------------------------------------------------------------
            bootstrapTabControl
        ------------------------------------------------------------- */
        function bootstrapTabControl(){
            var i, items = $('.nav-link'), pane = $('.tab-pane');
            // next
            $('.nexttab').on('click', function(){
                for(i = 0; i < items.length; i++){
                    if($(items[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i < items.length - 1){
                    // for tab
                    $(items[i]).removeClass('active');
                    $(items[i+1]).addClass('active');
                    // for pane
                    $(pane[i]).removeClass('show active');
                    $(pane[i+1]).addClass('show active');
                }

            });
            // Prev
            $('.prevtab').on('click', function(){
                for(i = 0; i < items.length; i++){
                    if($(items[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i != 0){
                    // for tab
                    $(items[i]).removeClass('active');
                    $(items[i-1]).addClass('active');
                    // for pane
                    $(pane[i]).removeClass('show active');
                    $(pane[i-1]).addClass('show active');
                }
            });
        }
        bootstrapTabControl();



        function checkvalue(val, id_input) {


			if (val === "other" || val === 'Yes') {

				// document.getElementById(id_input).removeAttribute("disabled");

				document.getElementById(id_input).disabled = false;
				document.getElementById(id_input).required = true;

			} else {
				
				document.getElementById(id_input).disabled = true;
				document.getElementById(id_input).required = false;
				document.getElementById(id_input).value ='';

			}
		}

		app.startEndDatePickerWithNepali('dob_ad', 'dob', 'issue_date_ad', 'issue_date');

		function viewAction() {

			let url   = "<?php echo base_url();?>";

			let getId = event.srcElement.id;

			let attr  = document.getElementById(getId).getAttribute('name');

			window.location.href = url + 'profile/view/' + attr;

		}
    </script>

<script src="<?php echo base_url(); ?>assets/js/profile/edit.js"></script>