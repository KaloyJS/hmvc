<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .select2 {
    width: 100%;
  }
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >Manage NPI Assignees</h1>
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i> NPI</a></li>
	  <li class="active">Add Person</li>
	</ol>
</section>
  
    
<!-- Main content -->
<section class="content">
  <?php if(isset($_POST['status'])) : ?>
        <div id="file_updated_box">
          <div class="alert <?php echo ($_POST['status']=="success") ? " alert-success " : " alert-danger "; ?> alert-dismissible file_updated">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa <?php echo ($_POST['status']=="success") ? " fa-check" : " fa-ban"; ?>"></i> <?php echo $_POST['msg']; ?></h4>
          </div>
      </div>
    <?php endif; ?>
  <br>
	<div class="row">
      <section class="col-lg-3">
        <div class="box box-info">        
          <div class="box-body">
            <form action="<?php echo base_url(); ?>npi/add_person" method="post" class="form-horizontal" autocomplete="off">
              <div class="form-group">
                <div class="col-md-12">
                  <label>Assignee:</label>
                  <select class="form-control select2" id="assignee" name="assignee">
                    <option></option>
                    <?php foreach($employees as $row): ?>
                      <option value="<?php echo $row['BADGE'] . "-" . $row['FIRST_NAME'] . "-" . $row['LAST_NAME']; ?>"><?php echo $row['BADGE'] . "-" . $row['FIRST_NAME'] . "_" . $row['LAST_NAME']; ?></option>
                    <?php endforeach; ?>                    
                  </select>
                </div>  
              </div>             
                         

              <button type="submit" id="add" name="add" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>

        


      </section>
      <section class="col-md-9">
        <div class="box box-info">
          <div class="box-body dataTables_wrapper dt-bootstrap" >
            <table id="assignee_table" class="table table-striped table-bordered table-hover">
              <thead>
                <th>Badge No.</th>
                <th>First Name</th>
                <th>Last Name</th>                
                <th>Added By</th>
                <th>Added On</th>         
                
              </thead>
              <tbody>
                <?php if(isset($assignees)) : ?>
                  <?php foreach($assignees as $row) : ?>
                    <tr>
                      <td><?php echo $row['BADGE']; ?></td>
                      <td><?php echo $row['FIRST_NAME']; ?></td>
                      <td><?php echo $row['LAST_NAME']; ?></td>
                      <td><?php echo $row['CREATED_BY']; ?></td>
                      <td><?php echo $row['CREATED_ON']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

</script>