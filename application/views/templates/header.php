<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $meta['title']; ?></title>
	<link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/gif" sizes="32x32">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<?= link_tag("assets/css/bootstrap.min.css"); ?>
	<?= link_tag("https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css") ?>

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<script href="<?= base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?= base_url(); ?>assets/css/main.css" rel="stylesheet">
	<!-- <link href="<?php //echo base_url(); ?>assets/css/nepali.datepicker.v3.5.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php //echo base_url(); ?>assets/js/nepali.datepicker.v3.5.min.js" type="text/javascript"></script> -->
	<link href="<?php echo base_url(); ?>assets/global/nepalidate/nepali.datepicker.v2.1.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/transactionFailed.css" rel="stylesheet" />
	<!-- Vendor -->
	<link href="<?php echo base_url('/assets/global/bootstrap-toastr/toastr.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/css/jbox/jBox.all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://www.google.com/recaptcha/api.js?render=6Lcf41EaAAAAAKaeYIHJ6Z25c6xBNUS7dqgHtt5A"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>	
	<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.validate.min.js'); ?>'></script>
	<script type='text/javascript' src='<?php echo base_url('assets/js/register.js'); ?>'></script>
	<script src="<?php echo base_url(); ?>assets/global/nepalidate/nepali.datepicker.v2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>	
	
</head>

<body>
	<header class="site-header" style="height:125px; background-color: #47759E; border: none;">
		<nav class="navbar navbar-expand cstm-navbar" style="height:95px;">
	        <div class="container-fluid">
	            <a class="navbar-brand" href="<?php echo base_url('vacancy');; ?>">
					<img src="<?php echo base_url() ?>assets/images/CompanyLogoHeader.png" style="height: 85px;" class="img-fluid">
				</a>
	            <div class="collapse navbar-collapse">
	                <ul class="navbar-nav ml-auto">
						<?php
						if (!$this->session->userdata('userId')) {
							// Do Nothing
						} else {
						?>
						<li class="nav-item active flag" style="text-align: right;">
	                        <span>
		                    	<a href="<?php echo base_url('users/logout'); ?>" style="color: #fff;"><i class="fa fa-user" aria-hidden="true" style="padding-right: 10px"></i>Logout</a>
		                    	<span id="spanSeparator" style="font-size: 15px;color: #BAE0EE;"> | </span>  
		                    </span>
		                    <span id="spanUserRegistration">
		                    	<a href="<?php echo base_url('profile/view'); ?>" style="color: #fff;"> Account</a>
		                    </span>
		                    <div style="padding-top:0px;color:#BAE0EE;"><small>Welcome! Signed in as <?php echo $user['USERNAME']; ?></small></div>
	                    </li>
						<li class="nav-item flag"><img style="height: 40px;" src="<?php echo base_url(); ?>assets/images/nepaliflag.gif"></li>
					<?php } ?>
	                </ul>
	            </div>

	        </div>
	    </nav>
		<?php
		if (!$this->session->userdata('userId')) {
			// Do Nothing
		} else { ?>
		<nav role="navigation" id="secondary-nav" class="dont-show-on-phone">
	    	<ul id="main-menu" class="sm sm-blue" style="z-index: 2;margin-top: -10px" data-smartmenus-id="16133656154335908">
			<li><a href="<?php echo base_url('users/registration')  ?>" class="nav-link">Registration</a></li>
	    		<li><a href="<?php echo base_url('vacancy/vacancylist') ?>" class="nav-link">Vacancy List</a></li>
	    		<li><a href="<?php echo base_url('profile/view') ?>" class="nav-link">My Profile</a></li>
	    		<li><a href="<?php echo base_url('users/updatepassword') ?>" class="nav-link">Password Change</a></li>
	    		<li>
	    			<a href="" class="nav-link">New release</a>
	    		</li>
	    	</ul>
	    </nav>
		<?php } ?>
	</header>