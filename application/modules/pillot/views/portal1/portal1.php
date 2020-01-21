<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<h1>
Pillot Portal <?=$portal?>
<small> </small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pillot Portal <?=$portal?></li>
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
			$error = $this->session->flashdata('error'); 
			if(isset($error) && $error !=''){  ?>
			<div id="file_updated_box">
				<div class="alert alert-danger alert-dismissible file_updated">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					<h4><i class="icon fa  fa-ban"></i> <?php echo $error; ?></h4>
				</div>
			</div>
			<?php
			}
			?>
			</div>
	
		</div>
		<div class="row">

			<section class="col-lg-12 col-md-12">
				<div class="box box-info">
				
					<div class="box-body">
					
					  
					<form id="addform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" 	onsubmit="return checkimei()" method="post" class="form-horizontal" enctype="multipart/form-data">
					
							<div class="col-md-6 ">
							
								<div  class="">
									<label for="username">Agent Name</label>
									<input type="text" class="form-control" name="AGENT_NAME" required value="<?php if(isset($_POST['AGENT_NAME']) && $_POST['AGENT_NAME'] != ''){ echo $_POST['AGENT_NAME'] ; }  ?>" id="AGENT_NAME"/>
								</div>
								<div  class="">
									<label for="BB_NUMBER">BB Number</label>
									<input type="text" class="form-control" name="BB_NUMBER" required value="<?php if(isset($_POST['BB_NUMBER']) && $_POST['BB_NUMBER'] != ''){ echo $_POST['BB_NUMBER'] ; }  ?>" id="BB_NUMBER"/>
								</div>
								<div  class="">
									<label for="IMEI_SCREENED">IMEI Screened</label>
									<input type="text" class="form-control" onchange="checkimei();" name="IMEI_SCREENED" required value="<?php if(isset($_POST['IMEI_SCREENED']) && $_POST['IMEI_SCREENED'] != ''){ echo $_POST['IMEI_SCREENED'] ; }  ?>" id="IMEI_SCREENED"/>
								</div>
							</div>
							<div class="col-md-6">
								<div  class="">
									<label for="MAKE">Make</label>
									  <select onchange="getmodels_by_manufacturer();" class="form-control select2 userOemDropdown" data-placeholder="Select Manufacturer" name="MAKE" id="MAKE" required style="width: 100%;" aria-hidden="true">
								
								<?php 
								$selected ='';
									foreach($manufacturer_list as $row){
										
										echo " <option value='".$row['MANUFACTURER']."'";
										if(isset($_POST['MAKE']) && $_POST['MAKE'] == $row['MANUFACTURER']){echo "selected";} 
										echo ">".$row['MANUFACTURER']."</option>";
									}					
								?>
								<option value="OTHER" <?php if(isset($_POST['MAKE']) && $_POST['MAKE'] =='OTHER' ){ echo "selected";   }?> >OTHER</option>
							</select>
								</div>
								
								<div  class="">
									<label for="MODEL">Model</label>
									<select class="form-control select2" onchange="checkmodel();" id="MODEL" name="MODEL"  data-placeholder="Select.." required >
							
									</select>
								</div>
						
							
							
							
						
							</div>
							<div style="clear:both"> </div>
							<div class="col-md-6">
								<div class="" id="othermanfr">
							  
								</div>
							</div>
							<div class="col-md-6">
								<div class="" id="othermodel">
							  
								</div>
							</div>
							<div style="clear:both"> </div>
						<?php
						$quescount = count($questions);
						if(isset($questions) && $quescount > 0){
						echo '<div class="col-md-6">';
						// prints($questions);
						
						for($i=0;$i<$quescount;$i++){
							$j = $questions[$i]['QUES_ID'];
							if($questions[$i]['TYPE'] == 1){
								$optionarray = array("YES","NO","N/A");
							}else{
								$optionarray = array("PASS","FAIL","N/A");
							}
						
						?>
						<div  class="">
						<label for="Q<?=$j?>"><?=$questions[$i]['QUES']?> (Q<?=$j?>)</label>
						  <select class="form-control select2 userOemDropdown" data-placeholder="Select" name="Q<?=$j?>" id="Q<?=$j?>" required style="width: 100%;" aria-hidden="true">
								
								<?php 
								$selected ='';
									foreach($optionarray as $row){
										echo "<option value=''> </options>";
										echo " <option value='".$row."'";
										if(isset($_POST['Q'.$j]) && $_POST['Q'.$j] == $row){echo "selected";} 
										echo ">".$row."</option>";
									}					
								?>
								
							</select>
						</div>
						<?php if($questions[$i]['CMNT'] == 1){ ?>
						<div  class="">
							<label for="C<?=$j?>">Comment</label>
							<textarea name="C<?=$j?>" class="form-control rounded-0" id="C<?=$j?>" rows="3"><?php if(isset($_POST['C'.$j]) && $_POST['C'.$j] != ''){ echo $_POST['C'.$j] ; }  ?></textarea>
						</div>
						
						<?php
						}
						if($i%1 == 0 && $i != 0){
							echo '</div> 
							
							<div class="col-md-6">';
							
						}
						// ECHO $i .'mode is ';
						// ECHO $i%5;
							
							
						}
						}
						?>
						</div>
						<div style="clear:both"></div>
						<div class="col-md-6">
							
						<div  class="">
							<label for="C<?=$j?>">Tech Comment</label>
							<textarea name="COMMENTS" class="form-control rounded-0" id="COMMENTS" > <?php if(isset($_POST['COMMENTS']) && $_POST['COMMENTS'] != ''){ echo $_POST['COMMENTS'] ; }  ?> </textarea>
						</div>
						
						</div>
						
						<div style="clear:both"></div>
						<div class="col-md-6">
						
						
						<br/>
						<div  class="">
						
							<input type="submit" class="btn btn-primary "   value="Submit">
							
						
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
	
