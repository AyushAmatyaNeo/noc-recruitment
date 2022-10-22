<style>

@import url('https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap');
							
/*body {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-family: "Mukta",sans-serif;
}*/


</style>

<main class="main-user-profile bg-light">
	<section class="user-profile-sec sec-padd">
		<div class="container">
			<div class="col-lg-12">
				<div class="card">
					<div class="left-form p-5">
						<div class="status-msg success" style="padding-bottom: 10px;"><?php echo $this->session->flashdata('success_msg'); ?></div>
						<div class="d-flex" style="justify-content: space-between;align-items: baseline;">
							<h5 class="main-title"><i class="fa fa-user pr-2" aria-hidden="true"></i>Welcome <?php echo $user['FIRST_NAME']; ?>!</h5>

							<div>
								<a href="<?php echo base_url('vacancy/vacancylist') ?>" class="btn btn-noc text-light">
									<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
									<small>Back to Vacancy List</small>
								</a>

								<a href="<?php echo base_url('profile/edit') ?>" class="btn btn-success">
									<i class="fa fa-pencil-square-o pr-1" aria-hidden="true"></i>
									<small>Edit Profile</small>
								</a>
							</div>

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
							<h6 class="form-table-title bg-primary text-light">Personal Information</h6>
							<hr>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">First Name</label>
									<input type="text" class="form-control" value="<?php echo $user['FIRST_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Middle Name</label>
									<input type="text" class="form-control" value="<?php echo $user['MIDDLE_NAME']; ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label for="">Last Name</label>
									<input type="text" class="form-control" value="<?php echo $user['LAST_NAME']; ?>" readonly>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-3">
									<label>Date of Birth</label>
									<input class="form-control" value="<?php echo $user['DOB']; ?>" readonly>
								</div>

								<div class="form-group col-md-3">
									<label for="">Age</label>
									<input class="form-control" value="<?php echo $user['AGE']; ?>" readonly>
								</div>

								<div class="form-group col-md-3">
									<label>Gender</label>
									<input class="form-control" value="<?php echo $user['GENDER_NAME']; ?>" readonly>
								</div>

								<div class="form-group col-md-3">
									<label>Marital Status</label>
									<input class="form-control" value="<?php echo $user['MARITAL_STATUS']; ?>" readonly>
								</div>

								
							</div>

							<hr>
							<h6 class="form-table-title bg-primary text-light">Contact Information</h6>
							<hr>

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
							</div>

							<hr>
							<h6 class="form-table-title bg-primary text-light">Citizenship Information</h6>
							<hr>

							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="">Citizenship Number</label>
									<input type="text" class="form-control" value="<?php echo $user['CITIZENSHIP_NO']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Issue Date</label>
									<input type="text" class="form-control" value="<?php echo $user['CTZ_ISSUE_DATE']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Issue District</label>
									<input type="text" class="form-control" value="<?php echo $user['DISTRICT_NAME']; ?>" readonly>
								</div>
							</div>

							<hr>
							<h6 class="form-table-title bg-primary text-light">Family Information</h6>
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
							<h6 class="form-table-title bg-primary text-light">Extra Information</h6>
							<hr>

							<div class="form-row">
								<div class="form-group col-md-4">
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
								
								<div class="form-group col-md-4">
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
								<div class="form-group col-md-4">
									<label for="">Inclusion</label>									
									<?php
										if($user['ETHNIC_NAME'] == 'others'){
											echo '<input class="form-control" value="'.$user['ETHNIC_INPUT'].'" readonly>';
										} else
										{
											echo '<input class="form-control" value="'.$user['ETHNIC_NAME'].'" readonly>';
										}
										if(!empty($documents)){
											foreach($documents as $doc){
												if($doc['DOC_FOLDER'] == 'ethnicity'){
													echo '<a href="'. $doc['DOC_PATH'].'" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
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
									<input class="form-control" value="<?php echo $user['MOTHER_TONGUE']; ?>" readonly>
								</div>
								<div class="form-group col-md-3">
									<label for="">Blood Group</label>
									<input type="text" class="form-control" value="<?php echo $user['BLOOD_GROUP']; ?>" readonly>
								</div>
								
							</div>
							<div class="form-row">

								<div class="form-group col-md-4">
									<label>Employment status</label>
									<input class="form-control" value="<?php echo $user['EMPLOYMENT_STATUS']; ?>" readonly>
								</div>
								
								<div class="form-group col-md-3">
									<label for="">Are you NOC Employee?</label>
									<input type="text" class="form-control" value="<?php echo $user['IN_SERVICE']; ?>" readonly>
									<?php if(!empty($documents)){
											foreach($documents as $doc){
												if(($doc['DOC_FOLDER'] == 'in_service') && ($user['IN_SERVICE'] == 'YES')){
													echo '<a href="'. $doc['DOC_PATH'].'" target= "_blank" class="btn btn-primary" style="margin:10px">View File</a>';
												}
											}
										}  ?>
								</div>
							</div>	

							<div class="form-row">
								<div class="form-group col-md-3">
									<label>Physical disability</label>
									<input class="form-control" value="<?php echo $user['DISABILITY']; ?>" readonly> 
									<?php 
									if(!empty($documents)){
										foreach($documents as $doc){
											if(($doc['DOC_FOLDER'] == 'disability') && $user['DISABILITY'] == "Yes"){
												echo '<a href="'. $doc['DOC_PATH'].'" target= "_blank" class="btn btn-primary" id="disability_view" style="margin:10px">View File</a>';
											}
										}
									}
									?>
								</div>
							</div>						
							
							<hr>
							<h6 class="form-table-title bg-primary text-light">Address Information</h6>
							<hr>
							<label style="color: #47759e;"><u>Permanent Address</u></label>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Province </label>
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
								<div class="form-group col-md-2">
									<label for="">House Number</label>
									<input type="text" class="form-control" value="<?php echo $user['PER_HOUSE_NO']; ?>" readonly>
								</div>
							</div>
							<label style="color: #47759e;"><u>Mailling Address</u></label>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Province</label>
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
								<div class="form-group col-md-2">
									<label for="">House Number</label>
									<input type="text" class="form-control" value="<?php echo $user['MAIL_HOUSE_NO']; ?>" readonly>
								</div>
							</div>
						</form>


					</div>
				</div>

				<div class="vacancy-btn mt-4 text-center">
					<a href="<?php echo base_url('vacancy/vacancylist') ?>" class="btn btn-noc text-light">Back To Vacancy List </a>
				</div>
			</div>
		</div>
	</section>
</main>

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
</script>