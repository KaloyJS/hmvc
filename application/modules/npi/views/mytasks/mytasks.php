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
               <h3><i class="fa  fa-spinner"></i> My Tasks</h3>
               <input class="form-control input-sm datepicker" type="text" id="searchTable" onkeyup="searchTable()" placeholder="Search Tasks " title="Type in a name">
               <div class="col-md-12">
                 <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-filter" data-target="all">All Tasks</button>
                    <button type="button" class="btn btn-success btn-filter" data-target="open">Open Tasks</button>
                    <button type="button" class="btn btn-warning btn-filter" data-target="on-hold">On-Hold Tasks</button>
                    <button type="button" class="btn btn-danger btn-filter" data-target="closed">Closed Tasks</button>
                    <button type="button" class="btn btn-info btn-filter" data-target="participant">Tasks you participate in</button>
                  </div>
                </div>
               </div>
              
             <div class="secondary-container">
                <div class="table-container">
                <table class="table table-filter table-striped table-bordered table-hover" id="myTasksTable">
                  <thead>
                    <tr> 
                        <th>OEM</th>                       
                        <th>Model</th>
                        <th scope="col">Task Desc</th>
                        <th scope="col">Dept</th>
                        <th scope="col">Assigned to</th>                        
                        <th scope="col">Status</th>
                        <th scope="col">Date to complete</th>
                        <th>Assignee Comments</th>                        
                        <th>On hold comments</th>
                        <th>Dependency</th>
                        <th>participants</th>
                        <th>update</th>                        
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($myTasks as $myTask): ?>
                      <tr data-status="<?php echo $myTask->STATUS; ?>" >
                        <td><?php echo $myTask->OEM; ?></td>
                        <td><?php echo $myTask->MODEL; ?></td>
                        <td><?php echo $myTask->TASK_DESC; ?></td>
                        <td><?php echo $myTask->DEPARTMENT; ?></td>
                        <td><?php echo $myTask->ASSIGNEENAME; ?></td>
                        <td>
                          <span class="label <?php echo getNpiStatusColor($myTask->STATUS); ?>">
                              <em><?php echo $myTask->STATUS; ?></em>
                           </span>
                        </td>
                        <td><?php echo $myTask->COMPLETION_DATE; ?></td>
                        <td>
                            <?php if (!empty($myTask->ASSIGNEE_COMMENTS)): ?>
                              <div class="btn-group" style="width: 200px;margin-bottom:10px">
                                <?php $assigneeComments = explode("|", $myTask->ASSIGNEE_COMMENTS); ?>
                                <button type="button" class="btn btn-info">
                                  my notes/comments
                                </button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu comments-item" role="menu">
                                  
                                  <?php foreach ($assigneeComments as $comments): ?>
                                    <li><a href="#"><?php echo $comments; ?></a></li>
                                  <?php endforeach ?>
                                </ul>
                              </div>
                            <?php endif; ?>
                          </td>
                        <td>
                          <?php if (!empty($myTask->ON_HOLD_COMMENTS)): ?>
                              <?php $onHoldComments = explode("|", $myTask->ON_HOLD_COMMENTS); ?>
                              <div class="btn-group" style="min-width: 100px;margin-bottom:10px">
                                <button type="button" class="btn btn-warning">
                                  <?php echo substr($onHoldComments[0], 0, 5); ?>...
                                </button>
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu comments-item" role="menu">
                                  
                                  <?php foreach ($onHoldComments as $comments): ?>
                                    <li><a href="#"><?php echo $comments; ?></a></li>
                                  <?php endforeach; ?>                  
                                </ul>
                              </div>
                            <?php endif; ?>          
                        </td>
                        <td>
                          <?php if (!empty($myTask->DEPENDENCY)): ?>
                            <?php $dependencies = explode(", ", $myTask->DEPENDENCY); ?>
                            <?php foreach ($dependencies as $d): ?>
                              <li><?php echo getTaskDescription($d); ?></li>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($myTask->PARTICIPANTS)): ?>
                            <?php $participants = explode(", ", $myTask->PARTICIPANTS); ?>           
                            <?php foreach ($participants as $p): ?>
                              <?php $participantName = getParticipantName($p); ?>
                              <button type='button' class='btn3d btn bg-purple btn-owner' data-toggle='tooltip' title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>' data-original-title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>'><?php echo $participantName->F_NAME[0] . $participantName->L_NAME[0];  ?></button>
                            <?php endforeach ?>
                          <?php endif; ?>                          
                        </td>
                        <td>
                          <button type='button' name='updateTask' class='btn3d btn btn-info' data-toggle="modal" data-target="#updateTask" onclick='updateTask("<?php echo $myTask->NPI_PROJECTS_TASKS_ID; ?>")'>
                            <i class='fa fa-refresh'></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                    <?php foreach ($myParticipantsTasks as $pTask): ?>
                      <tr data-status="participant">                     
                        <td><?php echo $pTask->OEM; ?></td>
                        <td><?php echo $pTask->MODEL; ?></td>
                        <td><?php echo $pTask->TASK_DESC; ?></td>
                        <td><?php echo $pTask->DEPARTMENT; ?></td>
                        <td><?php echo $pTask->ASSIGNEENAME; ?></td>
                        <td>
                          <span class="label <?php echo getNpiStatusColor($pTask->STATUS); ?>">
                              <em><?php echo $pTask->STATUS; ?></em>
                           </span>
                        </td>
                        <td><?php echo $pTask->COMPLETION_DATE; ?></td>
                        <td>
                          <?php if (!empty($pTask->ASSIGNEE_COMMENTS)): ?>
                              <div class="btn-group" style="width: 200px;margin-bottom:10px">
                                <?php $assigneeComments = explode("|", $pTask->ASSIGNEE_COMMENTS); ?>
                                <button type="button" class="btn btn-info">
                                  my notes/comments
                                </button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu comments-item" role="menu">
                                  
                                  <?php foreach ($assigneeComments as $comments): ?>
                                    <li><a href="#"><?php echo $comments; ?></a></li>
                                  <?php endforeach ?>
                                </ul>
                              </div>
                            <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($pTask->ON_HOLD_COMMENTS)): ?>
                              <?php $onHoldComments = explode("|", $pTask->ON_HOLD_COMMENTS); ?>
                              <div class="btn-group" style="min-width: 100px;margin-bottom:10px">
                                <button type="button" class="btn btn-warning">
                                  <?php echo substr($onHoldComments[0], 0, 3); ?>...
                                </button>
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu comments-item" role="menu">
                                  
                                  <?php foreach ($onHoldComments as $comments): ?>
                                    <li><a href="#"><?php echo $comments; ?></a></li>
                                  <?php endforeach; ?>                  
                                </ul>
                              </div>
                            <?php endif; ?>          
                        </td>
                        <td>
                          <?php if (!empty($pTask->DEPENDENCY)): ?>
                            <?php $dependencies = explode(", ", $pTask->DEPENDENCY); ?>
                            <?php foreach ($dependencies as $d): ?>
                              <li><?php echo getTaskDescription($d); ?></li>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($pTask->PARTICIPANTS)): ?>
                            <?php $participants = explode(", ", $pTask->PARTICIPANTS); ?>           
                            <?php foreach ($participants as $p): ?>
                              <?php $participantName = getParticipantName($p); ?>
                              <button type='button' class='btn3d btn bg-purple btn-owner' data-toggle='tooltip' title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>' data-original-title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>'><?php echo $participantName->F_NAME[0] . $participantName->L_NAME[0];  ?></button>
                            <?php endforeach ?>
                          <?php endif ?>                          
                        </td>
                        <td>
                          <button type='button' name='updateTask' class='btn3d btn btn-info' data-toggle="modal" data-target="#updateTask" onclick='updateTask("<?php echo $pTask->NPI_PROJECTS_TASKS_ID; ?>")'>
                            <i class='fa fa-refresh'></i>
                          </button>
                        </td>                        
                      </tr>
                    <?php endforeach ?>
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
