<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<style type="text/css">
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
  <?php  
     prints($taskAssignedList);  
  ?>
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
    <div class="container2">
      <div class="panel panel-default">
        <div class="invoice">
          <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h1 class="page-header">
                  <i class="fa  fa-spinner"></i>NPI DETAILS
                  <button type="button" class="btn3d btn btn-info btn-sm" data-toggle="modal" data-target="#update" style="margin-left: 10px;"><span class="fa fa-edit"></span> Update NPI</button>
                  <button type="button" class="btn3d btn btn-info btn-sm"  onclick="closeNPI('<?php echo $npiDetails->NPI_ID; ?>');"><span class="fa fa-times" ></span> Close</button> 
                  <button type="button" class="btn3d btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#assignTask" onclick='populateDependency("<?php echo $npiDetails->NPI_ID; ?>");'><span class="fa fa-plus"></span> Assign Task</button>    
                </h1>
              </div>
              <!-- /.col -->
            </div>
        <!-- info row -->
          <div class="row">
            <div class="col-md-12">  
              <div class="box-body">
                <h3>
                  OEM:
                  <span class="project-details">
                    <em><?php echo getSpecificManufacturer($npiDetails->OEM); ?></em>
                  </span>
                </h3>
                <hr>
                <h3>
                  Model:
                  <span class="project-details">
                    <em><?php echo $npiDetails->MODEL; ?></em>
                  </span>
                </h3>
                <hr>
                <h3>
                  Date Opened:
                  <span class="project-details">
                    <em><?php echo $npiDetails->CREATION_DATE; ?></em>
                  </span>
                </h3>
                <hr>
                <h3>
                  Status:
                  <span class="project-details label <?php echo getNpiStatusColor($npiDetails->STATUS); ?>">
                    <em><?php echo $npiDetails->STATUS; ?></em>
                  </span>
                </h3>
                <hr>
                <h3>Notes/Comments:</h3>
                <ul class="scope">
                  <?php $comments = explode("|", $npiDetails->COMMENTS); ?>
                  <?php foreach($comments as $comment) : ?>
                    <li><em><?php echo $comment; ?></em></li>
                  <?php endforeach; ?>
                </ul>
                <hr>
                <table class="table table-bordered table-striped" id="dateDetailsTable">
                  <thead> 
                    <tr class="table">
                      <th scope="col">Today date</td>
                      <th scope="col">Launch Date</td>
                      <th scope="col">Days left</td>                        
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php $date_diff = date_difference(date("Y/m/d"), $npiDetails->LAUNCH_DATE); ?>
                      <td><?php echo convertDate(date("Y/m/d")); ?></td>
                      <td><?php echo convertDate($npiDetails->LAUNCH_DATE); ?></td>
                      <td><?php echo $date_diff['days']; ?> day(s)</td>                                    
                    </tr>
                  </tbody>
                </table>
                <hr>
                <h3>
                  Progress:
                 <!--  <span class="project-details">
                    <em><span id="number_of_closed_task">0</span>/<span id="number_of_tasks"><?php echo count($taskAssignedList); ?></span></em>
                  </span> -->
                </h3>
                <div class="col-md-12">
                    <!-- <label>Completion Percentage :</label>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                    </div> -->
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <!-- Info Row -->
          <!-- /.Tasks Panel -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tasks" data-toggle="tab">Tasks</a></li>                  
                    </ul>
                </div>
                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tasks">                   
                      <button type="button" class="btn3d btn btn-info btn-sm" onclick="deleteActivities();"><span class="fa fa-times"></span> Delete Selected</button>
                      <table class="table table-filter table-striped table-bordered table-hover" id="tasksTable">
                          <thead>
                              <tr>
                                  <th scope="col" style="width: 32px;"></th>
                                  <th scope="col">Task Desc</th>
                                  <th scope="col">Dept</th>
                                  <th scope="col">Assigned to</th>
                                  <th>participants</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Date to complete</th>
                                  <th>Assignee Comments</th>
                                  <th>Admin Comments</th>
                                  <th>On hold comments</th>
                                  <th>Dependency</th>
                                  <th>update</th>
                                  <th>Send notification</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $ctr = 0; ?>
                            <?php foreach ($taskAssignedList as $task): ?>
                              <tr>
                                <td>
                                  <div class="ckbox "  >
                                    <input type="checkbox" id="checkbox<?php echo $ctr; ?>">
                                    <label for="checkbox<?php echo $ctr; ?>"></label>
                                  </div>
                                </td>
                                <td><?php echo $task->TASK_DESC; ?></td>
                                <td><?php echo $task->DEPARTMENT; ?></td>
                                <td>
                                  <?php $name = explode(" ",$task->ASSIGNEE_NAME); ?>
                                  <?php echo ucwords(strtolower($name[0])) . ' ' . ucwords(strtolower($name[1])); ?>
                                    
                                </td>
                                <td>
                                  <?php $participants = explode(", ", $task->PARTICIPANTS); ?>           
                                  <?php foreach ($participants as $p): ?>
                                    <?php $participantName = getParticipantName($p); ?>
                                    <button type='button' class='btn bg-purple btn-owner' data-toggle='tooltip' title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>' data-original-title='<?php echo $participantName->F_NAME . " " . $participantName->L_NAME; ?>'><?php echo $participantName->F_NAME[0] . $participantName->L_NAME[0];  ?></button>
                                  <?php endforeach ?>
                                </td>
                                <td>
                                  <span class="label <?php echo getNpiStatusColor($task->STATUS); ?>">
                                    <em><?php echo $task->STATUS; ?></em>
                                  </span>
                                </td>
                                <td><?php echo $task->COMPLETION_DATE; ?></td>
                                <td>
                                  <?php if (!empty($task->ASSIGNEE_COMMENTS)): ?>
                                    <div class="btn-group" style="min-width: 100px;margin-bottom:10px">
                                      <?php $assigneeComments = explode("|", $task->ASSIGNEE_COMMENTS); ?>
                                      <button type="button" class="btn btn-info">
                                        <?php echo substr($assigneeComments[0], 0, 3) ?>
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
                                  <?php if (!empty($task->ADMIN_COMMENTS)): ?>
                                    <?php $adminComments = explode("|", $task->ADMIN_COMMENTS); ?>
                                    <div class="btn-group" style="min-width: 100px;margin-bottom:10px">
                                      <button type="button" class="btn btn-success">
                                        <?php echo substr($adminComments[0], 0, 3) ?>
                                      </button>
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu comments-item" role="menu">
                                        
                                        <?php foreach ($adminComments as $comments): ?>
                                          <li><a href="#"><?php echo $comments; ?></a></li>
                                        <?php endforeach ?>                   
                                      </ul>
                                    </div>
                                  <?php endif; ?>                                
                                </td>
                                <td>
                                  <?php if (!empty($task->ON_HOLD_COMMENTS)): ?>
                                    <?php $onHoldComments = explode("|", $task->ON_HOLD_COMMENTS); ?>
                                    <div class="btn-group" style="min-width: 100px;margin-bottom:10px">
                                      <button type="button" class="btn btn-warning">
                                        <?php echo substr($onHoldComments[0], 0, 3) ?>
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
                                <td></td>
                                <td>
                                  <button class="btn btn-link btn-sm" data-activity-id="<?php echo $activity->ACTIVITY_ID; ?>" data-toggle="modal" data-target="#updateActivity">Update status</button>
                                  <button type='button' name='updateTask' class='btn btn-info' data-toggle="modal" data-target="#updateTask" >
                                    <i class='fa fa-refresh'></i>
                                  </button>
                                </td>
                                <td>
                                  <button type='button' name='sendNotification' class='btn btn-danger updateAct' id='sendNotification'>
                                    <i class='fa fa-bell-o'></i><i class='fa fa-share-square-o'></i>
                                  </button>
                                </td>                                
                              </tr> 
                              <?php $ctr++; ?>                             
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                    </div>                    
                  </div>
                </div>

              </div>
            </div>
          </div>




        </div>
      </div>
    </div>
  </section>

  <!-- Update Npi Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="update">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title" id="updateNpiModalTitle"><i class="fa fa-share-alt-square"></i>Update NPI Details</h2>
          </div>
          <div class="modal-body">
            <form id="updateNpiForm" class="form-horizontal" action="<?php echo base_url(); ?>npi/actions" method="post" autocomplete="off">

              <input type="hidden" name="npi_id" id="npi_id" value="<?php echo $npiDetails->NPI_ID; ?>">
              
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="col-sm-2">LAUNCH DATE:</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                      </div>
                      <input class="form-control pull-right datepicker" id="launch_date" name="launch_date" type="text" value="<?php echo $npiDetails->LAUNCH_DATE; ?>" required>
                    </div>
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
                        <?php if ($status == $npiDetails->STATUS): ?>
                          <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>
                        <?php else: ?>
                          <option value="<?php echo $status; ?>" ><?php echo $status; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <label class="col-sm-2">COMMENTS/
                  NOTES:</label>
                  <div class="col-sm-10">              
                    <textarea required rows="10" cols="20" class="form-control" name="comments" id="comments"  required/><?php echo trim($npiDetails->COMMENTS); ?></textarea>                  
                    <p class="text-yellow"><strong>NOTE:</strong> If you have multiple comments/notes separate them with a '|' character</p>
                    <p class="text-yellow"><strong>NOTE:</strong> Edit the comments/notes you want to edit, remove what you want to remove</p>
                  </div>
                </div>
              </div>

               

              <div class="modal-footer">
                <button type="button" class="btn3d btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn3d btn btn-info" name="updateNPI">Update</button>
              </div>
         </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- Update Npi Modal -->


 

