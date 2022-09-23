<style>
	.jBox-title {
		background: #fe1901 !important;
		color: azure;
	}
</style>
<main class="main-vacancies bg-light">
	<section class="applied-vacancies-sec">
		<div class="container-fluid">
			<?php
			// Reset Password Notification message!
			if (($this->session->flashdata('msg') || $this->session->flashdata('error_msg'))) {
			?>
				<div class="status-msg success" style="text-align: center;"><?php echo $this->session->flashdata('msg'); ?></div>
				<div class="status-msg error" style="text-align: center;"><?php echo $this->session->flashdata('error_msg'); ?></div>

			<?php } ?>
			<h5 class="main-title">Applied Vacancies</h5>
			<table class="table table-striped table-bordered table-sm table-responsive-lg tbl-applied-vacancies">
				<thead style="font-size: 13px; color: #fff; background-color: #47759E; text-align: center;">
					<tr>
						<th scope="col" rowspan="2" style="width: 3%">S.No.</th>
						<th scope="col" rowspan="2">Ad. No.</th>
						<th scope="col" rowspan="2">Post</th>
						<th scope="col" rowspan="2" style="width: 10%">Admit Card</th>
						<th scope="col">Pay</th>
						<!-- <th scope="col" rowspan="2">Print Slip</th> -->
						<!-- <th colspan="2">Verification</th> -->
						<th scope="col" rowspan="2" style="width: 7%">Exam Roll No.</th>
						<th scope="col" rowspan="2">Status</th>
					</tr>
				</thead>
				<tbody style="font-size: 13px;">
					<?php if (!empty($applications)) {
						?>
					
						<?php $counter = 0;
						foreach ($applications as $application) {
							$application_id = base64_encode($application['APPLICATION_ID']);
							$counter = $counter + 1; ?>
							<tr>
								<td><?php echo $counter ?></td>
								<td><?php echo $application['AD_NO'] ?></td>
								<td><?php echo $application['DESIGNATION_TITLE']; ?> / Level : <?php echo $application['FUNCTIONAL_LEVEL_EDESC']; ?> </td>
								<td>
								<?php 
									if ($this->UserModel->checkattributes('HRIS_REC_VACANCY_APPLICATION', 'stage_id', 'application_id', $application['APPLICATION_ID'] . '\'  AND STAGE_ID = \'11') == true) 
									  { 
								?>
									<a class="btn btn-primary btn-apply" target="_blank" href="<?php echo base_url('vacancy/vacancyhtmlAdmit/') . $application_id; ?>" role="button">Download</a> 
								<?php } else {

										echo 'You will get Admit card after you pay';

								} ?>
								</td>
								<td>

										<!--Payment Modal -->
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Select Payment Method</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<select class="form-control paymentModalSelect" name="paymentMOdal" required>
													<option value="" disabled selected>Select Payment Method</option>
													<option value="esewa">eSewa</option>
													<option value="ips">Connect IPS</option>
												</select>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
											</div>
										</div>
									</div>

								<form action="<?php echo $esewa['redirect'] ?>" id="esewaDataSubmit" method="POST">
									<?php echo $application['APPLICATION_AMOUNT'] ?>&nbsp;
									<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="tAmt" type="hidden">
									<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="amt" type="hidden">
									<input value="0" name="txAmt" type="hidden">
									<input value="0" name="psc" type="hidden">
									<input value="0" name="pdc" type="hidden">
									<input value="<?php echo $esewa['merchant_id'] ?>" name="scd" type="hidden">
									<input value="<?php echo $esewa['invoice'] . 'aid' . $application['APPLICATION_ID'] . 'vid' . $application['VACANCY_ID'] ?>" name="pid" type="hidden">
									<input value="<?php echo $esewa['returnURl'] ?>" type="hidden" name="su">
									<input value="<?php echo $esewa['cancelURL'] ?>" type="hidden" name="fu">
									<?php if ($this->UserModel->checkattributes('hris_rec_application_payment', 'status', 'application_id', $application['APPLICATION_ID']) == false) { ?>
									
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
											PAY
										</button>
									<?php  } else {
										echo '<p id="amount">Paid</p>';
									} ?>
								</form>
								<input type="hidden" name="base" id="baseurl" value="<?php echo base_url(); ?>" />
										
								<form action="https://uat.connectips.com:7443/connectipswebgw/loginpage" id="ipsDataSubmit" method="post">
									<input type="hidden" name="applicationIdPay" id="applicationIdPay" value="<?php echo $application['APPLICATION_ID'] ?>">
									<input type="hidden" name="MERCHANTID" id="MERCHANTID" value=""/>
									<input type="hidden" name="APPID" id="APPID" value=""/>
									<input type="hidden" name="APPNAME" id="APPNAME" value="NOC Recruitment"/>
									<input type="hidden" name="TXNID" id="TXNID" value=""/> 
									<input type="hidden" name="TXNDATE" id="TXNDATE" value=""/>
									<input type="hidden" name="TXNCRNCY" id="TXNCRNCY" value=""/>
									<input type="hidden" name="TXNAMT" id="TXNAMT" value=""/>
									<input type="hidden" name="REFERENCEID" id="REFERENCEID" value=""/>
									<input type="hidden" name="REMARKS" id="REMARKS" value=""/>
									<input type="hidden" name="PARTICULARS" id="PARTICULARS" value=""/>
									<input type="hidden" name="TOKEN" id="TOKEN" value=""/>
								</form>
								</td>
								<!-- <td>4</td> -->
								<!-- <td>5</td> -->
								<!-- <td>6</td> -->
								<td><?php echo $application['ROLL_NO']; ?></td>
								<td><?php echo $application['STAGE_EDESC'];
									if (!empty($application['REMARKS'])) {
										echo '</br> Remarks: ' . $application['REMARKS'];
									}
									?></td>
							</tr>
						<?php } ?>
					<?php } else {
						echo "<tr><td colspan='13'> You have not applied to any vacancies. </td></tr>";
					} ?>

				</tbody>
			</table>
		</div>
	</section>
	<hr>
	
	<!-- Active Vacancies -->
	<section class="vacancies-sec">
		<div class="container-fluid">
			<h5 class="main-title">Active Vacancies</h5>
			<table class="table table-striped table-bordered table-sm table-responsive-md tbl-vacancies">
				<thead style="font-size: 13px; color: #fff; background-color: #f90501; text-align: center;">
					<tr>
						<th scope="col" style="width: 5%">S.No.</th>
						<th scope="col" style="width: 15%">Ad Number</th>
						<th scope="col" style="width: 15%">Designation / Level</th>
						<th scope="col" style="width: 15%">Service / Group</th>
						<th scope="col" style="width: 15%">Inclusive</th>
						<th scope="col" style="width: 5%">Total No.</th>
						<th scope="col" style="width: 15%;">Stage</th>
						<th scope="col" style="width: 5%">File</th>
						<th scope="col" style="width: 15%">Apply</th>
					</tr>
				</thead>
				<tbody style="font-size: 13px;">
				<!-- <h1>here it comes</h1> -->

				<?php 
					$counter = 0;
					$user_age = $this->VacancyModel->checkAge($this->session->userdata('userId'));
					$date = date('Y-m-d');
					if (!empty($vacancylists)) {
						
						foreach ($vacancylists as $vacancylist) {
							// var_dump($date); die;
							
								$maxage = $this->VacancyModel->Check('HRIS_REC_VACANCY_LEVELS', 'MAX_AGE', 'POSITION_ID', $vacancylist['DESIGNATION_ID']);
								$vacancy_id = base64_encode($vacancylist['VACANCY_ID']);
								$a = $maxage['MAX_AGE'] - $user_age['AGE'];
							
								$counter = $counter + 1; ?>
							 	<tr>
								<td><?php echo $counter ?></td>
								<td><?php echo $vacancylist['AD_NO']; ?></td>
								<td><?php echo $vacancylist['DESIGNATION_TITLE']; ?> / Level : <?php echo $vacancylist['FUNCTIONAL_LEVEL_EDESC']; ?> </td>
								<td><?php echo $vacancylist['SERVICE_TYPE_NAME']; ?> / <?php echo $vacancylist['SERVICE_EVENT_NAME']; ?> </td>
								<td><?php echo $vacancylist['INCLUSION_ID']; ?></td>
								<td><?php echo $vacancylist['VACANCY_RESERVATION_NO']; ?></td>
								<td><?php echo $vacancylist['STAGE_EDESC']; ?></td>
								<td style="text-align: center"><?php if ($vacancylist['FILE_NAME']) { ?><a target="_blank" href="<?php echo base_url() . '../hana-noc/neo-hris/public/uploads/noc_documents/' . $vacancylist['FILE_IN_DIR_NAME']; ?>"> <i class="fa fa-file" style="font-size: 25px"></i>&nbsp;</a> <?php  } ?></td>
								<?php if ($this->VacancyModel->checkapplied($vacancylist['VACANCY_ID'], $this->session->userdata('userId')) == false) {
									
									if ($user_age['AGE'] < 41) {
										echo '<td><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/apply/") . $vacancy_id . '" role="button">Apply</a>   
											<a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
									} else if (($register[0]['IN_SERVICE'] == 'Y') || ($register[0]['GENDER_ID'] == '2') || ($register[0]['DISABILITY'] == 'Yes')) {
										if (($this->VacancyModel->checkAge($this->session->userdata('userId'))['AGE'] <= 40) || ($register[0]['IN_SERVICE'] == 'Y')) {
											echo '<td><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/apply/") . $vacancy_id . '" role="button">Apply</a>    <a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
										} else {
											echo '<td><a class="btn btn-primary btn-apply age_apply" role="button">Apply</a><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
										}
									} else {
										echo '<td><a class="btn btn-primary btn-apply age_apply" role="button">Apply</a><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
									}
								} else {
									echo '<td><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/edit/") . $vacancy_id . '" role="button">Edit</a><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
								} ?>
							 </tr>
					<?php  
						}
					}
				?>
				</tbody>
			</table>
		</div>
	</section>
