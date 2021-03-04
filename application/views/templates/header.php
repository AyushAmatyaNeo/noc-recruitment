<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $meta['title']; ?></title>
	<link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/gif" sizes="32x32">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/neo-hris/public/assets/font-awesome/font-awesome.css">
	<script href="<?=base_url();?>js/vendor/modernizr-2.6.2.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?=base_url();?>assets/css/main.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="<?php echo base_url();?>assets/js/custom.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?render=6Lcf41EaAAAAAKaeYIHJ6Z25c6xBNUS7dqgHtt5A"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>  
<header class="site-header" style="height:95px; background-color: #47759E; border: none;">
    	<nav class="navbar navbar-expand cstm-navbar" style="height:95px;">
	        <div class="container-fluid">
	            <a class="navbar-brand" href="<?php echo base_url('vacancy');; ?>">
					<img src="<?php echo base_url() ?>assets/images/CompanyLogoHeader.png" style="height: 85px;" class="img-fluid">
				</a>
	            <div class="collapse navbar-collapse">
	                <ul class="navbar-nav ml-auto">
					<?php 
						if(!$this->session->userdata('userId'))
						{
							// Do Nothing
						} else {
					?>
	                    <li class="nav-item active flag" style="text-align: right;">
	                        <span>
		                    	<a href="<?php echo base_url('vacancy/logout'); ?>" style="color: #fff;"><i class="fa fa-user" aria-hidden="true" style="padding-right: 10px"></i>Logout</a>
		                    	<span id="spanSeparator" style="font-size: 15px;color: #BAE0EE;"> | </span>  
		                    </span>
		                    <span id="spanUserRegistration">
		                    	<a href="<?php echo base_url('profile/view'); ?>" style="color: #fff;"> Account</a>
		                    </span>
		                    <div style="padding-top:0px;color:#BAE0EE;"><small>Welcome! Signed in as <?php echo $user['FIRST_NAME']; ?></small></div>
	                    </li>
						<li class="nav-item flag"><img style="height: 40px;" src="http://noc.org.np/assets/nepal-6b8bf2767178f672c8c586f2c6bb5cfc.gif"></li>
					<?php } ?>
	                </ul>
	            </div>

	        </div>
	    </nav>
    </header>