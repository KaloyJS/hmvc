<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);

?>
<h1>
Dashboard
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
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
	<form id="addprojectform" action="<?php echo base_url();?>stopwatch/save-time-motion" method="post" class="form-horizontal" enctype="multipart/form-data">
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
		
		<input type="submit" class="btn btn-primary"  value="submit" />
			
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
	var sec = 0;
	var j = 0;
	var starttime = 0;
	var stoptime = 0;
	var curtime = 0;
	var totalmseconds = 0;
	
function start(){
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
		$("#splitdiv").append('<div class="form-group"><label>Split '+j+' Name</label><input type="hidden" id ="splitvalue_'+j+'" name="splitvalue[]"  required autocomplete="off"  class="form-control" value="'+ curtimeval +'" /><input type="text" id ="splitname_'+j+'" name="splitname[]"  required autocomplete="off"  class="form-control" value="" />  </div>');
		$("#splitdiv1").append('<h1>Stop '+j+': '+curtimeval+'</h1>');
		var dateobj1 = new Date();
		stoptime = dateobj1.getTime();
		
		    clearTimeout(t);
	}
}




function add() {
	
	var dateobj = new Date();
	curtime = dateobj.getTime();
	totalmseconds = curtime-starttime;
	// console.log(starttime);
	// mseconds = totalmseconds/1000;
	   var mseconds  = totalmseconds%1000;
	   var calmilisec = totalmseconds-mseconds;
	   var totalseconds = calmilisec/1000;
	   
	   
	    seconds = totalseconds%60;
	   var calseconds = totalseconds-seconds;
	   var totalmin = calseconds/60;
	   
	   if(totalmin >=60){
		   
		    minutes = calseconds%60;
		   
		   
	   }else{
		    minutes = totalmin;
	   }
	   
	   
	
	   var calminutes = totalmin-minutes;
	   if(calminutes > 0){
			 var totalhours = calminutes/60;
			 
			if(totalhours >= 24){
			   
			   hours = calminutes%60;
			   
			   
		   }else{
				hours = totalhours;
		   }
	   
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
	// $("#splitdiv").append("<input type='text' value='" + curtime +" '> ");
	$("#splitdiv").append('<div class="form-group"><label>Split '+j+' Name</label><input type="hidden" id ="splitvalue_'+j+'" name="splitvalue[]"  required autocomplete="off"  class="form-control" value="'+ curtime +'" /><input type="text" id ="splitname_'+j+'" name="splitname[]"  required autocomplete="off"  class="form-control" value="" />  </div>');
	$("#splitdiv1").append('<h1>Split '+j+': '+curtime+'</h1>');
	// alert(curtime);
	
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
	starttime = 0;
	curtime = 0;
	j = 0;
	
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