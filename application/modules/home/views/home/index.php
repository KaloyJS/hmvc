<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);
 // [totaldisplays] => 403
    // [totalbattery] => 187
    // [totalmainboard] => 865
    // [totalcover] => 963
    // [totalaccessory] => 995
    // [totalmainparts] => 2418
    // [otherparts] => 12019
    // [palletformainparts] => 20.15
    // [palletforaccessories] => 2.21
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
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $ttlpalletcount = $palletdata['palletformainparts']+$palletdata['palletforaccessories']+$manual_pallet;
		// check_store_pallet_count($ttlpalletcount);
		?></h3>
        <p>Pallet Count</p>
      </div>
      <div class="icon">
        <i class="fa fa-database"></i>
      </div>
      <a href="<?=base_url();?>stocksinfo" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?=$parts?></h3>
        <p>Parts Quantity less than 5</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="<?=base_url();?>partsinfo" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?=$hrs?></h3>
        <p>Hours Spent</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
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
