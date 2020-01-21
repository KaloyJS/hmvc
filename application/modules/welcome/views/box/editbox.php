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
					
					   <?php  echo  $this->session->flashdata('error'); 
					   $box = $palletdata[0];
					   ?>
					<form id="addprojectform" action="<?php echo base_url();?>updatebox/<?=$box['BOX_ID']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							<div  class="form-group">
									<label for="type">Select Type</label>
									<select required class="form-control select2" id="type" name="type"  data-placeholder="Select.." required >
									<?php 
									$newpath =	explode('razer',$box['PATH_LIST_PARTS']);
									if(substr($box['QTY_BOX'], 0, 1) == '-'){
									$type="-";
									$box['QTY_BOX'] = str_replace('-','',$box['QTY_BOX']);
								}else{
									$type="+";
								}
									?>
									<option value=''>--</option>
									<option value='+'<?php if($type =='+'){echo "selected"; } ?> >ADD</option>
									<option value='-' <?php if($type =='-'){echo "selected"; } ?> >REMOVE</option>
									</select>
									
							</div>
								<div  class="form-group">
									<label for="username">Box Quantity</label>
									<input type="NUMBER" class="form-control" step="0.01" name="box" required value="<?=$box['QTY_BOX']?>" id="project"/>
								</div>
								<div  class="form-group">
									<label for="username">Attach File(pdf)</label>
									<input type="file" accept=".pdf,.PDF" class="form-control" name="partsfile" size="50" />
									
								</div>
								<div  class="form-group">
									<label for="username">View Old File</label><br/>
							<?php echo "<a onclick=\"viewdoc('".$newpath[1]."')\" class='btn btn-primary'> Show File</a>";
									?>
									
								</div>
							
							
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addbox" value="Update">
							
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