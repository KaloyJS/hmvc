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
Time and Motion  for <?=$process[0]['PROCESS_TITLE'] ?>
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">StopWatch</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
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
  
  <div class="col-lg-12 col-xs-12">
    <!-- small box -->
	<div style="text-align:center;">
	
            <div class="example">
               
                <div id="demo1" style="font-size:180px;color:red;" >
				<input type="button" id="curtime" class="disp"style="font-size:180px;color:red;cursor:initial;outline:none;" value="00:00:00.000" ></div>
				<br/>
				<br/>
				<br/>
            <input type="button" class="btn btn-primary btn-large" onclick="start();" id="startbtn" value="Start">
			<input type="button" class="btn btn-primary btn-large" onclick="split();" id="clear" value="Split" />
            <input type="button" class="btn btn-primary btn-large" onclick="reset();" id="clear" value="Reset" />
			</div>
			<br/>
			<br/>
	<div class="row">	
	<section class="col-lg-6 col-md-6" style="text-align:left;">
				<div class="box box-info">
				
					<div class="box-body">
	<form id="addprojectform" action="<?php echo base_url();?>stopwatch/save-time-motion/<?=$process[0]['PROCESS_ID']?>" method="post" class="form-horizontal" enctype="multipart/form-data">
		   <div class="col-md-6">
			<div class="form-group">
				<label>Select No of deivces</label>
				<select required class="form-control select2" onchange="generateinput();" id="countmodel" name="countmodel"  data-placeholder="Select.."  >
									<option value=''>--</option>
									<?php for($i=1; $i<=10; $i++){ 
									echo "<option value='".$i."' >".$i."</option>";
									}
									?>
									
				</select>	
			</div>
			<div id ="modelname" >
		
			</div>
					
			<div id="splitdiv">
			
					
							
		 
        
			</div>
	
	
			</div>
			<div style="clear:both;"></div>
		<div id="submitbtn">
	
		</div>
	</form>
	
	</div>
	</div>
	</section>
	<section class="col-lg-6 col-md-6" style="text-align:left;">
		<div class="box box-info">
			<div class="box-body">
			<div id="splitdiv1" class="spwSPLT">
			
					
							
		 
        
			</div>
			</div>
		</div>
	</section>
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
<script src="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/js/jintervals.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/js/stopwatch.js"></script>
<script>

// var h1 = document.getElementsByTagName('h1')[1],
var h1 = document.getElementById('curtime'),
    // start = document.getElementById('start'),
    // stop = document.getElementById('stop'),
    // clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0, mseconds = 0,
    t;
	var splitname = new Array("");
	<?php
	$j=1;
	foreach($splitnames as $sname){
		echo "splitname[".$j."] = '".$sname."';";
		
		$j++;
		
	}
	
	?>

	var totalsplits = <?=$process[0]['SPLIT_COUNT'] ?>;
	var sec = 0;
	var j = 0;
	var starttime = 0;
	var stoptime = 0;
	var curtime = 0;
	 var calminutes = 0;
	 var totalhours  = 0;
	 var calseconds  = 0;
	 var totalmin  = 0;
	var totalmseconds = 0;
	var totalseconds = 0;
	var calmilisec = 0;
		var dateobj1 = new Date();
		stoptime = dateobj1.getTime();
function start(){
	if(j < totalsplits){
				var splitnameval = splitname[j];
		
		
	var startbtn = $("#startbtn").val();
	if(startbtn == 'Start'){
		 $("#startbtn").val("Stop");
		 if(starttime == 0){
			var dateobj = new Date();
			 starttime = dateobj.getTime();
		 }else{
			 // console.log(starttime-stoptime);
			 // console.log(stoptime);
		
			 var dateobj = new Date();
			var newcurtime = dateobj.getTime();
			starttime = stoptime-starttime;
			starttime = newcurtime-starttime;
				 // console.log(newcurtime);
		 }
		 timer();
		
	}else{
		var curtimeval = $("#curtime").val();
		$("#startbtn").val("Start");
		j++;
		
		var splitnameval = splitname[j];
		// alert(splitnameval);
		$("#splitdiv").append('<div class="form-group"><label>Split '+j+' Name</label><input type="hidden" id ="splitvalue_'+j+'" name="splitvalue[]"  required autocomplete="off"  class="form-control" value="'+ curtimeval +'" /><input type="text" id ="splitname_'+j+'" name="splitname[]"  required autocomplete="off"  class="form-control" value="'+splitnameval+'" />  </div>');
		$("#splitdiv1").append('<h1>Stop '+j+': '+curtimeval+'</h1>');
		var dateobj1 = new Date();
		stoptime = dateobj1.getTime();
		
		    clearTimeout(t);
	}
	
	}else{
		if(j == totalsplits){
				var dateobj1 = new Date();
		stoptime = dateobj1.getTime();
		
		    clearTimeout(t);
			$("#submitbtn").html("");
		$("#submitbtn").html('<input type="submit" class="btn btn-primary"  value="submit" />');
		}
		$("#startbtn").val("Start");
		alert("maximum number of splits for this process is "+totalsplits);
	}
}




