<link href="<?= base_url(); ?>assets/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<main class="main-user-profile bg-light">
	<section class="user-profile-sec sec-padd">
		<div class="container">
			<div class="col-lg-12">
				<div class="card">
					<div class="left-form p-5">
						<div class="d-flex" style="justify-content: space-between;align-items: baseline;">
							<h5 class="main-title"><i class="fa fa-user pr-2" aria-hidden="true"></i>Welcome <?php echo $user['FIRST_NAME']; ?>!</h5>
							<a href="<?php echo base_url('profile/view') ?>" class="btn btn-info"><i class="fa fa-eye pr-1" aria-hidden="true"></i><small>View Profile</small></a>
						</div>




						<!-- <form method="post" id="profileEdit"> -->
						<?php echo form_open_multipart('profile/edit', ['method' => 'post', 'id' => 'profileEdit']); ?>
						<h6 class="form-table-title bg-primary">Personal Information</h6>
						<hr>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">First Name</label>
								<input type="text" class="form-control" value="<?php echo $user['FIRST_NAME']; ?>" name="first_name">
							</div>
							<div class="form-group col-md-4">
								<label for="">Middle Name</label>
								<input type="text" class="form-control" value="<?php echo $user['MIDDLE_NAME']; ?>" name="middle_name">
							</div>
							<div class="form-group col-md-4">
								<label for="">Last Name</label>
								<input type="text" class="form-control" value="<?php echo $user['LAST_NAME']; ?>" name="last_name">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<!-- <label>Date of Birth</label>
								<input class="form-control" value="<?php echo $user['DOB']; ?>" > -->
								<label>Date of Birth (B.S)</label>
								<!-- <input class="form-control " name="dob_ad" id="dob" placeholder="Select dates" /> -->
								<input class="form-control " name="dob" id="dob_ad" value="<?php echo $user['DOB']; ?>" />
							</div>

							<div class="form-group col-md-3">
								<!-- <label>Date of Birth</label>
								<input class="form-control" value="<?php echo $user['DOB']; ?>" > -->
								<label>Date of Birth (A.D)</label>
								<input class="form-control " name="dob_ad" id="dob" placeholder="Select dates"  value="<?php echo $user['DOB_AD']; ?>" readonly/>
								<!-- <input class="form-control " name="dob" id="dob_ad" value="<?php echo $user['DOB']; ?>" /> -->
							</div>

							<div class="form-group col-md-2">
								<label for="">Age</label>
								<input class="form-control" value="<?php echo $user['AGE']; ?>" name="age" id="age">
							</div>

							<div class="form-group col-md-2">
								<label>Gender</label>
								<select class="form-control" id="gender" name="gender" placeholder="Gender" required>
									<option> -Gender-</option>
									<option value="1" <?php if ($user['GENDER_ID'] == '1') {
															echo 'selected';
														} ?>>Male</option>
									<option value="2" <?php if ($user['GENDER_ID'] == '2') {
															echo 'selected';
														} ?>>Female</option>
									<option value="3" <?php if ($user['GENDER_ID'] == '3') {
															echo 'selected';
														} ?>>Other</option>
								</select>
							</div>

							<div class="form-group col-md-2">
								<label>Marital Status</label>
								<select class="form-control" id="marital" name="marital" placeholder="marital" style="margin-bottom:10px;" required>
									<option value="Married" <?php if ($user['MARITAL_STATUS'] == 'Married') {
																echo 'selected';
															} ?>>Married</option>
									<option value="Unmarried" <?php if ($user['MARITAL_STATUS'] == 'Unmarried') {
																	echo 'selected';
																} ?>>Unmarried</option>
								</select>
							</div>
						</div>

						<hr>
						<h6 class="form-table-title bg-primary">Contact Information</h6>
						<hr>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">Mobile Number</label>
								<input type="text" class="form-control" name="mobile_no" value="<?php echo $user['MOBILE_NO']; ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="">Phone Number</label>
								<input type="text" class="form-control" name="phone_no" value="<?php echo $user['PHONE_NO']; ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="">Email</label>
								<input type="email" class="form-control" value="<?php echo $user['EMAIL_ID']; ?>" name="email_id">
							</div>
						</div>

						<hr>
						<h6 class="form-table-title bg-primary">Citizenship Information</h6>
						<hr>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">Citizenship Number</label>
								<input type="text" class="form-control" value="<?php echo $user['CITIZENSHIP_NO']; ?>" name="citizenship_no">
							</div>

							<div class="form-group col-md-3">
								<label for="">Issue Date (B.S)</label>
								<input type="text" placeholder="YYYY-MM-DD" class="form-control " id="issue_date_ad" name="ctz_issue_date" value="<?php echo $user['CTZ_ISSUE_DATE']; ?>">
							</div>


							<div class="form-group col-md-3">
								<label for="">Issue Date (A.D)</label>
								<input type="text" class="form-control selectNepaliDate" id="issue_date" name="ctz_issue_date_ad" placeholder="Select dates" value="<?php echo $user['CTZ_ISSUE_DATE_AD']; ?>" readonly>
								
							</div>

							<div class=" form-group col-md-3">
								<label for="">Issue District</label>
								<input type="hidden" class="form-control" name="ctz_issue_district_id" value="<?php echo $user['DISTRICT_ID']; ?>">
								
								<select class="form-control" name="ctz_issue_district_id">
								
									<?php
									foreach ($districts as $district) {
										$selected = ($district['DISTRICT_ID'] == $user['CTZ_ISSUE_DISTRICT_ID']) ? 'selected' : "";
										echo '<option ' . $selected . ' value="' . $district['DISTRICT_ID'] . '">' . $district['DISTRICT_NAME'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>

						<hr>
						<h6 class="form-table-title bg-primary">Family Information</h6>
						<hr>


						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">Father Name</label>
								<input type="text" class="form-control" name="father_name" value="<?php echo $user['FATHER_NAME']; ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="">Father Qualification</label>
								<select class="form-control" name="father_qualification" required>
									<option value="Literate" <?php if ($user['FATHER_QUALIFICATION'] == 'Literate') {
																	echo 'selected';
																} ?>>Literate</option>
									<option value="Illiterate" <?php if ($user['FATHER_QUALIFICATION'] == 'Illiterate') {
																	echo 'selected';
																} ?>>Illiterate</option>
									<option value="Upto SLC" <?php if ($user['FATHER_QUALIFICATION'] == 'Upto SLC') {
																	echo 'Upto SLC';
																} ?>>Upto SLC</option>
									<option value="Higher Education" <?php if ($user['FATHER_QUALIFICATION'] == 'Higher Education') {
																			echo 'selected';
																		} ?>>Higher Education</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="">Father Mother Occupation</label>
								<select class="form-control" id="fm_occupation" name="fm_occupation" placeholder="occupation" onchange='checkvalue(this.value,"fm_occupation_input")' style="margin-bottom: 5px;" required>
									<option value="Agriculture" <?php if ($user['FM_OCCUPATION'] == 'Agriculture') {
																	echo 'selected';
																} ?>>Agriculture</option>
									<option value="Business" <?php if ($user['FM_OCCUPATION'] == 'Business') {
																	echo 'selected';
																} ?>>Business</option>
									<option value="Teaching (Private/Government)" <?php if ($user['FM_OCCUPATION'] == 'Teaching (Private/Government)') {
																						echo 'selected';
																					} ?>>Teaching (Private/Government)</option>
									<option value="Non-Government" <?php if ($user['FM_OCCUPATION'] == 'Non-Government') {
																		echo 'selected';
																	} ?>>Non-Government</option>
									<option value="Government service" <?php if ($user['FM_OCCUPATION'] == 'Government service') {
																			echo 'selected';
																		} ?>>Government service</option>
									<option value="others" <?php if ($user['FM_OCCUPATION'] == 'others') {
																echo 'selected';
															} ?>><?php echo $user['FM_OCCUPATION_INPUT']; ?></option>
									<option value="other">others</option>
								</select>
							</div>
							<div class="form-group col-md-3"  id="fm_occupation_input" style='display:none;' >
								<label>Specify any occupation</label>
								<input class="form-control btn-input" placeholder="fm_occupation" type="text" name="fm_occupation_input" value="<?php echo $user['FM_OCCUPATION_INPUT']; ?>"/>
							</div>

						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Mother Name</label>
								<input type="text" class="form-control" name="mother_name" value="<?php echo $user['MOTHER_NAME']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">Mother Qualification</label>
								<select class="form-control" name="mother_qualification" required>
									<option value="Literate" <?php if ($user['MOTHER_QUALIFICATION'] == 'Literate') {
																	echo 'selected';
																} ?>>Literate</option>
									<option value="Illiterate" <?php if ($user['MOTHER_QUALIFICATION'] == 'Illiterate') {
																	echo 'selected';
																} ?>>Illiterate</option>
									<option value="Upto SLC" <?php if ($user['MOTHER_QUALIFICATION'] == 'Upto SLC') {
																	echo 'Upto SLC';
																} ?>>Upto SLC</option>
									<option value="Higher Education" <?php if ($user['MOTHER_QUALIFICATION'] == 'Higher Education') {
																			echo 'selected';
																		} ?>>Higher Education</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for=""> Grandfather Name</label>
								<input type="text" class="form-control" name="grandfather_name" value="<?php echo $user['GRANDFATHER_NAME']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">Grandfather Nationality</label>
								<select class="form-control" name="grandfather_nationality" required>
									<option value="Nepali" <?php if ($user['GRANDFATHER_NATIONALITY'] == 'Nepali') {
																echo 'selected';
															} ?>>Nepali</option>
									<option value="others" <?php if ($user['GRANDFATHER_NATIONALITY'] == 'others') {
																echo 'selected';
															} ?>>others</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Spouse Name</label>
								<input type="text" class="form-control" name="spouse_name" id="spouse_name" value="<?php echo $user['SPOUSE_NAME']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">Spouse Nationality</label>
								<select class="form-control" name="spouse_nationality" id="spouse_nationality">
									<option value="">---</option>
									<option value="Nepali" <?php if ($user['SPOUSE_NATIONALITY'] == 'Nepali') {
																echo 'selected';
															} ?>>Nepali</option>
									<option value="others" <?php if ($user['SPOUSE_NATIONALITY'] == 'others') {
																echo 'selected';
															} ?>>others</option>
								</select>
							</div>
						</div>


						<hr>
						<h6 class="form-table-title bg-primary">Extra Information</h6>
						<hr>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Religion</label>
								<select class="form-control" id="religion" name="religion" placeholder="religion" onchange='checkvalue(this.value,"religion_input")' style="margin-bottom:10px;" required>
									<option value="">Religion</option>
									<option value="Hindu" <?php if ($user['RELIGION'] == 'Hindu') {
																echo 'selected';
															} ?>>Hindu</option>
									<option value="Buddhist" <?php if ($user['RELIGION'] == 'Buddhist') {
																	echo 'selected';
																} ?>>Buddhist</option>
									<option value="Muslim" <?php if ($user['RELIGION'] == 'Muslim') {
																echo 'selected';
															} ?>>Muslim</option>
									<option value="Christian" <?php if ($user['RELIGION'] == 'Christian') {
																	echo 'selected';
																} ?>>Christian</option>
									<?php if (($user['RELIGION_INPUT'] != '') && $user['RELIGION'] == 'others') {
										echo '<option value="others" selected>' . $user['RELIGION_INPUT']  . '</option>';
									} ?>
									<option value="other">others</option>
								</select>

								<input class="form-control btn-input" placeholder="Religion" type="text" name="religion_input" id="religion_input" value="<?php echo $user['RELIGION_INPUT']; ?>" style='display:none;' />
							</div>


							<div class="form-group col-md-4">
								<label for="">Region</label>
								<select class="form-control" id="region" name="region" placeholder="Region" onchange='checkvalue(this.value,"region_input")' style="margin-bottom:10px;" required>
									<option value="Himali" <?php if ($user['REGION'] == 'Himali') {
																echo 'selected';
															} ?>>Himali</option>
									<option value="Pahadi" <?php if ($user['REGION'] == 'Pahadi') {
																echo 'selected';
															} ?>>Pahadi</option>
									<option value="Madhesi" <?php if ($user['REGION'] == 'Madhesi') {
																echo 'selected';
															} ?>>Madhesi</option>
									<option value="Backward community" <?php if ($user['REGION'] == 'Backward community') {
																			echo 'selected';
																		} ?>>Backward community</option>
									<?php if (($user['REGION_INPUT'] != '') && $user['REGION'] == 'others') {
										echo '<option value="others" selected>' . $user['REGION_INPUT']  . '</option>';
									} ?>
									<option value="other">others</option>
								</select>
								<input class="form-control btn-input" placeholder="Region" type="text" name="region_input" value="<?php echo $user['REGION_INPUT']; ?>" id="region_input" style='display:none;' />
							</div>

							<div class="form-group col-md-4">
								<label for="">Inclusion</label>
								<select class="form-control" name="ethnicity" id="ethnicity" placeholder="Ethnicity" required onchange='checkValueWithFile(this.value,"ethnicity_input","ethnicity_file")' style="margin-bottom:10px;">
									<option value="Aadibasi/Janajati" <?php if ($user['ETHNIC_NAME'] == 'Aadibasi/Janajati') {
																			echo 'selected';
																		} ?>>Aadibasi/Janajati</option>
									<option value="Dalit" <?php if ($user['ETHNIC_NAME'] == 'Dalit') {
																echo 'selected';
															} ?>>Dalit</option>
									<option value="Vaishya" <?php if ($user['ETHNIC_NAME'] == 'Vaishya') {
																echo 'selected';
															} ?>>Vaishya</option>
									<option value="Chhetri" <?php if ($user['ETHNIC_NAME'] == 'Chhetri') {
																echo 'selected';
															} ?>>Chhetri</option>
									<option value="Brahman" <?php if ($user['ETHNIC_NAME'] == 'Brahman') {
																echo 'selected';
															} ?>>Brahman</option>
									<option value="Madhesi" <?php if ($user['ETHNIC_NAME'] == 'Madhesi') {
																echo 'selected';
															} ?>>Madhesi</option>
									<option value="Mushalman" <?php if ($user['ETHNIC_NAME'] == 'Mushalman') {
																	echo 'selected';
																} ?>>Mushalman</option>
									<?php if (($user['ETHNIC_INPUT'] != '') && $user['ETHNIC_NAME'] == 'others') {
										echo '<option value="others" selected>' . $user['ETHNIC_INPUT']  . '</option>';
									} ?>
									<option value="other">others</option>
								</select>
								<input class="form-control btn-input" placeholder="Ethnicity input" type="text" name="ethnicity_input" id="ethnicity_input" value="<?php echo $user['ETHNIC_INPUT']; ?>" style='display:none;' />
								<input class="form-control btn-input form-control-file" type="file" name="ethnicity_file" id="ethnicity_file" style='display:none;' />
								<?php
								if (!empty($documents)) {
									foreach ($documents as $doc) {
										if ($doc['DOC_FOLDER'] == 'ethnicity') {
											echo '<a href="' . $doc['DOC_PATH'] . '" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
										}
									}
								}
								?>
							</div>
						</div>

						<hr>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Mother Tongue</label>
								<input class="form-control" name="mother_tongue" id="mother_tongue" value="<?php echo $user['MOTHER_TONGUE']; ?>">
							</div>

							<div class="form-group col-md-4">
								<label for="">Blood Group</label>
								<select class="form-control" name="blood_group" id="blood_group">
									<?php foreach ($blood_groups as $blood_group) { ?>
										<option value="<?php echo $blood_group['BLOOD_GROUP_ID'] ?>"><?php echo $blood_group['BLOOD_GROUP_CODE'] ?></option>
									<?php } ?>
								</select>
							</div>

						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Employment status</label>
								<select class="form-control" id="employment" name="employment" placeholder="employment" style="margin-bottom:10px;" onchange='checkvalue(this.value,"employment_input")' required>
									<option value="Unmployed" <?php if ($user['EMPLOYMENT_STATUS'] == 'Unmployed') {
																	echo 'selected';
																} ?>>Unmployed</option>
									<option value="Government Service" <?php if ($user['EMPLOYMENT_STATUS'] == 'Government Service') {
																			echo 'selected';
																		} ?>>Government Service</option>
									<?php if (($user['EMPLOYMENT_STATUS'] != '') && $user['EMPLOYMENT_STATUS'] == 'others') {
										echo '<option value="others" selected>' . $user['EMPLOYMENT_STATUS']  . '</option>';
									} ?>
									<option value="other">others</option>
								</select>
								
							</div>

							<div class="form-group col-md-6"  >
								<label></label>
								<input class="form-control btn-input mt-2" placeholder="Employment Status" type="text" name="employment_input"  value="<?php echo $user['EMPLOYMENT_INPUT']; ?>"  id="employment_input" style='display:none;' />
							</div>
						</div>

						<hr>

						<div class="form-row">
							<div class="form-group col-md-6">
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
											echo '<input type="hidden" name="previous_in_service" value="'. $doc['DOC_NAME'].'">';
										}
									}
								}  ?>
							</div>
							<div class="form-group col-md-6" >
								<label></label>
								<input class="form-control btn-input form-control-file mt-2" type="file" name="inservice_file"  id="inservice_file" style='display:none;'/>
							</div>
						</div>

						<hr>

						<div class="form-row">
							
							<!-- Physical disability -->
							<div class="form-group col-md-3">
								<label>Physical disability</label>
								<select class="form-control" id="disability" name="disability" placeholder="disability" style="margin-bottom:10px;" onchange='checkValueWithFile(this.value,"disability_input","disability_file")' required>
									<option value="Yes" <?php if ($user['DISABILITY'] == 'Yes') {
															echo 'selected';
														} ?>>Yes</option>
									<option value="No" <?php if ($user['DISABILITY'] == 'No') {
															echo 'selected';
														} ?>>No</option>
								</select>
								<?php if (($user['DISABILITY_INPUT'] !== '') && $user['DISABILITY'] == 'Yes') {
									echo '<input class="form-control btn-input" placeholder="Disability Status" type="text" name="disability_input" id="disability_input" value="' . $user['DISABILITY_INPUT'] . '" style="display:block;" />';
									
								} ?>

							</div>

							<div class="form-group col-md-4 mt-2" />
								<label></label>
								<input class="form-control btn-input" placeholder="Disability Details" type="text" name="disability_input" id="disability_input" style='display:none;' >
							</div>

							<div class="form-group col-md-3" id="disability_file" style='display:none;' />
								<label>Upload Scanned Photo</label>
								<input class="form-control btn-input form-control-file" type="file" name="disability_file"  />
							</div>

							<div class="form-group col-md-3 mt-4">
							<?php
								if (!empty($documents)) {
									foreach ($documents as $doc) {
										if (($doc['DOC_FOLDER'] == 'disability') && $user['DISABILITY'] == "Yes") {
											echo '<a href="' . $doc['DOC_PATH'] . '" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
											echo '<input type="hidden" name="previous_disability" value="'. $doc['DOC_NAME'].'">';
										}
									}
								}
								?>
							</div>
							
						</div>


						<hr>
						<!-- Address Information -->
						<h6 class="form-table-title bg-primary">Address Information</h6>
						<hr>
						<label style="color: #47759e;"><u>Permanent Address</u></label>
						<div class="row">
							<div class="form-group col-4">
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
							<div class="form-group col-4">
								<label for="per_district">District</label>
								<input type="hidden" class="form-control" name="per_district_id_selected" id="per_district_id_selected" value="<?php echo $user['PER_DISTRICT_ID']; ?>">
								<select name="per_district" class="form-control form-control-sm" id="per_district">
									<option value="">---</option>

								</select>
							</div>
							<div class="form-group col-4">
								<label for="per_province">Muicipality/VDC</label>
								<input type="hidden" class="form-control" name="per_vdc_id" id="per_vdc_id_selected" value="<?php echo $user['PER_VDC_ID']; ?>">
								<select name="per_vdc" class="form-control form-control-sm" id="per_vdc">
									<option value="">---</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Ward Number</label>
								<input type="text" class="form-control" name="per_ward_no" value="<?php echo $user['PER_WARD_NO']; ?>">

							</div>
							<div class="form-group col-4">
								<label for="">Tole Name</label>
								<input type="text" class="form-control" name="per_tole" value="<?php echo $user['PER_TOLE']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">House Number</label>
								<input type="text" class="form-control" name="per_house_no" value="<?php echo $user['PER_HOUSE_NO']; ?>" >
							</div>
						</div>
						<label style="color: #47759e;"><u>Mailling Address</u></label>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="">Province</label>
								<!-- <input type="text" class="form-control" name="mail_province_id" value="<?php //echo $user['MAIL_PROVINCE']; 
																											?>"> -->
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
							<div class="form-group col-md-4">
								<label for="">District</label>
								<input type="hidden" class="form-control" name="mail_district_id_selected" id="mail_district_id_selected" value="<?php echo $user['MAIL_DISTRICT_ID']; ?>">
								<select name="mail_district" class="form-control form-control-sm" id="mail_district">
									<option value="">---</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="mail_province">Muicipality/VDC</label>
								<!-- <input type="text" class="form-control" name="mail_vdc_id" value="<?php //echo $user['MAIL_VDC']; 
																										?>"> -->
								<input type="hidden" class="form-control" name="mail_vdc_id" id="mail_vdc_id_selected" value="<?php echo $user['MAIL_VDC_ID']; ?>">
								<select name="mail_vdc" class="form-control form-control-sm" id="mail_vdc">
									<option value="">---</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="">Ward Number</label>
								<input type="text" class="form-control" name="mail_ward_no" value="<?php echo $user['MAIL_WARD_NO']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">Tole Name</label>
								<input type="text" class="form-control" name="mail_tole" value="<?php echo $user['MAIL_TOLE']; ?>">
							</div>
							<div class="form-group col-md-4">
								<label for="">House Number</label>
								<input type="text" class="form-control" name="mail_house_no" value="<?php echo $user['MAIL_HOUSE_NO']; ?>" >
							</div>
						</div>

						<div class="send-button">
							<input type="submit" class="btn btn-primary btn-noc" name="profilupdate" value="Update">
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<script type='text/javascript' src='<?php echo base_url('assets/js/Datepicker/custom.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>'></script>

