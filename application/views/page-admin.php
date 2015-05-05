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

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/icomoon-social.css'); ?>">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url('assets/css/leaflet.css'); ?>" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">

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
						<li class="active">
							<a href="<?php echo site_url('home'); ?>">Home</a>
						</li>
						<li class="active">
							<a href="<?php echo site_url('cert'); ?>">Create Certificate</a>
						</li>
						<li>
							<a href="<?php echo site_url('logout'); ?>">Logout</a>
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
						<h1>CSR List</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-12">
	    			    <table class="table table-striped table-condensed">
	    			        <!-- Array ( [C] => ID [ST] => East Java [L] => Surabaya [O] => Raizan Inc [OU] => Web Administration [CN] => www.raizan.com ) -->
	    			        <tr>
	    			            <th>Common Name</th>
	    			            <th>Organization Unit</th>
	    			            <th>Organization</th>
	    			            <th>City</th>
	    			            <th>State</th>
	    			            <th>Country</th>
	    			            <th></th>
	    			        </tr>
	    				<?php 
    	    			    $i = 0;
    	    				foreach($pack as $row)
    	    				{
    	    					echo '<tr>';
    	    					    echo '<td>'.$pack[$i]["dn"]["CN"].'</td>';
    	    					    echo '<td>'.$pack[$i]["dn"]["OU"].'</td>';
    	    					    echo '<td>'.$pack[$i]["dn"]["O"].'</td>';
    	    					    echo '<td>'.$pack[$i]["dn"]["L"].'</td>';
    	    					    echo '<td>'.$pack[$i]["dn"]["ST"].'</td>';
    	    					    echo '<td>'.$pack[$i]["dn"]["C"].'</td>';
    	    					    echo '<td><a href="'.site_url('admin/signcsr').'/'.$pack[$i]["csr_id"].'" class="btn btn-grey btn-sm event-more">Sign</a></td>';
    	    					echo '</tr>';
    	    				}	
    	    				
	    			    ?>
	    				
	    				</table>
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
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery-1.9.1.min.js'); ?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="<?php echo base_url('assets/js/jquery.fitvids.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.sequence-min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.bxslider.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/main-menu.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/template.js') ?>"></script>

    </body>
</html>