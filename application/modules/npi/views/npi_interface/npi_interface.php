<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php 
  
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/projects/css/sbe_projects-style.css">

 <style type="text/css">
  


  #searchTable {
    /*background: url('<?php echo base_url(); ?>assets/frontend/projects/img/searchicon.png') !important;*/
    background: url('<?php echo base_url(); ?>assets/frontend/projects/img/searchicon.png');
    background-size: 21px 21px;
    background-position: 5px 5px;
    background-repeat: no-repeat;
    width: 200px;
    margin-bottom: 10px;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
  }

  .select2 {
    width: 100%;
  }

  .datepicker {
    z-index:1151 !important;
  }

  .modal-close-btn {
    margin-bottom: 0 !important;
  }

  .container2 {
    width: 100% !important;
  }

  .title a {
    font-size: 20px;
  }


 </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php ?>
    
<!-- Content Header (Page header) -->
<br>
  <!-- Main content -->
    <?php if(isset($_POST['status'])){ ?>
        <div class="container2">
          <div class="callout <?php echo ($_POST['status']=="success") ? " callout-info " : " callout-warning "; ?>" >
            <button aria-hidden="true" data-dismiss="alert" class="close closeCallout" type="button">×</button>
            <h4><?php echo ($_POST['status']=="success") ? "Success!" : "Uh-oh!"; ?> </h4>
            <p>
              <?php echo $_POST['msg']; ?>              
            </p>
          </div> 
        </div>
     <?php } ?>
    <!-- /.content -->
    <?php if(isset($_SESSION['error'])) : ?>
      <div id="file_updated_box">
            <div class="alert alert-warning alert-dismissible file_updated">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <h4><i class="icon fa fa-ban"></i> <?php  echo  $this->session->flashdata('error');?></h4>
            </div>
        </div>
    <?php endif; ?>        

<div class="container2">
  <section class="content-header"> 
    <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">NPI</li>
      </ol>
  </section>
</div>
<!-- Main content -->
  <section class="content">
    
    <div class="row">

        <div class="col-md-12 connectedSortable">
          <div class="col-md-12 container2">
            <div class="panel panel-default">
              <div class="panel-body">
                 <h3>NPI TRACKER</h3>
                 <input class="form-control input-sm datepicker" type="text" id="searchTable" onkeyup="searchTable()" placeholder="Search NPI " title="Type in a name">
                 <a class="btn3d btn icon-btn btn-info" href="#" data-toggle="modal" data-target="#addNewNPI"><span class="glyphicon glyphicon-plus"></span>Add NPI</a>
                 <button class="btn3d btn icon-btn btn-info" onclick="deleteProject();"><i class="glyphicon btn-glyphicon glyphicon-erase"></i> Delete Selected</button>
                 
                 <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-filter" data-target="all">All NPI Projects</button>
                    <button type="button" class="btn btn-success btn-filter" data-target="open">Open NPIs</button>
                    <button type="button" class="btn btn-warning btn-filter" data-target="on-hold">On-Hold NPIs</button>
                    <button type="button" class="btn btn-danger btn-filter" data-target="closed">Certified completed NPIs</button>
                    <button type="button" class="btn bg-purple btn-filter" data-target="awaiting-confirmation">closed(awaiting confirmation)</button>
                    
                  </div>
                </div>

                <div class="table-container">
                  <table class="table table-filter " id="npiTrackerTable">
                    <tbody>
                      <?php if(count($npis) < 1): ?>
                        <tr>
                          <td>No Record found</td>
                        </tr>
                      <?php else: ?> 
                        <?php $ctr = "1"; ?>
                        <?php foreach($npis as $npi) : ?>
                          <tr data-status="<?php echo $npi->STATUS; ?>" data-id = "<?php echo $npi->NPI_ID; ?>">
                            <td>
                              <div class="ckbox">
                                <input type="checkbox" id="checkbox<?php echo $ctr; ?>">
                                <label for="checkbox<?php echo $ctr; ?>"></label>
                              </div>
                            </td>
                            <td>
                              <a href="javascript:;" class="star">
                                <i class="glyphicon glyphicon-star"></i>
                              </a>
                            </td>
                            
                            <td>
                              <div class="media">
                                <?php $formatedCreationDate = convertDate($npi->CREATION_DATE); ?>
                                <div class="media-body">
                                  <span class="media-meta pull-right"><?php echo $formatedCreationDate; ?></span>
                                  <h4 class="title">
                                    <em>
                                      <a href="<?php echo base_url(); ?>npi/tasks/<?php echo $npi->NPI_ID; ?>"><?php echo $npi->OEM ." - ". $npi->MODEL; ?></a>
                                    </em> 
                                    <span class="pull-right <?php echo $npi->STATUS ?>"><?php echo ucwords($npi->STATUS) ?></span>
                                    <?php $getProgress = getProgress($npi->NPI_ID); ?>
                                    
                                    <?php if ($getProgress->TOTAL > 0 && $npi->STATUS == 'open'): ?>
                                      <div class="pull-right" style="padding-right: 50px;">
                                      
                                        <?php $percentage = floor($getProgress->PERCENTAGE); ?>
                                        <?php $progressColor = getProgressBarColor($percentage); ?>
                                        <div class="progress progress-xs">
                                          <div class="progress-bar progress-bar-success" style="width: <?php echo $percentage; ?>%"></div>
                                        </div>
                                        <span class="badge bg-green"><?php echo $percentage; ?>%</span>
                                      </div>
                                    <?php endif ?>                                    
                                  </h4>
                                  <p class="summary"> Launch Date: <?php echo $npi->LAUNCH_DATE; ?></p>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <?php $ctr++; ?>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>  <!-- row --> 



  </section>
  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addNewNPI">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>+ CREATE NEW NPI </strong></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url(); ?>npi/actions" method="post" autocomplete="off">
          
          <div class="form-group">
            <div class="col-sm-12">
              <label for="inputEmail3" class="col-sm-2">OEM:</label>
              <div class="col-sm-10">
              <select class="form-control select2" type="text"  name="oem" id="oem" style="width: 100%;"  data-placeholder="SELECT OEM" required>
                <option></option>
                <?php foreach($oems as $oem) : ?>
                  <option value="<?php echo $oem['CODE']; ?>"><?php echo $oem['CODE'] ." - " . $oem['OEM']; ?></option>
                <?php endforeach; ?>
              </select>
              </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
              <label for="inputEmail3" class="col-sm-2">MODEL:</label>
              <div class="col-sm-10">
              <select class="form-control select2" type="text"  name="model" id="model" style="width: 100%;"  data-placeholder="SELECT MODEL" required>
                <option></option>
                
              </select>
              </div>
            </div>
        </div>

        
        <div class="form-group">
          <div class="col-sm-12">
            <label class="col-sm-2">LAUNCH DATE:</label>
            <div class="col-sm-10">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control pull-right datepicker" id="launch_date" name="launch_date" type="text" required>
              </div>
            </div>
          </div>
        </div>
        

        <div class="form-group">
          <div class="col-sm-12">
            <label class="col-sm-2">COMMENTS/
            NOTES:</label>
            <div class="col-sm-10">              
              <textarea required rows="10" cols="20" class="form-control" name="comments" id="comments" required/>              
              </textarea>
              <p class="text-yellow"><strong>NOTE:</strong> If you have multiple comments/notes separate them with a '|' character</p>
            </div>
          </div>
        </div>              

      </div>
      <div class="modal-footer">
        <button type="button" class="btn3d btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn3d btn btn-info" name="addNewNPI">Submit</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







<!-- /.content -->
</div>
<!-- /.content-wrapper -->