function add() {
	
	var dateobj = new Date();
	curtime = dateobj.getTime();
	totalmseconds = curtime-starttime;
	// console.log(starttime);
	// mseconds = totalmseconds/1000;
	    mseconds  = totalmseconds%1000;
	    calmilisec = totalmseconds-mseconds;
	    totalseconds = calmilisec/1000;
	   
	   
	    seconds = totalseconds%60;
	    calseconds = totalseconds-seconds;
	    totalmin = calseconds/60;
	   
	   if(totalmin >=60){
		   
		    // minutes = totalmin-60;
		    minutes = totalmin%60;
		   
		   
	   }else{
		    minutes = totalmin;
	   }
	   
	   
	
	    calminutes = totalmin-minutes;
	   if(calminutes > 0){
			  totalhours = calminutes/60;
			 
			// if(totalhours >= 24){
			   
			   // hours = calminutes%60;
			   
			   
		   // }else{
				// hours = totalhours;
		   // }
	   hours = totalhours;
	   }
	   

    
    var valtextContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds) + "." + (mseconds > 9 ? (mseconds > 99 ? mseconds : "0" + mseconds) : "00" + mseconds);
	
	var titletext = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
	$("#curtime").val(valtextContent);
	  

    timer();
	
	document.title = titletext;  
}
function timer() {
    t = setTimeout(add, 1);
    // syncSetTimeout(add, 100);
	
}


function split(){
	var startbtn = $("#startbtn").val();
	if(startbtn == 'Stop'){
	var curtime = $("#curtime").val();
		j++;
		if(j <= totalsplits){
				var splitnameval = splitname[j];
		
		if(j == totalsplits){
				var dateobj1 = new Date();
		stoptime = dateobj1.getTime();
		
		    clearTimeout(t);
		$("#startbtn").val("Start");
		
		$("#submitbtn").html("");
		$("#submitbtn").html('<input type="submit" class="btn btn-primary"  value="submit" />');
		
		
		}
		// alert(splitnameval);
	// $("#splitdiv").append("<input type='text' value='" + curtime +" '> ");
	$("#splitdiv").append('<div class="form-group"><label>Split '+j+' Name</label><input type="hidden" id ="splitvalue_'+j+'" name="splitvalue[]"  required autocomplete="off"  class="form-control" value="'+ curtime +'" /><input type="text" id ="splitname_'+j+'" name="splitname[]"  required autocomplete="off"  class="form-control" value="'+splitnameval+'" />  </div>');
	$("#splitdiv1").append('<h1>Split '+j+': '+curtime+'</h1>');
	// alert(curtime);
	
	
		}else{
			
			alert("maximum number of splits for this process is "+totalsplits);
			$("#startbtn").val("Start");
		}
	
	}
}
function reset() {
       clearTimeout(t);
	    $("#startbtn").val("Start");
		$("#splitdiv").html("");
		$("#splitdiv1").html("");
	// h1.textContent = "00:00:00.000";
	$("#curtime").val("00:00:00.000");
	document.title = 'SBE Stopwatch';  
    seconds = 0; minutes = 0; hours = 0; mseconds = 0;
	 sec = 0;
	 j = 0;
	 starttime = 0;
	 stoptime = 0;
	 curtime = 0;
	  calminutes = 0;
	  totalhours  = 0;
	  calseconds  = 0;
	  totalmin  = 0;
	 totalmseconds = 0;
	 totalseconds = 0;
	 calmilisec = 0;
	
}		

function generateinput(){
	
	var countmodel = $("#countmodel").val();
	$("#modelname").html("");
	for(i = 1;i<=countmodel;i++){
		$("#modelname").append('<div  class="form-group"> 	<label>Model Name</label><input type="text" name="model[]"required autocomplete="off"  class="form-control" value="" /> </div>');
		
	}

	
	
	
}

</script>
<style>
.disp {
    font-family: 'Roboto Mono',monospace;
    font-size: 84px;
    vertical-align: middle;
    text-align: center;
    background-color: #000000;
	background: transparent;
    color: red;
    font-weight: 900;
    border: 0px none;
}
.spwSPLT {
    background: transparent;
    color: #666666;
    font-size: 40px;
    vertical-align: middle;
    text-align: center;
}
</style>