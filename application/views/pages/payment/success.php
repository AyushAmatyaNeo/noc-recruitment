<?php

// echo 'Payment Success';
?>

<div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                    <svg class="checkmarks" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                    <h6 class="success-top">Your Payment has been successful!</h6>
                <div class="alert alert-success" role="alert">
                    <label>Application paid amount : Rs. <?php echo $payment_amt ?></label>
                </div>
                <p>Order Id: <?php echo $payment_oid ?></p>
                <p>Reference Id: <?php echo $payment_refid ?></p>
            </div>

        </div>
    </div>
    <p class="lead"><strong>We will review</strong> your application and update your status.</p>
    <hr>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>vacancy" role="button">Continue to Vacancy Page</a>
    </p>
</div>