<script type="text/javascript">
	function checkvalue(val, id_input) {
		if (val === "other") {
			document.getElementById(id_input).style.display = 'block';
			document.getElementById(id_input).required = true;
		} else {
			document.getElementById(id_input).style.display = 'none';
			document.getElementById(id_input).value = '';

		}
	}

	function checkValueWithFile(val, id_input, id_file) {
		if (val === "other" || val == 'Aadibasi/Janajati' || val == 'Dalit' || val == 'Vaishya' || val == 'Madhesi') {
			document.getElementById(id_input).style.display = 'block';
			document.getElementById(id_file).style.display = 'block';
			document.getElementById(id_input).required = true;
			document.getElementById(id_file).required = true;
		} else if (val === "Yes") {
			document.getElementById(id_input).style.display = 'block';
			document.getElementById(id_file).style.display = 'block';
			document.getElementById(id_input).required = true;
			document.getElementById(id_file).required = true;
		} else {
			document.getElementById(id_input).style.display = 'none';
			document.getElementById(id_file).style.display = 'none';
		}
	}


	$('#spouse_name').change(function() {
		if ($('#spouse_name').val().length > 0) {
			$('#spouse_nationality').attr('required', true);
		} else {
			$('#spouse_nationality').attr('required', false);
		}
	});
	app.startEndDatePickerWithNepali('dob_ad', 'dob', 'issue_date_ad', 'issue_date');
</script>

<script src="<?php echo base_url(); ?>assets/js/profile/edit.js"></script>