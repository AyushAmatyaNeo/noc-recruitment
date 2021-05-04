<?php

?>
   <div class="online_payment_container" id="himalayanBankonline">
    <div class="payment_header">
        <div class="related_autorized_payee">
            <img src="<?php echo base_url(); ?>assets/images/esewa.png" width=100>
        </div>
    </div>
    <div class="payment_body">
        <p>Total Amount: <span>Nrs. <?php echo $amount;?></span></p>
        <?php
        
        ?>
        
        <form action = "<?php echo $redirect?>" method="POST">
		<input value="<?php echo $amount?>" name="tAmt" type="hidden">
		<input value="<?php echo $amount?>" name="amt" type="hidden">
		<input value="0" name="txAmt" type="hidden">
		<input value="0" name="psc" type="hidden">
		<input value="0" name="pdc" type="hidden">
		<input value="<?php echo $merchant_id?>" name="scd" type="hidden">
		<input value="<?php echo $invoice?>" name="pid" type="hidden">
		<input value="<?php echo $returnURl?>" type="hidden" name="su">
		<input value="<?php echo $cancelURL?>" type="hidden" name="fu">
		<input value="Submit" type="submit">
		</form>
         </div>
    <a href="<?php echo base_url();?>vacancy"><i class="fa-arrow"></i> Back to previous page</a>
</div>
