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
						<form>
							<h6 class="form-table-title">Personal Information</h6>
							<hr>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="">First Name</label>
									<input type="text" class="form-control" value="<?php echo $user['FIRST_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Middle Name</label>
									<input type="text" class="form-control" value="<?php echo $user['MIDDLE_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Last Name</label>
									<input type="text" class="form-control" value="<?php echo $user['LAST_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Religion</label>
									<!-- <input type="text" class="form-control" value="<?php //echo $user['RELIGION']; ?>" readonly> -->
									<?php
										if($user['RELIGION'] == 'others'){
											echo '<input class="form-control" value="'.$user['RELIGION_INPUT'].'" readonly>';
										} else
										{
											echo '<input class="form-control" value="'.$user['RELIGION'].'" readonly>';
										}
									?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="">Ethnicity</label>
									<!-- <input class="form-control" value="<?php //echo $user['ETHNIC_NAME']; ?>" readonly> -->
									<?php
										if($user['ETHNIC_NAME'] == 'others'){
											echo '<input class="form-control" value="'.$user['ETHNIC_INPUT'].'" readonly>';
										} else
										{
											echo '<input class="form-control" value="'.$user['ETHNIC_NAME'].'" readonly>';
										}
									?>
								</div>
								<div class="form-group col-md-3">
									<label for="">Region</label>
									<!-- <input type="email" class="form-control" value="<?php //echo $user['REGION']; ?>" readonly> -->
									<?php
										if($user['REGION'] == 'others'){
											echo '<input class="form-control" value="'.$user['REGION_INPUT'].'" readonly>';
										} else
										{
											echo '<input class="form-control" value="'.$user['REGION'].'" readonly>';
										}
									?>
								</div>

								<div class="form-group col-md-3">
									<label>Mother Tongue</label>
									<input class="form-control" value="<?php echo $user['MOTHER_TONGUE']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label>Date of Birth</label>
									<input class="form-control" value="<?php echo $user['DOB']; ?>" readonly>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="">Mobile Number</label>
									<input type="text" class="form-control" value="<?php echo $user['MOBILE_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Phone Number</label>
									<input type="text" class="form-control" value="<?php echo $user['PHONE_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Email</label>
									<input type="email" class="form-control" value="<?php echo $user['EMAIL_ID']; ?>" readonly>
								</div>
								<div class="form-group col-md-1">
									<label for="">Age</label>
									<input class="form-control" value="<?php echo $user['AGE']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label>Gender</label>
									<input class="form-control" value="<?php echo $user['GENDER_NAME']; ?>" readonly>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">Citizenship Number</label>
									<input type="text" class="form-control" value="<?php echo $user['CITIZENSHIP_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Issue Date</label>
									<input type="text" class="form-control" value="<?php echo $user['CTZ_ISSUE_DATE']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Issue District</label>
									<input type="text" class="form-control" value="<?php echo $user['DISTRICT_NAME']; ?>" readonly>
								</div>
							</div>
							<hr>
							<h6 class="form-table-title">Family Information</h6>
							<hr>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">Father Name</label>
									<input type="text" class="form-control" value="<?php echo $user['FATHER_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Father Qualification</label>
									<input type="text" class="form-control" value="<?php echo $user['FATHER_QUALIFICATION']; ?>" readonly>
								</div>

								<div class="form-group col-md-4">
									<label for="">Father Mother Occupation</label>
									<!-- <input type="text" class="form-control" value="<?php //echo $user['FM_OCCUPATION']; ?>" readonly> -->
									<?php
										if($user['FM_OCCUPATION'] == 'others'){
											echo '<input class="form-control" value="'.$user['FM_OCCUPATION_INPUT'].'" readonly>';
										} else
										{
											echo '<input class="form-control" value="'.$user['FM_OCCUPATION'].'" readonly>';
										}
									?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">Mother Name</label>
									<input type="text" class="form-control" value="<?php echo $user['MOTHER_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Mother Qualification</label>
									<input type="text" class="form-control" value="<?php echo $user['MOTHER_QUALIFICATION']; ?>" readonly>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for=""> Grandfather Name</label>
									<input type="text" class="form-control" value="<?php echo $user['GRANDFATHER_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Grandfather Nationality</label>
									<input type="text" class="form-control" value="<?php echo $user['GRANDFATHER_NATIONALITY']; ?>" readonly>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">Spouse Name</label>
									<input type="text" class="form-control" value="<?php echo $user['SPOUSE_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Spouse Nationality</label>
									<input type="text" class="form-control" value="<?php echo $user['SPOUSE_NATIONALITY']; ?>" readonly>
								</div>
							</div>
							<hr>
							<h6 class="form-table-title">Address Information</h6>
							<hr>
							<label style="color: #47759e;"><u>Permanent Address</u></label>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Provience</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_PROVINCE']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">District</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_DISTRICT']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Muicipality/VDC</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_VDC']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Ward Number</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_WARD_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Tole Name</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_TOLE']; ?>" readonly>
								</div>
							</div>
							<label style="color: #47759e;"><u>Mailling Address</u></label>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Provience</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_PROVINCE']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">District</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_DISTRICT']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Muicipality/VDC</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_VDC']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Ward Number</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_WARD_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-2">
									<label for="">Tole Name</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_TOLE']; ?>" readonly>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>