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
        <script>
        $(document).ready(function () {
            $("input#submit").click(function(){
                $.ajax({
                    type: "POST",
                    url: "process.php", // 
                    data: $('form.contact').serialize(),
                    success: function(msg){
                        $("#thanks").html(msg)
                        $("#form-content").modal('hide');   
                    },
                    error: function(){
                        alert("failure");
                    }
                });
            });
        });
    </script>
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
                            <a href="<?php echo site_url('home'); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('home/createCert'); ?>">Create Certificate</a>
                        </li>
                        <li class="has-submenu active" >
                            <a href="#">Manage</a>
                            <div class="mainmenu-submenu">
                                <div class="mainmenu-submenu-inner"> 
                                    <div>
                                        <ul>
                                            <li><a href="">Certificates Status</a></li>
                                            <li><a href="">Manage Certificates</a></li>
                                            <li><a href="#">Accout (Currently Unavailable)</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /mainmenu-submenu-inner -->
                            </div><!-- /mainmenu-submenu -->
                        </li>
                        <li>
                            <a href="<?php echo site_url('logout'); ?>">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!--Page Content-->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="">
                        <? php 
                        echo '<table class="events-list">';
                        $counter = 1;
                        foreach($pack as $row)
                        {
                            echo '<tr>';
                            echo '<td><div class="event-date"> <div class="event-day">'.$counter.'</div></div></td>';
                            echo '<td>SSL Certificate for'.$pack[$i]["serial_number"].'</td>';
                            //Download Certificate
                            echo '<td><a href="'.site_url('').'" class="btn btn-grey btn-sm event-more">Download Certificate</a></td>';
                            //Revoke Certificate
                            echo '<div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-grey btn-sm event-more">Revoke Certificate</a></p></div>'
                            echo '</tr>';
                            $counter++;
                        }   
                        echo "</table>"; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Revoke Modal-->
        <div class="container">
            <div id="form-content" class="modal hide fade in" style="display: none;">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Revoke Certificate</h3>
                </div>
                <div class="modal-body">
                    <form class="contact" name="contact">
                        <label class="label" for="reason">Enter Your Reason</label><br>
                        <textarea name="reason" class="input-xlarge"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-danger" type="submit" value="Revoke!" id="submit">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
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