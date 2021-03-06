<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>OwnCA - Create your own Certificate</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/icomoon-social.cs') ?>s">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url('assets/css/leaflet.css')?>" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">

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
					<ul>
						<!--<li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt=""></a></li>-->
						<li>
							<a href="<?php echo site_url('home') ?>">Home</a>
						</li>
						<li class="active">
							<a href="<?php echo site_url('login'); ?>">Login</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Register</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" method="post" action="<?php echo site_url('register/create') ?>" >
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Username</b></label>
									<input class="form-control" name="username" id="username" type="text" placeholder="">
								</div>
								<div class="form-group">
		        				 	<label for="register-password"><i class="icon-lock"></i> <b>Password</b></label>
									<input class="form-control" name="password" id="password" type="password" placeholder="">
								</div>
								<div class="form-group">
		        				 	<label for="register-password2"><i class="icon-lock"></i> <b>Re-enter Password</b></label>
									<input class="form-control" name="confirmation" id="password2" type="password" placeholder="">
								</div>
								<div class="form-group">
									<button type="submit" class="btn pull-right">Register</button>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-6 col-sm-offset-1 social-login">
						<div class="not-member">
							<p>Already have an account? <a href="<? echo site_url('login'); ?>">Login now!</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2015 OwnCA Beta</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery-1.9.1.min.js') ?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="<?php echo base_url('assets/js/jquery.fitvids.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.sequence-min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.bxslider.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/main-menu.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/template.js') ?>"></script>

    </body>
</html>