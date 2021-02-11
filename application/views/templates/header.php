<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
	<link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/gif" sizes="32x32">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script href="<?=base_url();?>js/vendor/modernizr-2.6.2.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?=base_url();?>assets/css/main.css" rel="stylesheet">
	<script src="<?php echo base_url();?>js/modernizr.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?render=6Lcf41EaAAAAAKaeYIHJ6Z25c6xBNUS7dqgHtt5A"></script>
</head>
<body>  
<header class="site-header" style="height:95px; background-color: #47759E; border: none;">
    	<nav class="navbar navbar-expand cstm-navbar" style="height:95px;">
	        <div class="container-fluid">
	            <a class="navbar-brand" href="#"><img src="<?php echo base_url() ?>assets/images/CompanyLogoHeader.png" class="img-fluid"></a>
	            <div class="collapse navbar-collapse">
	                <ul class="navbar-nav ml-auto">
					<?php 
						if(!$this->session->userdata('userId'))
						{
							// Do Nothing
						} else {
					?>
	                    <li class="nav-item active" style="text-align: right;">
	                        <span>
		                    	<a href="<?php echo base_url('users/logout'); ?>" style="color: #fff;"><i class="fa fa-user" aria-hidden="true" style="padding-right: 10px"></i>Logout</a>
		                    	<span id="spanSeparator" style="font-size: 15px;color: #BAE0EE;"> | </span>  
		                    </span>
		                    <span id="spanUserRegistration">
		                    	<a href="<?php echo base_url('profile/view'); ?>" style="color: #fff;"> Account</a>
		                    </span>
		                    <div style="padding-top:0px;color:#BAE0EE;"><small>Welcome! Signed in as <?php echo $user['FIRST_NAME']; ?></small></div>
	                    </li>                 
					<?php } ?>
	                </ul>
	            </div>

	        </div>
	    </nav>
    </header>