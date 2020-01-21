<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);
?>
<h1>
Shipment
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Shipment</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->

<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 col-md-12 connectedSortable">
   
 
    <!-- TO DO List -->
    <div class="box box-primary">
      <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">Shipment</h3>
        <div class="box-tools pull-right">
          <ul class="pagination pagination-sm inline">
         
          </ul>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
     
					
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
							echo"<td><span class='pull-left' style='margin:5px;'> <a onclick=\"viewdoc('".$newpath[1]."')\" ><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='' name=''  height='30px' width='30px' title='Show File'/ ></a></span></td></tr>";
							
							}
						}
						 ?>
						</tbody>

					</table>
			
      </div>

      <!-- /.box-body -->
      <div class="box-footer clearfix no-border">
		<div id="showfile" title="">

		</div>
      </div>
    </div>
    <!-- /.box -->
  
  </section>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
  
  <!-- right col -->
</div>
<!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
.switchbtn {
  display: block;
  opacity: 0;
}
.switchbtn ~ label {
  width: 60px;
  height: 30px;
  cursor: pointer;
  display: inline-block;
  position: relative;
  background: rgb(189, 189, 189);
  border-radius: 30px;
  
  transition: background-color 0.4s;
  -moz-transition: background-color 0.4s;
  -webkit-transition: background-color 0.4s;
}
.switchbtn ~ label:after {
  left: 0;
  width: 20px;
  height: 20px;
  margin: 5px;
  content: '';
  position: absolute;
  background: #FFF;
  border-radius: 10px;
}
.switchbtn:checked + label {
  background: rgb(39, 173, 95);
}
.switchbtn:checked + label:after {
  left: auto;
  right: 0;
}

.switchbtn ~ p {
  font: normal 8px/40px Arial;
  color: rgb(189, 189, 189);
  display: none;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.switchbtn:checked ~ p:nth-of-type(1) {
  color: rgb(39, 173, 95);
  display: block;
}
.switchbtn:not(:checked) ~ p:nth-of-type(2) {
  display: block;
}
</style>

<script>
function viewdoc(path){
	$( "#showfile" ).dialog( "open" );	
	$("#showfile").html("<iframe src='<?=base_url();?>assets/viewerjs/ViewerJS/#<?=base_url();?>"+path+"' width='100%' height='100%'  style='border: none;' allowfullscreen ></iframe>");
	
}

function check(id){
	// alert(id);
	var idval = $('#checkbox'+id).prop('checked');
	var approved = '';
	// alert(idval);
				if(idval == true){
					approved ='YES';
				}else{
					approved = 'NO';
					
				}
			

				$.ajax({
				type:"post",
				url:"<?php echo base_url();?>setapproved",
				data:'projectapproved='+approved+'&boxid='+id,
				dataType:"json",
				success:function(data)
				{		
				// console.log(data);
				// alert(data);
					window.location.reload();
				
		
				}
					
					
				
				});	
}
</script>