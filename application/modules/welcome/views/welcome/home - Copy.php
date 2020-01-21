
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="myApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="myApp" class="no-js"> <!--<![endif]-->
    <base href="/artemis/" />
    <head>
        <title>SBE - Portals</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/bootstrap-slider/slider.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/iCheck/all.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/iCheck/flat/blue.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/select2/dist/css/select2.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- Modals style -->
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

<!-- General UI style -->
  <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: center;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette-box h4 {
      position: absolute;
      top: 100%;
      left: 25px;
      margin-top: -40px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>

<!-- Icon UI style -->
  <style>
    /* FROM HTTP://WWW.GETBOOTSTRAP.COM
     * Glyphicons
     *
     * Special styles for displaying the icons and their classes in the docs.
     */

    .bs-glyphicons {
      padding-left: 0;
      padding-bottom: 1px;
      margin-bottom: 20px;
      list-style: none;
      overflow: hidden;
    }

    .bs-glyphicons li {
      float: left;
      width: 25%;
      height: 115px;
      padding: 10px;
      margin: 0 -1px -1px 0;
      font-size: 12px;
      line-height: 1.4;
      text-align: center;
      border: 1px solid #ddd;
    }

    .bs-glyphicons .glyphicon {
      margin-top: 5px;
      margin-bottom: 10px;
      font-size: 24px;
    }

    .bs-glyphicons .glyphicon-class {
      display: block;
      text-align: center;
      word-wrap: break-word; /* Help out IE10+ with class names */
    }

    .bs-glyphicons li:hover {
      background-color: rgba(86, 61, 124, .1);
    }

    @media (min-width: 768px) {
      .bs-glyphicons li {
        width: 12.5%;
      }
    }
#moved-box-uk:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(/artemis/uk.jpg); 
}
#moved-box-can:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/canadian.jpg); 
}
#moved-box-rogers:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/rogers.png); 
}
#moved-box-parts:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/parts_apple.jpg); 
}
#moved-box-bell:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/bell.jpg); 
}
#moved-box-source:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/source.png); 
}
#moved-box-razer:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/razer.png); 
}
#moved-box-pilot:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/pilot.jpg); 
}
#moved-box-opale:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/opale.png); 
}
#moved-box-tech:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/tech.png); 
}
#moved-box-quality:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/quality.png); 
}
#moved-box-train:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/train.jpg); 
}
#moved-box-presentation:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/presentation.jpg); 
}
#moved-box-vacation:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/calen.jpg); 
}
/*.moved-box:hover {
    border-color: #4E7BD3;
    font-size: 400%;
    font-weight: bold; 
    color: #427AC0;
}*/
.moved-box:hover {
    border-color: #4E7BD3;
    color: #000;
    font-weight: bold;
    font-size: 200%;
}
/*.moved-box {
    position: relative;
    height: 160px;
    line-height: 160px;
    background-color: #E0E0E0;
    background-image: none;
    color: #787878;
    text-align: center;
    font-size: 250%;
    border-radius: 6px;
    border: 2px solid #999;
    transition: .2s;
    background-size: 100% 100%;
    background-position: 100%;
    background-repeat: no-repeat;
    margin: 10px 20px;
} */
.moved-box {
    position: relative;
    height: 160px;
    line-height: 160px;
    background-color: #4f7ba2;
    background-image: none;
    color: #fff;
    text-align: center;
    font-size: 250%;
    border-radius: 6px;
    border: 2px solid #999;
    transition: .2s;
    background-size: 100% 100%;
    background-position: 100%;
    background-repeat: no-repeat;
    margin: 10px 20px;
}
  </style>

  </head>
    <body class="home-page card  square scrollbar-deep-purple square thin">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container ">
            <div class="header" ng-controller="IndexCtrl">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/SBE-logo.png" alt="SBE Logo" style="margin-top: 20px; margin-bottom: 20px; width:288px;">
                        <h3 class="text-muted pull-right">SBE Portals | <span style="color:red;">We have moved...</span></h3>
                    </div>
                </div>
                <hr>
            </div> <!-- header -->

            <!-- angular view -->
            <div ng-view>

                <div class="row">
                    <div class="col-sm-12">
                        <h1>We split up for portals</h1>
                    </div>
                    <div class="clear"></div>
                </div>
                 <!--<div class="card example-1 square scrollbar-deep-purple square thin">
      <div class="card-body"> -->


                <div class="row">
                    <div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>bellreturns" target="_blank">
                    
                            <div id="moved-box-bell" class="moved-box">Bell Returns</div>
                        </a>
                    </div>
					 <div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>bell4r" target="_blank">
                    
                            <div id="moved-box-bell" class="moved-box">Bell 4 R</div>
                        </a>
                    </div>
					 <div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>rogers" target="_blank">
                    
                            <div id="moved-box-rogers" class="moved-box">Rogers</div>
                        </a>
                    </div>
					 <div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>parts" target="_blank">
                    
                            <div id="moved-box-parts" class="moved-box">Parts</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>site_96" target="_blank">
                    <div id="moved-box-can" class="moved-box">Site 96</div>
                        </a>
                    </div>
                    <div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_source" target="_blank">
                    <div id="moved-box-source" class="moved-box">Source</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo base_url(); ?>home" target="_blank">
                    <div id="moved-box-razer" class="moved-box">Sbe Razer</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo base_url(); ?>pillot" target="_blank">
                    <div id="moved-box-pilot" class="moved-box">Sbe Pilot</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>hrm" target="_blank">
                    <div id="moved-box-can" class="moved-box">HRM</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>Integrated_Repair_Portals_V2" target="_blank">
                    <div id="moved-box-can" class="moved-box">Repair Portals</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>BrightStar" target="_blank">
                    <div id="moved-box-can" class="moved-box">BrightStar</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_cust_care" target="_blank">
                    <div id="moved-box-can" class="moved-box">SBE Cust Care</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_Opale" target="_blank">
                    <div id="moved-box-opale" class="moved-box">SBE Opale</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_quality" target="_blank">
                    <div id="moved-box-quality" class="moved-box">SBE Quality</div>
                        </a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_technical" target="_blank">
                    <div id="moved-box-tech" class="moved-box">SBE Technical</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_tradein" target="_blank">
                    <div id="moved-box-can" class="moved-box">SBE Tradein</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>SBE_KPI" target="_blank">
                    <div id="moved-box-can" class="moved-box">SBE KPI</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>SBE_invoice" target="_blank">
                    <div id="moved-box-can" class="moved-box">SBE Invoice</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>PMP" target="_blank">
                    <div id="moved-box-can" class="moved-box">SBE PMP</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_training" target="_blank">
                    <div id="moved-box-train" class="moved-box">SBE Training</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_presentations" target="_blank">
                    <div id="moved-box-presentation" class="moved-box">Presentation</div>
					</a>
                    </div>
					<div class="col-sm-3">
					<a href="<?php echo BASEURL; ?>sbe_calendar" target="_blank">
                    <div id="moved-box-vacation" class="moved-box">SBE Vacation</div>
					</a>
                    </div>
                    <div class="clear"></div>
                </div>
     <!-- </div> -->
    </div>
                <div class="row">
                    <div class="col-sm-12">
                     
                    </div>

                  

                    <div class="clear"></div>
                </div>
            
            </div>

            <div class="row" style="margin-top:80px;">
                <div class="col-sm-12" style="font-size:95%;text-align:center;color:#F00;">
                   <?php
				   // echo something'';
				   ?>
                </div>
            </div>

            <div style="height:20px;"></div>

            <footer class="col-md-12 well">
                <div class="text-center">
                    <p class="text-muted">
						Copyright &copy; 2015 - <?=date('Y')?> <a href="http://sbeglobalservice.com/" target="_blank">SBE Canada</a> | <a href="">Support</a>
                    </p>
					
                </div>
            </footer>

        </div> <!-- container -->


    </body>
</html>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<!--
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
 -->


<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">

<!-- JQuery -->
<!--
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<!--
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
-->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
<STYLE>
.scrollbar-deep-purple::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #F5F5F5;
border-radius: 10px; }

.scrollbar-deep-purple::-webkit-scrollbar {
width: 12px;
background-color: #F5F5F5; }

.scrollbar-deep-purple::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #512da8; }



.bordered-deep-purple::-webkit-scrollbar-track {
-webkit-box-shadow: none;
border: 1px solid #512da8; }

.bordered-deep-purple::-webkit-scrollbar-thumb {
-webkit-box-shadow: none; }


.square::-webkit-scrollbar-thumb {
border-radius: 0 !important; }

.thin::-webkit-scrollbar {
width: 6px; }

.example-1 {
position: relative;
overflow-y: scroll;
overflow-x: hidden;
height: 560px; }

.home-page {

    background: url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/bg2.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height:auto !important;
 
}
</STYLE>