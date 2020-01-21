<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($parts);
?>
<h1>
Stock
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Stock</li>
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
        <h3 class="box-title">Stock</h3>
        <div class="box-tools pull-right">
          <ul class="pagination pagination-sm inline">
         
          </ul>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
     
					
					<table style="width:100%;" id="datatable_report" class='table table-striped table-bordered '>
						<thead>
							<tr>
								<th>Pallet Count</th>
								<th>Date</th>
								
				
							  
							</tr>
						</thead>
						<tbody>
						<?php 
		
						if(isset($stock) && count($stock) > 0){ 
						// prints($stock);
							foreach($stock as $st){
						
							echo"<tr><td>".$st['PALLET_COUNT']."</td>";
					
							echo"<td>".$st['STOCK_DATE']."</td></tr>";
							// echo"<td>".$part['PART_DESCRIPTION']."</td>";
							// echo"<td>".$part['QTY']."</td>";
							// echo"<td>".$part['MODEL1']."</td></tr>";
						
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
$(document).ready(function() {
	$("#datatable_report").DataTable({
        dom: 'lBfrtip',
		 scrollX: true,
      buttons: [ {
           extend: 'excelHtml5',
           text: 'Download Report',
           filename: function() {
               // var date_edition = moment().format("YYYY-MM-DD")
               return 'SBE_Razer';
           },
       
           title : null
       }],
		
    } );
		$(".dt-button").removeClass('dt-button').addClass('btn btn-success');
});
function viewdoc(path){
	$( "#showfile" ).dialog( "open" );	
	$("#showfile").html("<iframe src='<?=base_url();?>assets/viewerjs/ViewerJS/#<?=base_url();?>"+path+"' width='100%' height='100%'  style='border: none;' allowfullscreen ></iframe>");
	
}


</script>