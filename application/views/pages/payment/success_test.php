<div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                    <svg class="checkmarks" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                    <h6 class="success-top">Your Payment has been successfully paid!</h6>
                <div class="alert alert-success" role="alert">
                    <label>Application paid amount : Rs. <?php echo (isset($payment_amount)) ? $payment_amount : ''; ?></label>
                </div>
                <p>Order Id: <?php echo (isset($payment_transaction_id)) ? $payment_transaction_id  : '' ; ?></p>
                <p>Reference Id: <?php echo (isset($payment_reference_id)) ? $payment_reference_id : '' ; ?></p>
            </div>

        </div>
    </div>
    <p class="lead"><strong>We will review</strong> your application and update your status.</p>
    <hr>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>vacancy" role="button">Continue to Vacancy Page</a>
    </p>
    <p class="lead">        
        <a href="<?php echo base_url('vacancy/paymentDownloadTest') ?>">Print this page</a>
    </p>
</div>

<!-- 
http://erecruitment.nepaloil.org.np/vacancy/payment_success?q=su&oid=ztiSaOj1rfHKJG25aid2vid1&amt=600.0&refId=0002J2P

http://localhost/noc-recruitment/vacancy/payment_success?q=su&oid=7UDGhfaKgd0s2BpSaid6vid4&amt=2500.0&refId=0002J2R -->