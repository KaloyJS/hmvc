<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


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
 .container2 {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    /*margin-right: auto;
    margin-left: auto;*/
  }

  .border {
    border: 1px solid #f4f4f4;
  }

  hr {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0.10), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.10));
  }

  .project-details {
    margin-left: 10px;
    color: #337AB7;
  }

  .scope {
    font-size: 18px;
  }

  #overviewTable {
    
  }

  .progress-bar {
    color: black;
  }

  .modal-close-btn {
    margin-bottom: 0 !important;
  }

  .page-header {
    font-size: 30px !important;
  }

  .comments-item {
    max-height: 400px;
    max-width: 500px;
    overflow-y: auto;
    list-style-type: upper-roman;
    padding: 0;
  }

  .comments-item li {
    border-bottom: 1px solid #ddd;
    padding: 7px 2px 7px 10px;
    list-style-type: decimal;
    list-style-position: inside;
    color: #787878;
  }

  .comments-item > li > a {
    display: inline;
    padding: 3px 4px;
    white-space: unset;
  }

  .modal-backdrop:nth-child(2n-1) {
    opacity : 0;
  }

 

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
  <br>
<!-- Content Header (Page header) -->
  <!-- Main content -->
    <?php if(isset($_POST['status'])) : ?>
      <div class="container2">
        <div class="callout <?php echo ($_POST['status']=="success") ? " callout-info " : " callout-warning "; ?>" >
            <button aria-hidden="true" data-dismiss="alert" class="close closeCallout" type="button">×</button>
            <h4><?php echo ($_POST['status']=="success") ? "Success!" : "Uh-oh!"; ?> </h4>
            <p>
              <?php echo $_POST['msg']; ?>              
            </p>
        </div> 
      </div>
    <?php endif; ?>
    <!-- /.content -->


<!-- Main content -->
  <section class="content">
   <div class="row">
      <div class="col-md-12 connectedSortable">
        <div class="col-md-12 container2">
          <div class="panel panel-default">
            <div class="panel-body">
               <h3><i class="fa  fa-spinner"></i> Awaiting Confirmation</h3>
               
              
             <div class="secondary-container">
                <div class="table-container">
                <table class="table table-filter table-striped table-bordered table-hover" id="npiTable">
                  <thead>
                    <tr> 
                        <th>NPI</th> 
                        <th>Launch Date</th>
                        <th>Status</th>             
                        <th>Confirmed By Technical Manager</th>
                        <th>Confirmed By Production Manager</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($awaiting_confirmation_npi as $row): ?>
                      <tr>
                        <td>
                          <a href="<?php echo base_url(); ?>npi/tasks/<?php echo $row->NPI_ID; ?>"><?php echo $row->OEM ." - ". $row->MODEL; ?></a>
                        </td>
                        <td>
                          <?php echo $row->LAUNCH_DATE; ?>
                        </td>
                        <td>
                          <?php echo $row->STATUS; ?>
                        </td>
                        <td>
                          <?php if ($row->TECHNICAL_MANAGER_CONFIRMED == 'yes'): ?>
                            <table style="width:100%;">
                              <tr>
                                <td>
                                  <strong>Confirmed:</strong>
                                </td>
                                <td>
                                  <?php echo $row->TECHNICAL_MANAGER_CONFIRMED; ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <strong>Confirmed by:</strong>
                                </td>
                                <td>
                                  <?php echo $row->TECHNICAL_MANAGER_NAME; ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <strong>Confirmed On:</strong>
                                </td>
                                <td>
                                  <?php echo $row->TECHNICAL_MANAGER_DATE; ?>
                                </td>
                              </tr>
                          </table>
                          <?php else: ?>
                            <span class="project-details label label-warning">
                              <em>still waiting confirmation</em>
                            </span>                            
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($row->PRODUCTION_MANAGER_CONFIRMED == 'yes'): ?>
                            <table style="width:100%;">
                              <tr>
                                <td>
                                  <strong>Confirmed:</strong>
                                </td>
                                <td>
                                  <?php echo $row->PRODUCTION_MANAGER_CONFIRMED; ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <strong>Confirmed by:</strong>
                                </td>
                                <td>
                                  <?php echo $row->PRODUCTION_MANAGER_NAME; ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <strong>Confirmed On:</strong>
                                </td>
                                <td>
                                  <?php echo $row->PRODUCTION_MANAGER_DATE; ?>
                                </td>
                              </tr>
                          </table>
                          <?php else: ?>
                            <span class="project-details label label-warning">
                              <em>still waiting confirmation</em>
                            </span>                            
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>

  </div>  <!-- row --> 
  </section>

<!---------------------------- Update Npi ------------------------------------->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateTask">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title" id="myModalLabel"><i class="fa  fa-spinner"></i>UPDATE MY TASK</h2>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url(); ?>npi/actions" method="post" autocomplete="off">
            <input type="hidden" name="npi_projects_tasks_id" id = 'npi_projects_tasks_id' >

            <input type="hidden" name="npi_id" id = 'npi_id' >
            
            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">OEM:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="oem"  type="text" readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">MODEL:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="model"  type="text" readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">TASK:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="task"  type="text" readonly>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">DEPARTMENT:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="department"  type="text" readonly>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">DATE TO COMPLETE:</label>
                <div class="col-sm-10">
                  <input class="form-control" id="completion_date"  type="text" readonly>
                </div>
              </div>
            </div>    

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">STATUS:</label>
                <div class="col-sm-10">
                  <select style="width: 100%;" class="form-control select2" name="status" id="status" required>
                    <option></option>
                    <?php $statusArray = ['open', 'on-hold', 'closed']; ?>
                    <?php foreach ($statusArray as $status): ?>
                      <option value="<?php echo $status; ?>" ><?php echo $status; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group" style="display:none;" id="onHoldSelect">
              <div class="col-sm-12">
                <label class="col-sm-2">ON-HOLD COMMENTS/
                NOTES:</label>
                <div class="col-sm-10">              
                  <textarea required rows="10" cols="20" class="form-control" name="on_hold_comments" id="on_hold_comments" /></textarea>                  
                  <p class="text-yellow"><strong>NOTE:</strong> If you have multiple comments/notes separate them with a '|' character</p>
                  <p class="text-yellow"><strong>NOTE:</strong> Edit the comments/notes you want to edit, remove what you want to remove</p>
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">COMMENTS/
                NOTES:</label>
                <div class="col-sm-10">              
                  <textarea rows="10" cols="20" class="form-control" name="assignee_comments" id="assignee_comments" /></textarea>                  
                  <p class="text-yellow"><strong>NOTE:</strong> If you have multiple comments/notes separate them with a '|' character</p>
                  <p class="text-yellow"><strong>NOTE:</strong> Edit the comments/notes you want to edit, remove what you want to remove</p>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">CUSTOMER AFFECTING:</label>
                <div class="col-sm-10">
                  <select style="width: 100%;" class="form-control select2" name="customer_affecting" id="customer_affecting">
                    <option></option>
                    <?php $optionArray = ['yes', 'no']; ?>
                    <?php foreach ($optionArray as $option): ?>
                      <option value="<?php echo $option; ?>" ><?php echo $option; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn3d btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
              <button type="submit" class="btn3d btn btn-info" name="updateMyTask">Update</button>
            </div>                                     

          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!---------------------------- Update Npi ------------------------------------->







<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
 

</script>
