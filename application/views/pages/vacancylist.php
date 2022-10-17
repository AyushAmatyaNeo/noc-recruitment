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
				<thead style="font-size: 13px; color: #fff; background-color: #47759E; text-align: center; line-height: 34px;" >
					<tr>
						<th scope="col" rowspan="2" style="width: 3%">S.No.</th>
						<th scope="col" rowspan="2" width="8%">Ad. No.</th>
						<th scope="col" rowspan="2">Post</th>
						<th scope="col" rowspan="2" style="width: 10%">Admit Card</th>
						<th scope="col" rowspan="2" style="width: 5%">Amount</th>
						<th scope="col" colspan="3" width="16%">Payment</th>
						<!-- <th scope="col" rowspan="2">Print Slip</th> -->
						<!-- <th colspan="2">Verification</th> -->
						<th scope="col" rowspan="2" style="width: 9%">Exam Roll No.</th>
						<th scope="col" rowspan="2">Status</th>
					</tr>
				</thead>
				
				<tbody style="font-size: 13px;">

					<?php if (!empty($applications)) { ?>
					
						<?php 

							$counter = 0;
							
							foreach ($applications as $application) 
							{
								$application_id = base64_encode($application['APPLICATION_ID']);
								$counter = $counter + 1; 
						?>
							<tr>
								<td>
									<?php echo $counter ?>
								</td>
								<td>
									<?php echo $application['AD_NO'] ?>
								</td>
								<td>
									<?php echo $application['DESIGNATION_TITLE']; ?> 
									/ Level : 
									<?php echo $application['FUNCTIONAL_LEVEL_EDESC']; ?>
								</td>
								<td>
									<?php 
										
										if ($this->UserModel->checkattributes(
																	'HRIS_REC_VACANCY_APPLICATION', 
																	'stage_id', 
																	'application_id', 
																	$application['APPLICATION_ID'] . '\' 
																	AND STAGE_ID = \'11') == true) 
									  	{ 

									?>
										<a class="btn btn-primary btn-apply" target="_blank" href="<?php echo base_url('vacancy/vacancyhtmlAdmit/') . $application_id; ?>" role="button">Download</a> 
									
									<?php 

										} elseif ($application['PAYMENT_PAID'] == 'Y') {

											 echo '<span class="text-center">Admit Card Will Be Issueing Soon</span>'; 

										} else {

											 echo '<span class="text-center">You will get Admit card after you pay</span>'; 

										}

									?>
								</td>
								<td><?php echo $application['APPLICATION_AMOUNT']; ?></td>

								<?php if (($application['PAYMENT_PAID'] == 'Y') AND ($application['PAYMENT_VERIFIED'] == 'Y')) { ?>
										
										<td colspan="3"><h5 class="text-center">Paid</h5></td>

								<?php } elseif (($application['PAYMENT_PAID'] == 'Y') AND ($application['PAYMENT_VERIFIED'] == 'N')) { ?>

										<td colspan="3"><p class="text-center"><strong>Payment Made but yet to verify</strong></p></td>

								<?php } else {

									foreach ($payment_gateways as $payment_gateway) {
											
										echo "<td>";
											echo "<a id=".strtolower($payment_gateway['GATEWAY_COMPANY']).$application['APPLICATION_ID']." class='payment_img_sec' name="."payment_id_".$payment_gateway['ID']." vacancy=".base64_encode($application['VACANCY_ID'])." application=".base64_encode($application['APPLICATION_ID'])." payment=".base64_encode($payment_gateway['ID'])." recruitment_post=".$application['DESIGNATION_TITLE']." recruitment_post_level=".$application['FUNCTIONAL_LEVEL_EDESC'].">";
												echo "<img src=".base_url('assets/images/').$payment_gateway['GATEWAY_LOGO']." alt=".$payment_gateway['GATEWAY_COMPANY']." class='payment_submit' />";
											echo "</a>";
										echo "</td>";


									}
								?>

									<!-- Esewa Payment Form Starts -->
									<form action="<?php echo $this->config->item('esewa_url'); ?>" id="esewaDataSubmit<?php echo $application['APPLICATION_ID'];?>" method="POST">

										<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="tAmt" type="hidden">
										<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="amt" type="hidden">
										<input value="0" name="txAmt" type="hidden">
										<input value="0" name="psc" type="hidden">
										<input value="0" name="pdc" type="hidden">
										<input value="<?php echo $this->config->item('esewa_merchant_id'); ?>" name="scd" type="hidden">
										<input value="<?php echo $esewa['invoice'] . 'aid' . $application['APPLICATION_ID'] . 'vid' . $application['VACANCY_ID']; ?>" name="pid" type="hidden">
										<input value="<?php echo $this->config->item('esewa_success_page_url'); ?>" type="hidden" name="su">
										<input value="<?php echo $this->config->item('esewa_fail_page_url'); ?>" type="hidden" name="fu">
										
									</form>
									<!-- Esewa Payment Form Ends -->
									<input type="hidden" name="base" id="baseurl" value="<?php echo base_url(); ?>" /> 


									<!-- ConnectIPS Starts -->
									<span>

										<!-- ConnectIPS Payment Form Starts -->
										<form action="<?php echo $this->config->item('connectips_url');?>" id="ipsDataSubmit<?php echo $application['APPLICATION_ID'];?>" method="post">

											<!-- <input type="hidden" name="applicationIdPay" id="applicationIdPay" value=""> -->
											<!-- <input type="hidden" name="MERCHANTID" id="MERCHANTID" value="<?php echo $connectips['merchant_id']; ?>"/>
											<input type="hidden" name="APPID" id="APPID" value="<?php echo $connectips['app_id']; ?>"/>
											<input type="hidden" name="APPNAME" id="APPNAME" value="<?php echo $connectips['app_name']; ?>"/>
											<input type="hidden" name="TXNID" id="TXNID<?php echo $application['APPLICATION_ID'];?>" value="<?php echo $connectips['txn_id']; ?>"/> 
											<input type="hidden" name="TXNDATE" id="TXNDATE" value="<?php echo $connectips['txn_date']; ?>"/>
											<input type="hidden" name="TXNCRNCY" id="TXNCRNCY" value="<?php echo $connectips['txn_cur']; ?>"/>
											<input type="hidden" name="TXNAMT" id="TXNAMT" value="<?php echo $connectips['txn_amt'] = $application['APPLICATION_AMOUNT'];?>"/>
											<input type="hidden" name="REFERENCEID" id="REFERENCEID" value="<?php echo $connectips['referenceId']; ?>"/>
											<input type="hidden" name="REMARKS" id="REMARKS" value="<?php echo $connectips['remarks']; ?>"/>
											<input type="hidden" name="PARTICULARS" id="PARTICULARS" value="<?php echo $connectips['particulars']; ?>"/>
											<input type="hidden" name="TOKEN" id="TOKEN<?php echo $application['APPLICATION_ID']; ?>" value="<?php echo connectipsHashGenerator($connectips); ?>"/> -->

											<input type="hidden" name="MERCHANTID" id="MERCHANTID<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="APPID" id="APPID<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="APPNAME" id="APPNAME<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="TXNID" id="TXNID<?php echo $application['APPLICATION_ID'];?>" value=""/> 
											<input type="hidden" name="TXNDATE" id="TXNDATE<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="TXNCRNCY" id="TXNCRNCY<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="TXNAMT" id="TXNAMT<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="REFERENCEID" id="REFERENCEID<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="REMARKS" id="REMARKS<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="PARTICULARS" id="PARTICULARS<?php echo $application['APPLICATION_ID']; ?>" value=""/>
											<input type="hidden" name="TOKEN" id="TOKEN<?php echo $application['APPLICATION_ID']; ?>" value=""/>
										</form>
										<!-- ConnectIPS Payment Form Ends -->

									</span>
									<span  class="getConnectIPSPostData<?php echo $application['APPLICATION_ID']; ?>" style="display: none;">
										<?php echo base64_encode(json_encode(array_merge($connectips, ['created_datetime' => $this->config->item('connectips_txn_date_for_system')])));?>
									</span>
									<!-- ConnectIPS Starts -->

								<?php } ?>
										
									
								</td>

								<td><?php echo $application['ROLL_NO']; ?></td>
								<td><?php 

										echo $application['STAGE_EDESC'];
										
										if (!empty($application['REMARKS'])) 
										{
											echo '</br> Remarks: ' . $application['REMARKS'];
										}
									?>
								</td>
							</tr>
						<?php } ?>

					<?php 
						} else {
							
							echo "<tr><td colspan='13'> You have not applied to any vacancies. </td></tr>";
						} 
					?>

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
				<thead style="font-size: 13px; color: #fff; background-color: #47759e; text-align: center; line-height: 34px;">
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

	$(document).ready(function() {

	  	$('.payment_submit').on('click', function() {

	  		var getPaymentNameWithAppId   = $(this).parent('a').prop('id');

	  		var getPaymentNameWithId = $('#' + getPaymentNameWithAppId).attr('name');


	  		// GET APPLICATION ID
	  		// var getApplicationId = getPaymentNameWithAppId.match(/\d/g);
	  		var getApplicationId = $('#' + getPaymentNameWithAppId).attr('application');



	  		// GET VACANCY ID 
	  		var getVacancyId = $('#' + getPaymentNameWithAppId).attr('vacancy');

			// GET PAYMENT ID	  		
	  		var getPaymentId = $('#' + getPaymentNameWithAppId).attr('payment');

	  		// GET RECRUITMENT POST	  		
	  		var recruitmentPost = $('#' + getPaymentNameWithAppId).attr('recruitment_post');

	  		// GET RECRUITMENT LEVEL	  		
	  		var recruitmentPostLevel = $('#' + getPaymentNameWithAppId).attr('recruitment_post_level');

	  		// GET PAYMENT GATEWAY
	  		var getPaymentName = getPaymentNameWithAppId.substr(0, getPaymentNameWithAppId.length - Number(atob(getPaymentId).toString().length));

	  		// AVAILABLE PAYMENT
	  		// var availablePayment = ['esewa', 'khalti', 'connectips'];

	  		var baseurl = $('#baseurl').val();

	  		// CHECKING PAYMENT GATEWAY TO PROCEED

	  		// if (availablePayment.includes(getPaymentName)) {


	  		if (getPaymentName == 'esewa')
	  		{	

	  			$('#esewaDataSubmit'+atob(getApplicationId)).submit();

	  		// } else if (getPaymentName == 'connectips') {

	  		// 	$('#ipsDataSubmit'+atob(getApplicationId)).submit();

	  		
	  		} else {

	  			$.ajax({
				type: "POST",
				url: baseurl + "vacancy/paymentProcess/",
				crossDomain: true,
				// dataType: 'jsonp',
				data: {
						application_id : getApplicationId,
						vacancy_id : getVacancyId,
						payment_gateway: getPaymentNameWithAppId,
						payment_gateway_id: getPaymentId,
						recruitmentPost: recruitmentPost,
						recruitmentPostLevel: recruitmentPostLevel,
					},
				success: function (response) {

						if (getPaymentName == 'connectips') {

							// alert(response);

							const obj = JSON.parse(response);
							$('#MERCHANTID'+atob(getApplicationId)).val(obj.merchant_id);
							$('#APPID'+atob(getApplicationId)).val(obj.app_id);
							$('#APPNAME'+atob(getApplicationId)).val(obj.app_name);
							$('#TXNID'+atob(getApplicationId)).val(obj.txn_id);
							$('#TXNDATE'+atob(getApplicationId)).val(obj.txn_date);
							$('#TXNCRNCY'+atob(getApplicationId)).val(obj.txn_currency);
							$('#TXNAMT'+atob(getApplicationId)).val(obj.txn_amount);
							$('#REFERENCEID'+atob(getApplicationId)).val(obj.reference_id);
							$('#REMARKS'+atob(getApplicationId)).val(obj.remarks);
							$('#PARTICULARS'+atob(getApplicationId)).val(obj.particulars);
							$('#TOKEN'+atob(getApplicationId)).val(obj.token);
							$('#ipsDataSubmit'+atob(getApplicationId)).submit();

						} else {

							if (response == '') 
							{
								window.location.replace(baseurl +  "vacancy/vacancylist");					
							} 

							window.location.replace(response);

						}

						

						// if (response == '') 
						// {
						// 	window.location.replace(baseurl +  "vacancy/payment");					
						// } 

						// window.location.replace(response);

						// window.location
						// window.location.replace(response);
						// $('#ipsDataSubmit').submit();
					}
				});


	  		} 





	  	});
	});


	$(document).ready(function() {

	  	$('.connectips_submit').on('click', function() {


		    var token    = $(this).prev('input').prop('id');

		    var getToken = $('#' + token).val();

		    var applicationId = token.replace('TOKEN', '');

		    var getStoredConnectIPSID = 'getConnectIPSPostData' + applicationId;

		    var getTransactionIDName = 'TXNID' + applicationId;

		    var getConnectIPSData    = $('.' + getStoredConnectIPSID).html();
		    var getTransactionIDData = $('#' + getTransactionIDName).val();

		    var baseurl = $('#baseurl').val();

     		$.ajax({
				type: "POST",
				url: baseurl + "vacancy/saveTempPayment/",
				data: {
						application_id : applicationId,
						details: getConnectIPSData,
						token: getToken,
						txnID: getTransactionIDData

					},
			success: function (response) {

				// const obj = JSON.parse(response);
				// $('#MERCHANTID').val(obj.m_id);
				// $('#APPID').val(obj.a_id);
				// $('#TXNID').val(obj.txn);
				// $('#TXNDATE').val(obj.txda);
				// $('#TXNCRNCY').val(obj.txc);
				// $('#TXNAMT').val(obj.txa);
				// $('#REFERENCEID').val(obj.ref);
				// $('#REMARKS').val(obj.remarks);
				// $('#PARTICULARS').val(obj.par);
				// $('#TOKEN').val(obj.token);
				$('#ipsDataSubmit').submit();
				}
			});
		});

	});

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
						alert(response);

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