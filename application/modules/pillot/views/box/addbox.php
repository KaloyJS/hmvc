<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<h1>
Pallet Management
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pallet Management</li>
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

			<section class="col-lg-3 col-md-3">
				<div class="box box-info">
				
					<div class="box-body">
					
					   <?php  echo  $this->session->flashdata('error'); ?>
					<form id="addprojectform" action="<?php echo base_url();?>savebox" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							
								<div  class="form-group">
									<label for="username">Box Quantity</label>
									<input type="NUMBER" class="form-control" step="0.01" name="box" required value="" id="project"/>
								</div>
								<div  class="form-group">
									<label for="username">Attach File(pdf)</label>
									<input type="file" accept=".pdf,.PDF" class="form-control" name="partsfile" size="50" />
									
								</div>
							
							
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addbox" value="Add">
							
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
								<th>Boxes</th>
								<th>Uploaded By</th>
								<th>Uploaded On</th>
								<th>Approved BY</th>
								<th>Approved On</th>
								<th>APPROVED</th>
								<th>Actions</th>
								
								
							  
							</tr>
						</thead>
						<tbody>
						<?php 
							// prints($palletdata['manual_insert']);
					       
         // [UPLOADEDBY] => SAURABH SHARMA
            // [BOX_ID] => 24
            // [QTY_BOX] => 3
            // [PATH_LIST_PARTS] => C:/xampp/htdocs/razer/uploads/Report_03a6f2d2-75ca-4e30-9339-aa4b9e2a6e46.pdf
            // [APPROVED] => YES
            // [UPLOADED_BY] => 106434
            // [UPLOAD_DATE] => 24-JUL-19 09.48.16.000000 AM
            // [APPROVED_BY] => 
            // [APPROVED_ON] => 
            // [FILE_NAME] => Report_03a6f2d2-75ca-4e30-9339-aa4b9e2a6e46.pdf
            // [APPROVEDBY] =>  
            // [UPLOADON] => 2019/07/24
            // [APPROVEDON] => 
						if(isset($palletdata['manual_insert']) && count($palletdata['manual_insert']) > 0){ 
							foreach($palletdata['manual_insert'] as $box){
								if($box['APPROVED'] =='' || $box['APPROVED'] =='NO'){
									$approvebtn ='';
									$approve ='NO';
								}else{
									$approvebtn ='checked';
									$approve ='YES';
								}
						$newpath =	explode('razer',$box['PATH_LIST_PARTS']);
							echo"<tr><td>".$box['QTY_BOX']."</td>";
							echo"<td>".$box['UPLOADEDBY']."</td>";
							echo"<td>".$box['UPLOADON']."</td>";
							echo"<td>".$box['APPROVEDBY']."</td>";
							echo"<td>".$box['APPROVEDON']."</td>";
							echo"<td>".$approve."</td>";
							
							// echo"<td><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='viewdoc' name='viewdocn' onclick=\"viewdoc('".$box['PATH_LIST_PARTS']."')\" height='30px' width='30px' title='Show File' ></tr>";
							echo"<td><span class='pull-left' style='margin:17px;'> <a onclick=\"viewdoc('".$newpath[1]."')\" ><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='' name=''  height='30px' width='30px' title='Show File'/ ></a></span></td></tr>";
							
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