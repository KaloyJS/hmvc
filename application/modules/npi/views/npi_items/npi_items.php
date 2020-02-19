<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  
  #modelTable th {
    width: 800px !important;
  }

  


</style>
<div class="content-wrapper">
  <?php 
       


  ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >Manage NPI Items <small>CONTROL PANEL</small></h1>

	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard"></i> NPI</a></li>
	  <li class="active">manage NPI</li>
	</ol>
</section>
  
    
<!-- Main content -->
<section class="content">
  <?php if(isset($_POST['status'])) : ?>
        <div class="callout <?php echo ($_POST['status']=="success") ? " callout-info " : " callout-warning "; ?>" >
            <button aria-hidden="true" data-dismiss="alert" class="close closeCallout" type="button">×</button>
            <h4><?php echo ($_POST['status']=="success") ? "Success!" : "Uh-oh!"; ?> </h4>
            <p>
              <?php echo $_POST['msg']; ?>              
            </p>
        </div>   
    <?php endif; ?>
  <div class="row"><!-- row start -->
    
    <div class="col-lg-6"><!-- Add New Task start -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Task</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

        <!-- form start -->
        <div class="box-body">
          <form class="form-horizontal" action="npi/actions" method="post" autocomplete="off">
            <div class="form-group">
              <div class="col-md-12">
                <label for="inputEmail3" class="col-sm-4">Task : </label>
                <div class="col-sm-8">
                <input class="form-control" placeholder="Enter ..." name="task" id="task" autofocus type="text" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="inputEmail3" class="col-sm-4">Days To Complete : </label>
                <div class="col-sm-8">
                <input class="form-control" name="dtc" type="number" max="60" required />
                </div>
              </div>
            </div>

            <div class="box-footer">
                <input type="submit" class="btn btn-info pull-right" name="addNpiTask" value="Submit"/>
            </div>
            </form>
          </div>        
        

      </div>
    </div><!-- Add New Task end -->


    <div class="col-lg-6"><!-- Add New NPI User start -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add New NPI User</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <!-- form start -->
          <form class="form-horizontal" action="npi/actions" method="post" autocomplete="off">          
            <div class="form-group">
              <div class="col-md-12">
                <label for="inputEmail3" class="col-sm-3">User / Assignee : </label>
                <div class="col-sm-9 ">
                  <select class="form-control select2" type="text" id="assignee" name="assignee" data-placeholder="Select..." style='width:100%;' required>   
                    <option></option>
                    <?php foreach($employees as $row) : ?>
                      <?php $employee = $row['BADGE'] . "-" . $row['FIRST_NAME'] . "-" . $row['LAST_NAME']; ?>
                      <option value="<?php echo $employee; ?>"><?php echo $employee; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="col-sm-3">Email : </label>
                <div class="col-sm-9">
                  <input class="form-control" name="email" id="email" type="email" required/>
                </div>
              </div>
            </div>            

            <div class="box-footer">                            
                <input type="submit" class="btn btn-info pull-right" name="addNpiUser" value="Submit"/>
            </div> 
          </form>
        </div>        
        

      </div>
    </div> <!-- Add New NPI User end -->

    <div class="col-lg-6" ><!-- Task List start -->
      <div class="box box-info " id="taskList">
        <div class="box-header with-border">
          <h3 class="box-title">NPI Task List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form method='post' action='actions.php'>
            <table id="taskTable" class="table table-bordered table-striped table_export">
              <thead>
              <tr>
                <th>id</th>
                <th>Task Description</th>
                <th>Days To Complete</th>           
              </tr>
              </thead>
              <tbody>
                <?php foreach($taskList as $task) : ?>
                  <tr>
                    <td><?php echo $task['TASK_ID']; ?></td>
                    <td><?php echo $task['TASK_DESC']; ?></td>
                    <td><?php echo $task['DAYS_TO_COMPLETE'] ?></td>
                  </tr>                        
                <?php endforeach; ?>  
              </tbody>
            </table>
          </form>
        </div>
       </div>
    </div><!-- Task List end -->


    <div class="col-lg-6"><!-- Assignee List start -->
      <div class="box box-info ">
        <div class="box-header with-border">
          <h3 class="box-title">NPI Assignee List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form method='post' action='actions.php'>
           <table id="usersTable" class="table table-bordered table-striped table_export ">
              <thead>
                <tr>
                  <th>Badge No</th>
                  <th>Name</th>                 
                  <th>Email</th>                                      
                </tr>
              </thead>
              <tbody>
                <?php foreach($assigneeList as $assignee) : ?>
                  <tr>
                    <td><?php echo $assignee['ID']; ?></td>
                    <td><?php echo $assignee['F_NAME'] . " " . $assignee['L_NAME']; ?></td>
                    <td><?php echo $assignee['EMAIL']; ?></td>
                  </tr>                        
                <?php endforeach; ?>
              </tbody>
            </table>
          </form>
        </div>
       </div>
    </div><!-- Task List end -->


    <div class="col-md-6"><!-- Add New model start -->
      <div class="box box-info">        
        <div class="box-header with-border">
          <h3 class="box-title">Add New Model</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <form class="form-horizontal" action="npi/actions" method="post" autocomplete="off">        
          <div class="form-group">
            <div class="col-sm-12">
              <label for="oem" class="col-sm-2">OEM :</label>
              <div class="col-sm-10">
              <select class="form-control select2" type="text" ID="oem" name="oem" data-placeholder="Select OEM.." style="width: 100%;" required>
                <option></option>        
                  <?php foreach($oems as $oem) : ?>
                    <option value="<?php echo $oem['CODE']; ?>"><?php echo $oem['OEM']; ?></option>
                  <?php endforeach; ?>
              </select>
              </div>
            </div>
          </div>
    
          <div class="col-sm-12">
            <table id="modelsTable" class="table table-bordered table-striped ">
              
            </table>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label for="newmodel" class="col-sm-2">New Model : </label>
              <div class="col-sm-10">
              <input class="form-control" placeholder="Enter ..." name="newmodel" id="newmodel" autofocus type="text" required />
              </div>
            </div>
          </div>
    
          <!-- /.box-body -->
          <div class="box-footer">                         
            <input type="submit" class="btn btn-info pull-right" name="createNpiModel" value="Submit"/>
          </div>
          <!-- /.box-footer -->
        </form>
        </div>
      </div>
    </div><!-- Add New model end -->

    <div class="col-md-6"><!-- Replace to artemis model start -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Replace To Artemis Model</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="form-horizontal" action="npi/actions" method="post" autocomplete="off">
            <div class="form-group">
              <div class="col-sm-12">
                <label for="oem" class="col-sm-2">OEM :</label>
                <div class="col-sm-10">
                <select class="form-control select2" type="text" ID="oemArtemis" name="oem" style="width:100%;" data-placeholder="Select OEM.." required>
                  <option></option>               
                  <?php foreach($oems as $oem) : ?>
                    <option value="<?php echo $oem['CODE']; ?>"><?php echo $oem['OEM']; ?></option>
                  <?php endforeach; ?>
                </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">Artemis Model :</label>
                <div class="col-sm-10">
                <select type="text" class="form-control select2" name="artemisModel" id="artemisModel" style="width:100%;" required>
                  
                </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">NPI Model :</label>
                <div class="col-sm-10">
                <select type="text" style="width:100%;" class="form-control select2" name="npiModel" id="npiModel" required>
                  
                </select>
                </div>
              </div>
            </div>

            <div class="box-footer">                           
              <input type="submit"  class="btn btn-info pull-right" name="replaceNpiModel" value="Submit"/>
            </div>

          </form>
        </div>
      </div>
    </div><!-- Replace to artemis model end -->

  </div><!-- row end --> 
  <div class="row">
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Set up Admin List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form class="form-horizontal" action="npi/actions" method="post" autocomplete="off">
            

            <div class="box-footer">                           
              <input type="submit"  class="btn btn-info pull-right" name="replaceNpiModel" value="Submit"/>
            </div>

          </form>
        </div>
      </div>



      <div class="box box-info"></div>
    </div>

    

  </div><!-- row end -->



</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

</script>