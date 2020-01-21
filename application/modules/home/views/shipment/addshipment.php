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
					
					   <?php  echo  $this->session->flashdata('error'); ?>
					<form id="addprojectform" action="<?php echo base_url();?>saveshipment" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							
								<div  class="form-group">
									<label for="username">Tracking Number</label>
									<input type="text" class="form-control"  name="tracking_number" required value="" id="project"/>
								</div>
								<div  class="form-group">
									<label for="username">Shipped From</label>
								<textarea class="form-control" name="shipped_from" required rows="3" required></textarea>
								</div>
								<div  class="form-group">
									<label for="username">Packing Slip(pdf)</label>
									<input type="file" accept=".pdf,.PDF" required class="form-control" name="packing_slip" size="50" />
									
								</div>
								<div  class="form-group">
								<label for="username">Received By</label>
								<textarea class="form-control" name="received_by" required rows="3" required></textarea>
								</div>
							
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addshipment" value="Add">
							
							</div>
							</div>
						
							</div>
					</form>
					
					
		
					
					
					
				
					</div>
				</div>
			</section>
			<section class="col-lg-9">
				<div class="box box-info">
				
					<div class="box-body">
					
					<table id="" class='table table-striped table-bordered datatable_report'>
						<thead>
							<tr>
								<th>Tracking Number</th>
								<th>Shipped From</th>
								<th>Received By</th>
								<th>Uploaded By</th>
								<th>Uploaded On</th>
								<th>Actions</th>
								
								
							  
							</tr>
						</thead>
						<tbody>
						<?php 

						if(isset($shipments) && count($shipments) > 0){ 
							foreach($shipments as $shipment){
					
						$newpath =	explode('razer',$shipment['TRACKING_FILE_PATH']);
							echo"<tr><td>".$shipment['TRACKING_NUMBER']."</td>";
							echo"<td>".$shipment['SHIPPED_FROM']."</td>";
							echo"<td>".$shipment['RECEIVED_BY']."</td>";
							echo"<td>".$shipment['UPLOADEDBY']."</td>";
							echo"<td>".$shipment['UPLOADON']."</td>";
							// echo"<td><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='viewdoc' name='viewdocn' onclick=\"viewdoc('".$shipment['PATH_LIST_PARTS']."')\" height='30px' width='30px' title='Show File' ></tr>";
							echo"<td><span class='pull-left' style='margin:17px;'><a href='".base_url()."editshipment/".$shipment['SHIPMENT_ID']."' class='btn btn-primary'>Edit</a>  <a onclick=\"viewdoc('".$newpath[1]."')\" ><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='' name=''  height='30px' width='30px' title='Show File'/ ></a></span></td></tr>";
							
							}
						}
						 ?>
						</tbody>

					</table>
					
					
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