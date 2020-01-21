<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);

?>
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
<div class="row">
  
  <div class="col-lg-12 col-xs-12">
    <!-- small box -->
	
	
         <div class="text-center cont">
				<div class="btn">
					<a href="<?php echo base_url(); ?>stopwatch/start-new-process" >
                    
                            <div id="moved-box-can" class="moved-box">Start New Process</div>
                        </a>
				</div>
				<div class="btn">
					<a href="<?php echo base_url(); ?>stopwatch/home" >
                    
                            <div id="moved-box-can" class="moved-box">Continue process</div>
                        </a>
				</div>
   <div class="row">
                   
	</div>

    <!-- Main content -->
    <!-- /.content -->
	
  </div>  
	
	
  <!-- ./col -->
  
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/js/jintervals.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/js/stopwatch.js"></script>


<style>





 .btn {


  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
 margin-top:11%;
 width:20%;

}

</style>

<style>

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
#moved-box-ca:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/canadian.jpg); 
}
#moved-box-can:hover {
     background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/sbelogonew.jpg); 
}

.moved-box:hover {
    border-color: #4E7BD3;
    color: #1a5d98;
    font-weight: bold;
    font-size: 200%;
}

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