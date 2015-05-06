<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>OwnCA - <?php echo $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/icomoon-social.css') ?>">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url('assets/css/leaflet.css') ?>" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		
		 <!-- Javascripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery-1.9.1.min.js') ?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="https://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="<?php echo base_url('assets/js/jquery.fitvids.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.sequence-min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.bxslider.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/main-menu.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/template.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

                <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">
		        <nav id="mainmenu" class="mainmenu">
					<ul >
						<!--<li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt=""></a></li>-->
						<li <?php if($url=='home') echo 'class="active"'?> >
							<a href="<?php echo site_url('home'); ?>">Home</a>
						</li>
						<li <?php if($url=='home/submitCsr') echo 'class="active"'?> >
							<a href="<?php echo site_url('home/submitCsr'); ?>">Request Signed Certificate </a>
						</li>
						<li <?php if($url=='home/listUserCsr') echo 'class="active"'?> >
							<a href="<?php echo site_url('home/listUserCsr'); ?>">CSR List </a>
						</li>
						<li <?php if($url=='home/listUserCert') echo 'class="active"'?> >
							<a href="<?php echo site_url('home/listUserCert'); ?>">Certificate List </a>
						</li>
                        <li <?php if($url=='logout') echo 'class="active"'?> >
							<a href="<?php echo site_url('logout'); ?>">Logout</a>
						</li>
						<li <?php if($url=='download') echo 'class="active"'?> >
								<a href="<?php echo site_url('ca'); ?>">Download CA Cert</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>