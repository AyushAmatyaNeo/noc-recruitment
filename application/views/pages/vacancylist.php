<style>
.jBox-title{
	background: #fe1901  !important;
	color: azure;
}
</style>
<main class="main-vacancies bg-light">
	<section class="applied-vacancies-sec">
		<div class="container-fluid">
			<?php
			// Reset Password Notification message!
			if ($this->session->flashdata('msg')) {
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
						<th colspan="3">Pay</th>
						<th scope="col" rowspan="2">Print Slip</th>
						<th colspan="2">Verification</th>
						<th scope="col" rowspan="2" style="width: 7%">Exam Roll No.</th>
						<th scope="col" rowspan="2">Status</th>
					</tr>
					<tr>
						<th>FonePay</th>
						<th>Esewa</th>
						<th>connectIPS</th>
						<th>Form</th>
						<th>Payment</th>
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
									<?php if ($this->UserModel->checkattributes('hris_rec_application_payment', 'status','application_id',$application['APPLICATION_ID'] ) == true) { ?>
									<a class="btn btn-primary btn-apply" target="_blank" href="<?php echo base_url('vacancy/admitcard/') . $application_id; ?>" role="button">Download</a>
									<?php } else{
										echo '<p class="btn btn-primary btn-apply admitCard" role="button">Download</p>';
									} ?>
								</td>
								<td>1</td>
								<td>
								<form action="<?php echo $esewa['redirect'] ?>" method="POST">
								<?php echo $application['APPLICATION_AMOUNT'] ?>&nbsp;
									<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="tAmt" type="hidden">
									<input value="<?php echo $application['APPLICATION_AMOUNT'] ?>" name="amt" type="hidden">
									<input value="0" name="txAmt" type="hidden">
									<input value="0" name="psc" type="hidden">
									<input value="0" name="pdc" type="hidden">
									<input value="<?php echo $esewa['merchant_id'] ?>" name="scd" type="hidden">
									<input value="<?php echo $esewa['invoice'].'aid'.$application['APPLICATION_ID'].'vid'.$application['VACANCY_ID'] ?>" name="pid" type="hidden">
									<input value="<?php echo $esewa['returnURl'] ?>" type="hidden" name="su">
									<input value="<?php echo $esewa['cancelURL'] ?>" type="hidden" name="fu">
									<?php if ($this->UserModel->checkattributes('hris_rec_application_payment', 'status','application_id',$application['APPLICATION_ID'] ) == false) { ?>
									<input class="btn btn-success" value="Pay with Esewa" type="submit">
									<?php  }else{
										echo '<p id="amount">Paid</p>';
									} ?>
								</form>									
								</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
								<td><?php echo $applications[0]['STAGE_NAME'] ?></td>
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
						<th scope="col" style="width: 2%">S.No.</th>
						<th scope="col" style="width: 5%">Ad Number</th>
						<th scope="col" style="width: 13%">Designation / Level</th>
						<th scope="col" style="width: 10%">Service / Group</th>						
						<th scope="col" style="width: 5%">Inclusive</th>
						<th scope="col" style="width: 5%">Total No.</th>
						<th scope="col" style="width: 25%">Description</th>
						<th scope="col" style="width: 5%;">Stage</th>
						<th scope="col" style="width: 5%">File</th>
						<th scope="col" style="width: 10%">Apply</th>
					</tr>
				</thead>
				<tbody style="font-size: 13px;">
					<?php
					$counter = 0;
					if (!empty($vacancylists)) {
						// echo '<pre>'; print_r($row); die;
						foreach ($vacancylists as $vacancylist) {
							// $counter = $counter + 1;
							$now     = Date('Y-m-d');  ?>
							<tr>
								<?php if ($vacancylist['EXTENDED_DATE'] >= $now) {
									$vacancy_id = base64_encode($vacancylist['VACANCY_ID']);
									$counter = $counter + 1; ?>
									<td><?php echo $counter ?></td>
									<td><?php echo $vacancylist['AD_NO']; ?></td>
									<td><?php echo $vacancylist['DESIGNATION_TITLE']; ?> / Level : <?php echo $vacancylist['FUNCTIONAL_LEVEL_EDESC']; ?> </td>
									<td><?php echo $vacancylist['SERVICE_TYPE_NAME']; ?> / <?php echo $vacancylist['SERVICE_EVENT_NAME']; ?> </td>									
									<td><?php echo $vacancylist['OPTION_EDESC']; ?></td>
									<td><?php echo $vacancylist['QUOTA_OPEN'] ?></td>
									<?php if(strlen($vacancylist['VACANCY_EDESC']) > 60) {
										echo '<td>'. (substr($vacancylist['VACANCY_EDESC'], 0, 62)).'....</td>';
									}else{
    									echo '<td>'. $vacancylist['VACANCY_EDESC']. '</td>';
									}?>									
									<?php //foreach($stages as $stage) { 
									?>
									<td><?php echo $vacancylist['STAGE_EDESC']; ?></td>
									<?php //} 
									?>
									<td style="text-align: center"><?php if ($vacancylist['FILE_NAME']) { ?><a target="_blank" href="<?php echo base_url() . '../hana-noc/neo-hris/public/uploads/noc_documents/' . $vacancylist['FILE_IN_DIR_NAME']; ?>">
										<i class="fa fa-file" style="font-size: 25px"></i>&nbsp;</a>
									<?php  } ?></td>
									<?php if ($this->VacancyModel->checkapplied($vacancylist['VACANCY_ID'], $this->session->userdata('userId')) == false) {
										
										echo '<td><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/apply/") . $vacancy_id . '" role="button">Apply</a>    <a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
									} else {
										echo '<td><a class="btn btn-primary btn-apply" href="' . base_url("vacancy/edit/") . $vacancy_id . '" role="button">Edit</a>    <a class="btn btn-primary btn-apply" href="' . base_url("vacancy/vacancydetail/") . $vacancy_id . '" role="button">View</a></td>';
									} ?>
							</tr>
				<?php }
							}
						} else {
							echo "<tr><td colspan='13'> No vacancy at this time! </td></tr>";
						} ?>
				</tbody>
			</table>
		</div>
	</section>
</main>

<script src="<?php echo base_url(); ?>assets/js/jbox/index.js"></script>