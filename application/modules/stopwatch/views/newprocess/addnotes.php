<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php

$splitnames = json_decode($process[0]['SPLIT_NAMES']);
// prints($process);
      // [0] => Array
        // (
            // [PROCESS_ID] => 22
            // [PROCESS_TITLE] => new test process
            // [PROCESS_NOTES] => 
            // [CREATED_ON] => 25-SEP-19 11.44.01.000000 AM
            // [SPLIT_NAMES] => ["cosmetic","piciea","unlocking","live call","pervacio","artemis update"]
            // [SPLIT_COUNT] => 6
        // )

?>
<h1>
Start New Process
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Start New Process</li>
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

			<section class="col-lg-6 col-md-6">
				<div class="box box-info">
				
					<div class="box-body">
					
					   <?php  echo  $this->session->flashdata('error'); ?>
					<form id="addprocessform" action="<?php echo base_url();?>stopwatch/updateprocess/<?=$process[0]['PROCESS_ID']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-12">
							
								<div  class="form-group">
									<label for="username">Process Title</label>
								<textarea class="form-control" id="process" required name="process" rows="4"><?=$process[0]['PROCESS_TITLE']?></textarea>
								</div>
						
						<div  class="form-group">
							<label for="username">Notes</label>
						<textarea class="form-control" id="notes" required name="notes" rows="4"><?=$process[0]['PROCESS_NOTES']?></textarea>
						</div>
						<div class="form-group">
							<label>Select No of Splits</label>
							<select required class="form-control select2" onchange="generateinput();" id="totalsplits" name="totalsplits"  data-placeholder="Select.."  >
							<option value=''>--</option>
							<?php for($i=1; $i<=20; $i++){ 
							echo "<option value='".$i."' ";

							if($process[0]['SPLIT_COUNT'] == $i){ echo "selected"; }    
							echo " >".$i."</option>";
								}
								?>
									
							</select>	
						</div>
							<div id ="splitnames" >
							<?php
							foreach($splitnames as $spl){ 
							echo '<div  class="form-group"> 	<label>Split Name</label><input type="text" name="splitname[]"required autocomplete="off"  class="form-control" value="'.$spl.'" /> </div>';
							}
							?>
							</div>
							<div  class="form-group">
							<div class="col-md-6">
							<input type="submit" class="btn btn-primary"  name="addprocess" value="Update">
							
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


function generateinput(){

	var totalsplits = $("#totalsplits").val();
	$("#splitnames").html("");
	for(i = 1;i<=totalsplits;i++){
		$("#splitnames").append('<div  class="form-group"> 	<label>Split Name</label><input type="text" name="splitname[]"required autocomplete="off"  class="form-control" value="" /> </div>');
		
	}	
}
</script>