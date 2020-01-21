<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<?php
// prints($palletdata);
?>
<h1>
Pallet
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pallet</li>
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
        <h3 class="box-title">Pallet</h3>
        <div class="box-tools pull-right">
          <ul class="pagination pagination-sm inline">
         
          </ul>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
     
					
					<table id="datatable_report" class='table table-striped table-bordered '>
						<thead>
							<tr>
								<th>Boxes</th>
								<th>Type</th>
								<th>Uploaded By</th>
								<th>Uploaded On</th>
								<th>Approved BY</th>
								<th>Approved On</th>
								<th>APPROVED</th>
								<th>Actions</th>
								
								
							  
							</tr>
						</thead>
						<tbody>
						<?php 
							// prints($palletdata['manual_insert']);
					       
         // [UPLOADEDBY] => SAURABH SHARMA
            // [BOX_ID] => 24
            // [QTY_BOX] => 3
            // [PATH_LIST_PARTS] => C:/xampp/htdocs/razer/uploads/Report_03a6f2d2-75ca-4e30-9339-aa4b9e2a6e46.pdf
            // [APPROVED] => YES
            // [UPLOADED_BY] => 106434
            // [UPLOAD_DATE] => 24-JUL-19 09.48.16.000000 AM
            // [APPROVED_BY] => 
            // [APPROVED_ON] => 
            // [FILE_NAME] => Report_03a6f2d2-75ca-4e30-9339-aa4b9e2a6e46.pdf
            // [APPROVEDBY] =>  
            // [UPLOADON] => 2019/07/24
            // [APPROVEDON] => 
						if(isset($palletdata['manual_insert']) && count($palletdata['manual_insert']) > 0){ 
							foreach($palletdata['manual_insert'] as $box){
								if($box['APPROVED'] =='' || $box['APPROVED'] =='NO'){
									$approvebtn ='';
									$approve ='NO';
								}else{
									$approvebtn ='checked';
									$approve ='YES';
								}
								if(substr($box['QTY_BOX'], 0, 1) == '-'){
									$type="Removed";
									$box['QTY_BOX'] = str_replace('-','',$box['QTY_BOX']);
								}else{
									$type="Added";
								}
						$newpath =	explode('razer',$box['PATH_LIST_PARTS']);
							echo"<tr><td>".$box['QTY_BOX']."</td>";
							echo"<td>".$type."</td>";
							echo"<td>".$box['UPLOADEDBY']."</td>";
							echo"<td>".$box['UPLOADON']."</td>";
							echo"<td>".$box['APPROVEDBY']."</td>";
							echo"<td>".$box['APPROVEDON']."</td>";
							echo"<td>".$approve."</td>";
							
							// echo"<td><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='viewdoc' name='viewdocn' onclick=\"viewdoc('".$box['PATH_LIST_PARTS']."')\" height='30px' width='30px' title='Show File' ></tr>";
							$userrole = getRole();
							if($userrole='ADMIN' || $userrole ='PARTS'){
								$aprvbtn = "<span class='pull-left'><input class='switchbtn' type='checkbox' name='approvebtn' onchange='check(\"".$box['BOX_ID']."\");' id='checkbox".$box['BOX_ID']."' ".$approvebtn." /> <label for='checkbox".$box['BOX_ID']."'></label>  <p>APPROVED</p><p>Rejected</p></span>";
							}else{
								$aprvbtn = "";
							}
							echo"<td>".$aprvbtn."  <span class='pull-left' style='margin:17px;'> <a onclick=\"viewdoc('".$newpath[1]."')\" ><img src='".base_url()."/assets/backend/AdminLTE/dist/img/view.png' class='' name=''  height='30px' width='30px' title='Show File'/ ></a></span></td></tr>";
							
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
    $('#datatable_report').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );

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