function getmodels_by_manufacturer()
			{	
			var manfr = $("#MAKE").val();
			if(manfr =='OTHER'){
			$('#othermanfr').html('');
			$('#othermanfr').html('<label for="newmanfr">Manufacturer Name</label>  <input class="form-control" value="<?php if(isset($_POST['newmanfr'])){echo $_POST['newmanfr'];}else{ echo "";} ?>" id="newmanfr" name="newmanfr" placeholder="Manufacturer Name" type="text"  required>');
			checkmodel();
			}else{
					$('#othermanfr').html('');
			}
					// checkmodel();	
	// $('#othermodel').html('');
				
			
				// alert(plant);
				$.ajax({
				type:"post",
				url:"getprocess",
				data:"manufacturer="+manfr,
				dataType:"json",
				success:function(data)
				{			
					$("#MODEL").html("");
				
				var postselect = '<?php if(isset($_POST['MODEL']) && $_POST['MODEL'] != '') {echo $_POST['MODEL'];}else{ echo '';}?>';
					// alert(postselect);
				var selected='';
					console.log(data);
					$("#MODEL").append("<option value=''> </option>");	
					for(var index in data)
					{
						var obj = data[index];
						if(obj == postselect){
							// alert(obj);
							 selected = 'selected';
						}else{
							 selected = '';
						}
						// console.log(obj);
						$("#MODEL").append("<option value='"+obj+"' "+selected+"  >"+ obj+"</option>");			
					}
				$("#MODEL").append("<option value='OTHER'>OTHER</option>");	
				$("#MODEL").val('<?php if(isset($_POST['MODEL']) && $_POST['MODEL'] != ''){ echo $_POST['MODEL'] ; }  ?>');
				// var sel = document.getElementById('MODEL');
				// var selected = sel.options[sel.selectedIndex];
				// var code = selected.getAttribute('code');
				// var code = $('#MODEL').attr("code");
				// alert(code);
				// $('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="'+code+'">');		
				checkmodel();				
				}
				
				});		

			
			}
			
function checkmodel(){
		var model = $("#MODEL").val();
		// alert(moidel);
	if(model == 'OTHER'){

		// $('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="">');
		$('#othermodel').html('');
		$('#othermodel').html('<label for="newmodel">Model Name</label>  <input class="form-control" value="<?php if(isset($_POST['newmodel'])){echo $_POST['newmodel'];}else{ echo "";} ?>" id="newmodel" name="newmodel" placeholder="Model.." type="text"  required>');
	}else{
		
		// alert(model);
		// var sel = document.getElementById('model');
		// var selected = sel.options[sel.selectedIndex];
		// var code = selected.getAttribute('code');
		// var code = $('#model').attr("code");
		// alert(code);
		// $('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="'+code+'">');
		$('#othermodel').html('');
	}
	
}

$(document).ready(function(){
	var manfr = $('#MAKE').val();
	getmodels_by_manufacturer();
	if(manfr == 'OTHER'){
		$('#othermanfr').html('');
		$('#othermanfr').html('<label for="newmanfr">Manufacturer Name</label>  <input class="form-control" value="<?php if(isset($_POST['newmanfr'])){echo $_POST['newmanfr'];}else{ echo "";} ?>" id="newmanfr" name="newmanfr" placeholder="Manufacturer Name" type="text"  required>');
		// checkmodel();
	}else{
		
		$('#othermanfr').html('');
		// checkmodel();
	}
	
	var model = $('#MODEL').val();
	
	if(model == 'OTHER'){
		$('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="">');
		$('#othermodel').html('');
		$('#othermodel').html('<label for="newmodel">Model Name</label>  <input class="form-control" value="<?php if(isset($_POST['newmodel'])){echo $_POST['newmodel'];}else{ echo "";} ?>" id="newmodel" name="newmodel" placeholder="Model.." type="text"  required>');
		$('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="">');
	
	}else{
		// var sel = document.getElementById('model');
		// var selected = sel.options[sel.selectedIndex];
		// var code = selected.getAttribute('code');
		// var code = $('#model').attr("code");
		// alert(code);
		// $('#modelcode').html('<input class="form-control" name="modelcode" type="hidden" value="'+code+'">');
		$('#othermodel').html('');
	}


	});	
	
	function checkimei(){
		// alert('call');
	$('#IMEI_SCREENED').next('label').remove();
	var imei = $('#IMEI_SCREENED').val();
	var regex = '/^\d+$/';
	// regex.test(imei);

	if(imei.length == 15){
	$('#IMEI_SCREENED').next('label').remove();

	
	}else{
		$('#IMEI_SCREENED').after('<label class="control-label  text-danger">IMEI should be of 15 digits</label>');
	
	}
}



// function submitform(){
	// var flag = checkimei();
	// if(flag == true){
		// $("#addform").submit();
	// }

	</script>
	<style>
	textarea.form-control {
    height: auto;
    background: #ffe94a54;
}
</style>