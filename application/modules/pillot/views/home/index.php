<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<h1>
Pillot Portal
<small></small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pillot Portal</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
	
		<div class="row">
			<div class="col-md-12 col-lg-12">
		  <?php if(isset($_POST['status'])){ ?>
					<div id="file_updated_box">
							<div class="alert <?php echo ($_POST['status']=="success") ? " alert-success " : " alert-danger "; ?> alert-dismissible file_updated">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								<h4><i class="icon fa <?php echo ($_POST['status']=="success") ? " fa-check" : " fa-ban"; ?>"></i> <?php echo $_POST['msg']; ?></h4>
							</div>
					</div>
					
					<?php
					
			}

?>
			</div>
	
		</div>
		<div class="row">

			
			<section class="col-lg-12">
				<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Download Report Manual Screening</h3>
				</div>
					<div class="box-body">
					
					<form id="addform" action="<?php echo base_url(); ?>downloadreport/1" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label>Start Date</label>
								<input type="text" id="startdate" name="startdate" required autocomplete="off"  class="form-control" value="<?=DATE('Y/m/d')?>" />
							</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="text" id="enddate" autocomplete="off" required  name="enddate" class="form-control" value="<?=DATE('Y/m/d')?>" />
						</div>
						<div  class="form-group">
							<input type="submit" class="btn btn-primary " name="portal1"  value="Download">
						</div>
					</div>
					</form>
					</div>
				</div>
			</section>
		</div>
		<div class="row">

			
			<section class="col-lg-12">
				<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Download Report Pervacio App</h3>
				</div>
					<div class="box-body">
					
					<form id="addform" action="<?php echo base_url(); ?>downloadreport/2" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label>Start Date</label>
								<input type="text" id="startdate2" name="startdate" required autocomplete="off"  class="form-control" value="<?=DATE('Y/m/d')?>" />
							</div>
						<div class="form-group">
							<label>End Date</label>
							<input type="text" id="enddate2" autocomplete="off" required  name="enddate" class="form-control" value="<?=DATE('Y/m/d')?>" />
						</div>
						<div  class="form-group">
							<input type="submit" class="btn btn-primary" name="portal2"  value="Download">
						</div>
					</div>
					</form>
					</div>
				</div>
			</section>
		</div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
$(function() {
  $('input[name="startdate"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
	"minDate": "2019/01/01",
	locale: {
            format: 'YYYY/MM/DD'
        }
  });
    $('input[name="enddate"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
	"minDate": "2019/01/01",
	locale: {
		  format: 'YYYY/MM/DD'
        }
  });
    $('input[name="startdate2"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
	"minDate": "2019/01/01",
	locale: {
            format: 'YYYY/MM/DD'
        }
  });
    $('input[name="enddate2"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
	"minDate": "2019/01/01",
	locale: {
		  format: 'YYYY/MM/DD'
        }
  });

});
</script>