<style>
	.jBox-title {
		background: #fe1901 !important;
		color: azure;
	}
</style>
<main class="main-vacancies bg-light">
	<section class="applied-vacancies-sec">
		<div class="container-fluid">
            <input type="hidden" name="MERCHANTID" id="MERCHANTID" value="<?php echo $m_id ?>"/>
            <input type="hidden" name="APPID" id="APPID" value="<?php echo $a_id ?>"/>
            <input type="hidden" name="REFERENCEID" id="REFERENCEID" value="<?php echo $ref ?>"/>
            <input type="hidden" name="amt" id="amt" value="<?php echo $amt ?>"/>
            <input type="hidden" name="TOKEN" id="TOKEN" value="<?php echo $token ?>"/>
            <input type="hidden" name="base" id="baseurl" value="<?php echo base_url(); ?>" />
        </div>
    </section>
</main>

<script type="text/javascript">
    // $(document).ready(function () {
    //     var mid = $('#MERCHANTID').val();
    //     var aid = $('#APPID').val();
    //     var referenceId = $('#REFERENCEID').val();
    //     var amt = $('#amt').val();
    //     var baseurl = $('#baseurl').val();
    //       $.ajax({
    //          type: "POST",
    //          url: baseurl + "vacancy/tokenGenerator/",
    //          data: {
    //              "merchantId":mid,
    //              "appId":aid,
    //              "referenceId" : referenceId,
    //              "txnAmt": amt,
    //          },
    //          success: function (response) {
    //              console.log(response);
    //              var username = 'MER-498-APP-1';
    //             var password = 'Abcd@123';  

    //                $.ajax({
    //                    type: "POST",
    //                    url: "https://uat.connectips.com:7443/connectipswebws/api/creditor/validatetxn",
    //                    headers: {
    //                             "Authorization": "Basic " + btoa(username + ":" + password)
    //                         },
    //                 data: {
    //                     "merchantId":mid,
    //                     "appId":aid,
    //                     "referenceId" : referenceId,
    //                     "txnAmt": amt,
    //                     "token": response,
    //                 },
    //                 success: function (message) {
    //                     console.log(message);
    //                 }
    //             }); 
    //          }
    //      }); 
       
    //     }); 

</script>
  