<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

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

<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 col-md-12 connectedSortable">
   
 
    <!-- TO DO List -->
    <div class="box box-primary">
      <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">Portals</h3>
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
								<th>Portal</th>
								<th>Link</th>
							</tr>
						</thead>
						<tbody>
					<tr><td>Bell Returns</td>
					<td><a href="<?php echo BASEURL; ?>bellreturns" target="_blank">Bell Returns</a></td></tr>	
					<tr>	<td>Bell 4 R</td>
					<td><a href="<?php echo BASEURL; ?>bell4r" target="_blank">Bell 4 R</a></td>
							</tr>
					<tr>	<td>Rogers</td>
					<td><a href="<?php echo BASEURL; ?>rogers" target="_blank">Rogers</a></td>
							</tr>	
						<tr><td>Parts</td>
					<td><a href="<?php echo BASEURL; ?>parts" target="_blank">Parts</a></td>
							</tr>								
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
