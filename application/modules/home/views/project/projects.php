<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<h1>
Project Management
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Project Management</li>
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
				
					<div class="box-body">
					
					<table id="" class='table table-striped table-bordered datatable_report'>
						<thead>
							<tr>
								<th>Project Title</th>
								<th>Description</th>
								<th>Monitored By</th>
								<th>Hours</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Creation Date</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							// print_r($projects);
					
						if(isset($projects) && count($projects) > 0){ 
							foreach($projects as $project){
							
							echo"<tr><td>".$project['PROJECT_NAME']."</td>";
							echo"<td>".$project['PROJECT_DESC']."</td>";
							echo"<td>".$project['PRENOM']." ".$project['NOM']."</td>";
							echo"<td>".$project['HOURS_COMPLETE']."</td>";
							echo"<td>".$project['START_DATE']."</td>";
							echo"<td>".$project['END_DATE']."</td>";
							echo"<td>".$project['CREATED_DATE']."</td>";
							echo"</tr>";
							
							
							
							}
						}
						 ?>
						</tbody>

					</table>
					
					
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

});
</script>