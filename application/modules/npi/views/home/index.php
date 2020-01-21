<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<link href="https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap" rel="stylesheet">
<style type="text/css">
  body, html {
      height: 100%;
  }



  /* The hero image */
  .content {

      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("<?php echo base_url(); ?>assets/frontend/images/BG12.jpg");
    height: 700px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    }

  .hero-text {
    text-align: right;
    position: absolute;
    top: 50%;
    left: 80%;
    transform: translate(-50%, -50%);
    color: white;
  }

  .hero-h1 {
    font-family: 'Lexend Deca', sans-serif;
    font-size: 60px;
  } 

  

</style>


<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Npi Portal</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="hero-image">
        <div class="hero-text">
          <h1 class="hero-h1">Welcome to NPI Portal</h1>                   
        </div>
      </div>	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

</script>