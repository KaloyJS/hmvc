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

			<section class="col-lg-3 col-md-3">
				<div class="box box-info">
				
					<div class="box-body">
					
					   <?php  echo  $this->session->flashdata('error'); ?>
					<form id="addprojectform" action="<?php echo base_url();?>updateproject/<?=$projects[0]['PROJECT_ID']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							<div class="form-group">
								<label>Start Date</label>
									<input type="text" id="startdate" name="startdate" required autocomplete="off"  class="form-control" value="<?php if (isset($projects[0]['START_DATE'])){echo $projects[0]['START_DATE'];}else{ echo date('Y/m/d');}?>" />
								</div>
								<div class="form-group">
								<label>End Date</label>
									<input type="text" id="enddate" autocomplete="off" required  name="enddate" class="form-control" value="<?php if (isset($projects[0]['END_DATE'])){echo $projects[0]['END_DATE'];}else{ echo date('Y/m/d');}?>" />
								</div>
								<div  class="form-group">
									<label for="username">Project Title</label>
									<input type="text" class="form-control" value="<?php if (isset($projects[0]['PROJECT_NAME'])){echo $projects[0]['PROJECT_NAME'];}?>" name="project" required value="" id="project"/>
								</div>
							
								<div  class="form-group">
									<label for="username">Description of task</label>
									
									<textarea class="form-control" id="taskdesc" required name="taskdesc" rows="4"><?php if (isset($projects[0]['PROJECT_DESC'])){echo $projects[0]['PROJECT_DESC'];}?></textarea>
								</div>
							
							<div  class="form-group">
							
								
							  <label for="pre_srcnum">Monitored By</label>
							<select class="form-control select2" id="user" name="user"  data-placeholder="Select.." required >
							
							<?php 	 
						echo "<option value=''>--</option>";

						// $sql_qry_bdg =  "select Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
					
						foreach ($users as $row){		
					
						echo "<option value='".$row['BADGE']."'";
								if(isset($projects[0]['MONITORED_BY']) && $row['BADGE'] == $projects[0]['MONITORED_BY']){
									echo " selected ";
								}
						echo ">".$row['BADGE']." - ".$row['FIRST_NAME']." ".$row['LAST_NAME']."</option>";
						}
										?>
							</select>
								
							</div>
							
							<div  class="form-group">
								<label for="username">Hours to complete task</label>
									<input type="number" class="form-control" value="<?php if (isset($projects[0]['HOURS_COMPLETE'])){echo $projects[0]['HOURS_COMPLETE'];}?>" name="hours" required value="" id="hours"/>
							</div>
							
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addproject" value="Update">
							
							</div>
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

});
</script>