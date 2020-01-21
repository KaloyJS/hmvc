<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<h1>
Shipment Management
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Shipment Management</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
	
		<div class="row">
			<div class="col-md-12 col-lg-12">
		  <?php if(isset($_POST['status'])){ ?>
					<div id="file_updated_shipment">
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

			<section class="col-lg-3 col-md-3">
				<div class="box box-info">
				
					<div class="box-body">
					
					   <?php  echo  $this->session->flashdata('error'); 
					   // print_r($shipment);
					   $shipment = $shipment[0];
					   // Array ( [0] => Array ( [UPLOADEDBY] => SAURABH SHARMA [SHIPMENT_ID] => 2 [TRACKING_NUMBER] => sfvcea33 [SHIPPED_FROM] => wfs [RECEIVED_BY] => wfwsa [TRACKING_FILE_PATH] => C:/xampp/htdocs/razer/uploads/shipment/All-Process-All-All-All-All-All-General_documents(2).pdf [TRACKING_FILE_NAME] => All-Process-All-All-All-All-All-General_documents(2).pdf [UPLOADED_BY] => 106434 [UPLOAD_DATE] => 16-AUG-19 11.40.59.000000 AM [UPLOADON] => 2019/08/16 ) )
					   
					   $newpath =	explode('razer',$shipment['TRACKING_FILE_PATH']);
					   ?>
					<form id="addprojectform" action="<?php echo base_url();?>updateshipment/<?=$shipment['SHIPMENT_ID']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							
								<div  class="form-group">
									<label for="username">Tracking Number</label>
									<input type="text" class="form-control"  name="tracking_number" required value="<?=$shipment['TRACKING_NUMBER']?>" id="project"/>
								</div>
								<div  class="form-group">
									<label for="username">Shipped From</label>
								<textarea class="form-control" name="shipped_from" required rows="3" required><?=$shipment['SHIPPED_FROM']?></textarea>
								</div>
								<div  class="form-group">
									<label for="username">Packing Slip(pdf)</label>
									<input type="file" accept=".pdf,.PDF" class="form-control" name="packing_slip" size="50" />
									
								</div>
								<div  class="form-group">
								<label for="username">Received By</label>
								<textarea class="form-control" name="received_by" required rows="3" required><?=$shipment['SHIPPED_FROM']?></textarea>
								</div>
								<div  class="form-group">
								<label for="username">View Old File</label><br/>
								<?php echo "<a onclick=\"viewdoc('".$newpath[1]."')\" class='btn btn-primary'> Show File</a>";
									?>
									
								</div>
							
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addshipment" value="Update">
							
							</div>
							</div>
						
							</div>
					</form>
					
					
		
					
					
					
				
					</div>
				</div>
			</section>
			
		</div>
		<div id="showfile" title="">

		</div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

function viewdoc(path){
	$( "#showfile" ).dialog( "open" );	
	$("#showfile").html("<iframe src='<?=base_url();?>assets/viewerjs/ViewerJS/#<?=base_url();?>"+path+"' width='100%' height='100%'  style='border: none;' allowfullscreen ></iframe>");
	
}
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

});
</script>