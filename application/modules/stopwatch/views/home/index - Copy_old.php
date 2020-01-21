<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);
 // [totaldisplays] => 403
    // [totalbattery] => 187
    // [totalmainboard] => 865
    // [totalcover] => 963
    // [totalaccessory] => 995
    // [totalmainparts] => 2418
    // [otherparts] => 12019
    // [palletformainparts] => 20.15
    // [palletforaccessories] => 2.21
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
				<input type="button" id="curtime" class="disp"style="font-size:180px;color:red;" value="00:00:00.000" ></div>
				<br/>
				<br/>
				<br/>
            <input type="button" class="btn btn-primary btn-large" onclick="start();" id="startbtn" value="Start">
			<input type="button" class="btn btn-primary btn-large" onclick="split();" id="clear" value="Split" />
            <input type="button" class="btn btn-primary btn-large" onclick="reset();" id="clear" value="Reset" />
			</div>
           <form id="addprojectform" action="<?php echo base_url();?>saveproject" method="post" class="form-horizontal" enctype="multipart/form-data">
		   <div class="col-md-6">
							<div class="form-group">
								<label>Start Date</label>
									<input type="text" id="startdate" name="startdate" required autocomplete="off"  class="form-control" value="<?php if (isset($_POST['startdate'])){echo $_POST['startdate'];}?>" />
								</div>
							</div>
         <div id="splitdiv">
			
					
							
		 
        
	</div>
	</form>
	<div>
	
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
// (function($){
   // $('#demo1').stopwatch().stopwatch('start');
        // $('#demo2').stopwatch().click(function(){ 
            // $(this).stopwatch('toggle');
        // });
       // $('#demo3').stopwatch().click(function(){ 
           // $(this).stopwatch('reset');
       // }).stopwatch('start');
       // $('#demo4').stopwatch({startTime: 10000000}).stopwatch('start');
       // $('#demo5').stopwatch({updateInterval: 2000}).stopwatch('start');
       // $('#demo6').stopwatch({format: '{Minutes} and {s.}'}).stopwatch('start');
// })(jQuery);


// var h1 = document.getElementsByTagName('h1')[1],
var h1 = document.getElementById('curtime'),
    // start = document.getElementById('start'),
    // stop = document.getElementById('stop'),
    // clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0, mseconds = 0,
    t;
	var sec = 0;
function start(){
	var startbtn = $("#startbtn").val();
	if(startbtn == 'Start'){
		 $("#startbtn").val("Stop");
		 timer();
		
	}else{
		var curtime = $("#curtime").val();
		 $("#startbtn").val("Start");
		$("#splitdiv").append("<input type='text' value='" + curtime +" '> ");
		    clearTimeout(t);
	}
}




function add() {
    mseconds = mseconds+10;
	// sec++;
    // seconds++;
	if(mseconds >= 1000){
		mseconds = 0;
		seconds++;
		
		if (seconds >= 60) {
			seconds = 0;
			minutes++;
			if (minutes >= 60) {
				minutes = 0;
				hours++;
			}
		}
	}
    
    var valtextContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds) + "." + (mseconds > 9 ? (mseconds > 99 ? mseconds : "0" + mseconds) : "00" + mseconds);
	
	// var valtextContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
	$("#curtime").val(valtextContent);
	  

    timer();
}
function timer() {
    // t = setTimeout(add, 10);
    syncSetTimeout(add, 10);
	
}
function syncSetTimeout(func, ms, callback) {
    (function sync(done) {
        if (!done) {
          t =  setTimeout(function() {
                func.apply(func);
                sync(true);
            }, ms);
            return;
        }
        callback.apply(callback);
    })();
}
function split(){
	
	var curtime = $("#curtime").val();

	$("#splitdiv").append("<input type='text' value='" + curtime +" '> ");
	// alert(curtime);
}
function reset() {
       clearTimeout(t);
	    $("#startbtn").val("Start");
		$("#splitdiv").html("");
	// h1.textContent = "00:00:00.000";
	$("#curtime").val("00:00:00.000");
    seconds = 0; minutes = 0; hours = 0; mseconds = 0;
	
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
</style>
<style>