</div>
  <!-- Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="assignTask">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title" id="assingTaskModalTitle"><i class="fa fa-share-alt-square"></i>Assign NPI task</h2>
        </div>
        <div class="modal-body">
          <form id="assingTaskForm" class="form-horizontal" action="<?php echo base_url(); ?>npi/actions" method="post" autocomplete="off">
            <input type="hidden" name="npi_id" value="<?php echo $npiDetails->NPI_ID; ?>">
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">ASSIGN TO:</label>
                <div class="col-sm-10">
                <select class="form-control select2" type="text"  name="assignee" id="assignee" style="width: 100%;"  data-placeholder="SELECT TEAM MEMBER" required>
                  <option></option>
                  <?php foreach ($assignees as $assignee): ?>
                     <option value="<?php echo $assignee['ID']; ?>"><?php echo $assignee['F_NAME'] ." ". $assignee['L_NAME']; ?></option>
                  <?php endforeach; ?>                  
                </select>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">DEPARTMENT:</label>
                <div class="col-sm-10">
                <select class="form-control select2" type="text"  name="department" id="department" style="width: 100%;"  data-placeholder="SELECT DEPARTMENT" required>
                  <option></option>
                  <?php $departments = array("Purchashing", "Finance", "Process", "Data department", "Artemis", "Operations", "Production", "Quality", "Parts", "Technical", "Customer Service", "Training"); ?>
                  <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>                  
                  <?php endforeach; ?>                  
                </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">TASK:</label>
                <div class="col-sm-10">
                <select class="form-control select2" type="text"  name="task_id[]" id="task_id" multiple style="width: 100%;"  data-placeholder="SELECT TASKS" required>
                  <option></option>
                  <?php foreach ($taskList as $task): ?>
                    <option value="<?php echo $task['TASK_ID']; ?>"><?php echo $task['TASK_DESC']; ?></option>                  
                  <?php endforeach ?>                  
                </select>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">COMPLETION DATE:</label>
                <div class="col-sm-10">
                  <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control pull-right datepicker" id="completion_date" name="completion_date" type="text"  required>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">COMMENTS/
                NOTES:</label>
                <div class="col-sm-10">              
                  <textarea rows="10" cols="20" class="form-control" name="admin_comments" id="admin_comments" /></textarea>                  
                  <p class="text-yellow"><strong>NOTE:</strong> If you have multiple comments/notes separate them with a '|' character</p>
                  
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">PARTICIPANTS:</label>
                <div class="col-sm-10">
                <select class="form-control select2" type="text"  name="participants[]" id="participants" style="width: 100%;"  data-placeholder="SELECT PARTICIPANTS"  multiple>
                  <option></option>
                  <?php foreach ($assignees as $assignee): ?>
                     <option value="<?php echo $assignee['ID']; ?>"><?php echo $assignee['F_NAME'] ." ". $assignee['L_NAME']; ?></option>
                  <?php endforeach; ?>                   
                </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">DEPENDENCY:</label>
                <div class="col-sm-10">
                  <select class="form-control select2" type="text"  name="dependency[]" id="dependency" style="width: 100%;"  data-placeholder="SELECT DEPENDENCY TASKS"  multiple>
                    <option></option>                  
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn3d btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
              <button type="submit" class="btn3d btn btn-info" onclick="loading();" name="assignTask">Submit</button>
            </div>
       </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- Modal -->

