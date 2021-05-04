<main class="main-success-page bg-light">
	<section class="sec-success-page sec-padd">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="d-flex">
						<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
							<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
							<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
						</svg>
						<h6 class="success-top">Your application has been submitted successfully!</h6>
					</div>

					<form class="card p-5">
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Advertisement No.</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['AD_NO']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Registration No. </label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['AD_NO'] . '-' . $details[0]['APPLICATION_ID'] ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Registration Date</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['CREATED_DATE']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Post</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['DESIGNATION_TITLE']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Level</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['FUNCTIONAL_LEVEL_EDESC']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-5 col-form-label">Service/Group</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control" value="<?php echo $details[0]['SERVICE_TYPE_NAME']; ?>">
							</div>
						</div>
					</form>
					<div class="alert alert-info" role="alert">
					<label>Please proceed for Payment : Amount <?php echo $amount ?></label>
						<form action="<?php echo $redirect ?>" method="POST">
							<input value="<?php echo $amount ?>" name="tAmt" type="hidden">
							<input value="<?php echo $amount ?>" name="amt" type="hidden">
							<input value="0" name="txAmt" type="hidden">
							<input value="0" name="psc" type="hidden">
							<input value="0" name="pdc" type="hidden">
							<input value="<?php echo $merchant_id ?>" name="scd" type="hidden">
							<input value="<?php echo $invoice ?>" name="pid" type="hidden">
							<input value="<?php echo $returnURl ?>" type="hidden" name="su">
							<input value="<?php echo $cancelURL ?>" type="hidden" name="fu">
							<input class="btn btn-primary" value="Pay with Esewa" type="submit">
						</form>
					</div>
				</div>
				<div class="success-bottom">
					<p>Thank you for applying. Go to<a href="<?php echo base_url(); ?>vacancy"> Vacancy Page</a></p>
				</div>

			</div>
		</div>
		</div>
	</section>
</main>