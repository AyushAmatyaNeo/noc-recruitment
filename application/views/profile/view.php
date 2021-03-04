<main class="main-user-profile bg-light">
		<section class="user-profile-sec sec-padd">
			<div class="container">
				<div class="col-lg-6 offset-lg-3">
					<div class="card">
						<div class="left-form p-5">
							<div class="d-flex" style="justify-content: space-between;align-items: baseline;">
								<h5 class="main-title"><i class="fa fa-user pr-2" aria-hidden="true"></i>Welcome <?php echo $user['FIRST_NAME']; ?>!</h5>
								<a href="<?php echo base_url('profile/edit') ?>"><i class="fa fa-pencil-square-o pr-1" aria-hidden="true"></i><small>Edit Profile</small></a>
							</div>
							
							<form>
								<div class="form-group">
									<label for="">Full Name</label>
									<input type="text" class="form-control" id="" aria-describedby="" value="<?php echo $user['SR_NO'].' '.$user['FIRST_NAME'].' '.$user['MIDDLE_NAME'].' '.$user['LAST_NAME']; ?>" readonly>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="">Mobile Number</label>
										<input type="number" class="form-control" id="" aria-describedby="" value="<?php echo $user['MOBILE_NO']; ?>" readonly>
									</div>
									<div class="form-group col-md-6">
										<label for="">Gender</label>
										 <select id="" class="form-control">
									        <option selected><?php echo $user['GENDER_NAME']; ?></option>
									    </select>
									</div>
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="email" class="form-control" id="" aria-describedby="" value="<?php echo $user['EMAIL_ID']; ?>">
								</div>
							</form>
						</div>
					</div>
				</div>		
			</div>
		</section>
	</main>