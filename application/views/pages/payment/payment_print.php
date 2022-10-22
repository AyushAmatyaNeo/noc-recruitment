<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
/*body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}*/

.btn-ul {
    margin: 0 auto;
    list-style: none;
}
.btn-ul li {
    display: inline-block;
    padding: 0 8px;
}

.btn-ul li a i {
    padding-right: 6px;
}
</style>


<div id="myDiv">

    <div style="width: 100%; margin: 0 auto; padding: 30px;">

        <div style="margin-top:20px;">
            <div style="text-align: center;">
                <img src="<?php echo base_url('assets/images/CompanyLogoHeader.png'); ?>">
            </div>
        </div>

        <br>
        <br>
        <div style="margin-top:20px;">
            <div style="text-align: center;">
                <img src="<?php echo base_url('assets/images/checked.png'); ?>" style="width: 10%;">
                <h5 style="margin-top:20px; font-size: 16px; color:#333;">Thank you for your payment. Please Verify your details.</h5>
            </div>
        </div>

        <br>
        <br>
        <table style="width:45%; margin: 0 auto;">
            <tr style="background-color: #fff; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Name</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #f3f8fa; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Total Amount</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #fff; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Payment Type</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #f3f8fa; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Payment Unique ID</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #fff; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Reference ID</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #f3f8fa; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Reference Code</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #fff; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Name</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
            <tr style="background-color: #f3f8fa; height: 50px; border: 1px solid #333;">
                <td style="padding: 10px 18px">Payment Date</td>
                <td style="padding: 10px 18px">Text</td>
            </tr>
        </table>
    </div>
</div>






<div class="row mt-4">
    <ul class="btn-ul">
        <li>
            <div>
                <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0"  onclick="PrintDiv('myDiv')"><i class="fa fa-cloud-download" aria-hidden="true"></i>Download PDF</a>
            </div>
        </li>

         <li>
            <div>
                <a href="#" class="btn btn-secondary btn-bold px-4 float-right mt-3 mt-lg-0">Go To HomePage</a>
            </div>
        </li>
    </ul>
    
</div>


<script type="text/javascript">
    function PrintDiv(id) {
        var data=document.getElementById(id).innerHTML;

        var myWindow = window.open('', 'my div', 'height=400,width=600');
        myWindow.document.write('<body>');
        /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        // myWindow.document.write('</head><body >');
        myWindow.document.write(data);
        myWindow.document.write('</body>s');
        myWindow.document.close(); // necessary for IE >= 10

        myWindow.onload=function(){ // necessary if the div contain images

            myWindow.focus(); // necessary for IE >= 10
            myWindow.print();
            myWindow.close();
        };
    }
</script>