</main>

<script src="<?php echo base_url(); ?>assets/js/jbox/index.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("select.paymentModalSelect").change(function(){
			var selected = $(".paymentModalSelect option:selected").val();
			if (selected == "esewa") {
				
				$('#esewaDataSubmit').submit();

			} else {
				
        		var baseurl = $('#baseurl').val();
				var application = $('#applicationIdPay').val();

         		 $.ajax({
					type: "POST",
					url: baseurl + "vacancy/saveTempPayment/",

					// "merchantId":mId,
						// "appId":aId,
						// "appName" : appName,
						// "txnId" : txnId,
						// "txnDate" : txnDate,
						// "txnCur" : txnCur,
						// "amt" : amt,
						// "referenceId" : referenceId,
						// "remarks" : remarks,
						// "par" : par,
						// "token" : token,
					data: {
						id : application
					},
					success: function (response) {
						const obj = JSON.parse(response);
						$('#MERCHANTID').val(obj.m_id);
						$('#APPID').val(obj.a_id);
						$('#TXNID').val(obj.txn);
						$('#TXNDATE').val(obj.txda);
						$('#TXNCRNCY').val(obj.txc);
						$('#TXNAMT').val(obj.txa);
						$('#REFERENCEID').val(obj.ref);
						$('#REMARKS').val(obj.remarks);
						$('#PARTICULARS').val(obj.par);
						$('#TOKEN').val(obj.token);
						$('#ipsDataSubmit').submit();
						}
					});

				
			}
		});
	});
</script>