<!-- update Task modal -->
<!-- Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateActivity">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title" id="addActivityModalLabel">Update Activity</h2>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url(); ?>projects/actions" method="post" autocomplete="off">

           <div class="box-body">
              <dl>
                <dt>Activity Name</dt>
                <dd id="updateActivityName"></dd>
                <dt>Details</dt>
                <dd id="updateActivityDetails"></dd>                            
              </dl>
            </div>
            <input type="hidden" name="activity_id" id="updateActivityID" readonly>
            <input type="hidden" name="project_id" value="<?php echo $project[0]->PROJECT_ID; ?>" readonly>
            
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputEmail3" class="col-sm-2">ASSIGNED TO:</label>
                <div class="col-sm-10">
                <select class="form-control select" type="text"  name="assignee" id="updateActivityAssignee" style="width: 100%;"  data-placeholder="SELECT TEAM MEMBER" required>
                  <option></option>
                  <?php foreach($assigneeList as $assignee) : ?>              
                    <option value="<?php echo $assignee['BADGE']; ?>"><?php echo $assignee['FIRST_NAME']." ".$assignee['LAST_NAME']; ?></option>
                  <?php endforeach; ?>
                </select>
                </div>
              </div>
          </div>

            <div class="form-group">
              <div class="col-sm-12">
                <label class="col-sm-2">STATUS:</label>
                <div class="col-sm-10">
                  <select style="width: 100%;" class="form-control select" name="status" id="updateActivityStatus" required>
                    <option></option>
                    <?php $statusArr = ['to do','work in progress','completed']; ?>
                    <?php foreach($statusArr as $status) : ?>
                      <option value="<?php echo $status ?>" ><?php echo ucwords($status); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn3d btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn3d btn btn-info" name="updateActivity">Update</button>
        </div>
       </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- update Task modal -->   

<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>
  
</script>