<?php defined('BASEPATH') or exit('No direct script access allowed');


class Npi extends BackendController
{
    
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layouts, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();		
		$this->load->model('npi/Npi_model');
		$this->load->library('form_validation');
        $this->data['portalName'] = "NPI Portal";
		// Array of badges who has access to npi interface and npi items
        $this->data['adminAccess'] = ['100081', '100120', '106433'];
        $this->data['managersArray'] = getManagersInfo(array("TECHNICAL", "PRODUCTION"));
        $this->data['managersBadgeArray'] = [];
        foreach ($this->data['managersArray'] as $key => $value) {
            array_push($this->data['managersBadgeArray'], $value['BADGE']);
        }
		if($this->session->has_userdata(PORTAL_NAME.'portal')) {
            $this->data['userName'] = $this->session->userdata(PORTAL_NAME.'uname');
            $this->data['userRole'] = $this->session->userdata(PORTAL_NAME.'role');
            $this->data['userAccount'] = $this->session->userdata(PORTAL_NAME.'account');
            $this->data['userBadge'] = $this->session->userdata(PORTAL_NAME.'badge');
            $this->data['userFName'] = $this->session->userdata(PORTAL_NAME.'fname');
            $this->data['userLName'] = $this->session->userdata(PORTAL_NAME.'lname');
            $this->data['userAccess'] = $this->session->userdata(PORTAL_NAME.'access');     
        } else {
			// If user not logged in create a url in the Session super global so after login in would
			
			session_start();
			$_SESSION['url'] = $_SERVER['REQUEST_URI']; 			
            redirect('login', 'refresh');            
		}
		
    }



    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function index()
    {	        
        $this->template2('npi/home/index', $this->data, true, 'npi/home/js');
    }

    public function npi_interface()
    {
        
        $this->data['npis'] = $this->Npi_model->getNpis();
        $this->data['oems'] = $this->Npi_model->getOEMs();
        $this->template2('npi/npi_interface/npi_interface', $this->data, true, 'npi/npi_interface/js');
    }	

    public function tasks($id){
        
        $this->data['taskAssignedList'] = $this->Npi_model->getTaskAssignedList($id);
        $this->data['taskList'] = $this->Npi_model->getTaskList();
        $this->data['assignees'] = $this->Npi_model->getNpiAssignees(); 
        $this->data['oems'] = $this->Npi_model->getOEMs();
        $this->data['npiDetails'] = $this->Npi_model->getNpiById($id);
        $this->template2('npi/tasks/tasks', $this->data, true, 'npi/tasks/js');
    }

    public function awaiting_confirmation() {
        $this->data['awaiting_confirmation_npi'] = $this->Npi_model->get_awaiting_confirmation_npi();
        $this->template2('npi/awaiting_confirmation/awaiting_confirmation', $this->data, true, 'npi/awaiting_confirmation/js');
    }


    public function add_person() 
    {	
        

        if(isset($_POST['add'])) {
            $date_today = date("Y/m/d");    
            $time_today = date("h:i:s");
            $assignee = explode("-", $_POST['assignee']);
            $data['BADGE'] = $assignee[0];
            $data['FIRST_NAME'] = $assignee[1];
            $data['LAST_NAME'] = $assignee[2];
            $data['CREATED_BY'] = $this->session->userdata(PORTAL_NAME.'uname'); 
            // Checks if Badge and active is in the system
            $condition = "BADGE = '".$data['BADGE']."' and ACTIVE = '1'";

            $checkExists = $this->Npi_model->check_if_value_exists("NPI_ASSIGNEES", $condition);

            if($checkExists) {
               sendMsg("Assignee already exists in the database", "failure" , 'add_person');
            } else {
                // Basically checks if badge is in system and if it is inactive, the logic should just update the active back to 1 and delete the deactivate columns  
                $active_condition = "BADGE = '".$data['BADGE']."'";
                $active_check = $this->Npi_model->check_if_value_exists("NPI_ASSIGNEES", $active_condition);
                if($active_check) {
                    // updates the active to 1 again to reinsert the assignee back into system
                    if($this->Npi_model->activateAssignee($data['BADGE'])) {
                        sendMsg("Assignee reactivated", "success" , 'add_person');
                    }
                } else {
                    // Insert in db
                    if($this->Npi_model->insertAssignee($data)) {
                        sendMsg("Assignee added", "success" , 'add_person');
                    }
                }
                
            }
            
        }        

        // Data for employees that will be used in select dropdown
        $this->data['assignees'] = $this->Npi_model->getAssignees(); 
        $this->data['employees'] = $this->Npi_model->getEmployees();        
        $this->template2('npi/add_person/add_person', $this->data, true, 'npi/add_person/js');    
        
    }


    public function npi_items(){
        
        $this->data['assigneeList'] = $this->Npi_model->getNpiAssignees();
        $this->data['taskList'] = $this->Npi_model->getTaskList();
        $this->data['employees'] = $this->Npi_model->getEmployees();
        $this->data['oems'] = $this->Npi_model->getOEMs();
        $this->template2('npi/npi_items/npi_items', $this->data, true, 'npi/npi_items/js'); 

    }

    public function mytasks(){
        $this->data['myParticipantsTasks'] = $this->Npi_model->getParticipantTasks($this->data['userBadge']);
        $this->data['myTasks'] = $this->Npi_model->getMyTasks($this->data['userBadge']);
        $this->template2('npi/mytasks/mytasks', $this->data, true, 'npi/mytasks/js');
    }

    public function awaitingConfirmation($npi_id) {
        echo "Hello World";
    }

    

    /**
     * [actions description] - this is where crud operation logic is stored
     *     
     */
    public function actions()
    {
        if(!$this->session->has_userdata(PORTAL_NAME.'portal')) {
            session_start();
            $_SESSION['url'] = $_SERVER['REQUEST_URI'];             
            redirect('login', 'refresh'); 
        } else {
            // Where crud operation happens.

            $date_today = date("Y/m/d");    
            $time_now = date("h:i:s");
            $userName = $this->session->userdata(PORTAL_NAME.'uname');

            if(isset($_POST['test'])){
                //echo "Hello " . $username . " " . $date_today . " " . $time_today ;
               
            }

            if (isset($_POST['getDependency'])) {
                $id = $_POST['getDependency'];
                echo json_encode($this->Npi_model->getDependency($id));
                
            }

            if(isset($_GET['test_download'])){
                $data = [];
                $data[0]['qry'] = "SELECT Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
                $data[0]['sheetname'] = "test";
                $report_name = "test";
                generateExcel($data, $report_name);
            }

            if(isset($_GET['test_emailer'])){
               $data = [];
               $data['oem'] = "GG";
               $data['model'] = "TEST";
               $data['task_description'] = "Golden Unit Received"; 
               $data['assigneeEmail'] = 'cnayve@sbe-ltd.ca';
               $data['completion_date'] = '2020/01/01';
               echo sendUpdateNotification($data);                   

            }


            if(isset($_POST['action'])) {
                $badge = $_POST['BADGE'];
                echo $this->Npi_model->deleteAssignee($badge, $userName);
            }

            if(isset($_POST['addNpiTask'])){
                $input = filter_input_array(INPUT_POST);
                $insert_data = [];
                $insert_data['TASK_DESC'] = $input['task'];
                $insert_data['DAYS_TO_COMPLETE'] = $input['dtc'];
                $insert_data['UNAME'] = $userName;
                $insert_data['DATEIN'] = $date_today;
                $insert_data['TIMEIN'] = $time_now;
                $tableName = 'NPI_TASKS';
                $seqColumn = 'task_id';
                $seqName = 'NPI_TASKS_SEQ';
                $query = generateInsertQueryWithSeq($tableName, $insert_data, $seqColumn, $seqName);
                if($this->Npi_model->executeQuery($query)) {
                    sendMsg("Task added successfully", "success",  base_url()."npi/npi_items");
                } 
            }

            if (isset($_POST['task_id']) && $_POST['action'] == 'edit') {
                $input = filter_input_array(INPUT_POST);
                $qry = "UPDATE NPI_TASKS SET
                    TASK_DESC = '{$input['taskDescription']}',
                    DAYS_TO_COMPLETE = '{$input['daysToComplete']}',
                    UPDATED_BY = '{$userName}',
                    UPDATED_DATE = '{$date_today}'
                    WHERE TASK_ID = '{$input['task_id']}'";
                if ($this->Npi_model->executeQuery($qry)) {
                    # code...
                } else {
                    echo json_encode($input);
                }               

            }

            if (isset($_POST['task_id']) && $_POST['action'] == 'delete') {
                $input = filter_input_array(INPUT_POST);

                $qry = "UPDATE NPI_TASKS SET 
                        ACTIVE = '0',
                        USER_DEACTIVATED = '{$userName}',
                        DEACTIVATED_DATE = '{$date_today}',
                        DEACTIVATED_TIME = '{$time_now}'
                        WHERE TASK_ID = '{$input['task_id']}'";
                if ($this->Npi_model->executeQuery($qry)) {
                    # code...
                } else {
                    echo json_encode($input);
                }               
            }

            if (isset($_POST['action']) && isset($_POST['npiAssigneeId']) && $_POST['action'] == 'delete') {
                $input = filter_input_array(INPUT_POST);    
                $qry = "UPDATE NPI_ASSIGNY SET
                        ACTIVE = '0',
                        DEACTIVATED_DATE = '{$date_today}',
                        DEACTIVATED_TIME = '{$time_now}',
                        USER_DEACTIVATED = '{$userName}'
                        WHERE ID = '{$input['npiAssigneeId']}'";
                if ($this->Npi_model->executeQuery($qry)) {
                    # code...
                } else {
                    echo json_encode($input);
                }    
            } 


            if (isset($_POST['addNpiUser'])) {
                $input = filter_input_array(INPUT_POST);
                $assignee = explode("-", $input['assignee']);
                $table = 'NPI_ASSIGNY';
                $conditions = "ID = '{$assignee[0]}'";
                if ($this->Npi_model->check_if_value_exists($table, $conditions)) {
                    $qry = "UPDATE NPI_ASSIGNY SET ACTIVE = '1' WHERE ID = '{$assignee[0]}'";
                    
                    if ($this->Npi_model->executeQuery($qry)) {
                        sendMsg("Npi assignee added", "success", base_url()."npi/npi_items");
                    }
                } else {
                    $data = [];
                    $data['ID'] = $assignee[0];
                    $data['F_NAME'] = $assignee[1];
                    $data['L_NAME'] = $assignee[2];
                    $data['date_cre'] = $date_today;
                    $data['time_cre'] = $time_now;
                    $data['USER_CRE'] = $userName;
                    $data['email'] = $input['email'];
                    $data['login'] = $this->Npi_model->getLogin($assignee[0]);
                    $qry = generateInsertQuery('NPI_ASSIGNY', $data);
                    if ($this->Npi_model->executeQuery($qry)) {
                        sendMsg("Npi assignee added", "success", base_url()."npi/npi_items");
                    }
                }              

            }

            if (isset($_POST['getNpiModels'])) {
                $input = filter_input_array(INPUT_POST);
                $qry = "SELECT modele from modeles where codeconst = '{$input['getNpiModels']}'
                   union
                   (select model as modele from Npi_Models where Artemis_Model is null and linked ='N' and oem = '{$input['getNpiModels']}')";
                $result = getIndexedArray($this->Npi_model->getQueryResult($qry, 'array'));
                echo json_encode($result);
            }

            if (isset($_POST['getNpiNotLinkedModels'])) {
                $input = filter_input_array(INPUT_POST);
                $artemisQuery = "SELECT modele from modeles where codeconst = '{$input['getNpiNotLinkedModels']}'";
                $npiQuery = "SELECT model from Npi_Models where Artemis_Model is null and linked ='N' and oem = '{$input['getNpiNotLinkedModels']}'";
                $artemisResult = $this->Npi_model->getQueryResult($artemisQuery, 'array');
                $npiResult = $this->Npi_model->getQueryResult($npiQuery, 'array');
                $result = array_merge($artemisResult, $npiResult);
                echo json_encode($result);
            }

            if (isset($_POST['createNpiModel'])) {
                $input = filter_input_array(INPUT_POST);
                $data = [];
                $data['oem'] = $input['oem'];
                $data['model'] = $input['newmodel'];
                $data['user_by'] = $userName;
                $data['date_in'] = $date_today;
                $data['time_in'] = $time_now;
                $query = generateInsertQuery('NPI_MODELS', $data);
                if ($this->Npi_model->executeQuery($query)) {
                    sendMsg("Npi model added", "success", base_url()."npi/npi_items");
                }
            }

            if (isset($_POST['replaceNpiModel'])) {

                $input = filter_input_array(INPUT_POST);
               
                // Update npi_projects model into the artemis model
                $updateQuery = "UPDATE NPI_PROJECTS 
                                SET model = '{$input['artemisModel']}'
                                WHERE model = '{$input['npiModel']}'";

                $this->Npi_model->executeQuery($updateQuery);

                $updateQueryB = "UPDATE NPI_MODELS
                                SET ARTEMIS_MODEL = '{$input['artemisModel']}',
                                    LINKED = 'Y',
                                    LINKED_BY = '{$userName}',
                                    LINKED_ON = sysdate
                                    WHERE OEM = '{$input['oem']}' 
                                    AND MODEL = '{$input['npiModel']}'";
                
                if ($this->Npi_model->executeQuery($updateQueryB)) {
                    sendMsg("Npi model linked", "success", base_url()."npi/npi_items");
                }
            }

            if (isset($_POST['getModels'])) {
                $input = filter_input_array(INPUT_POST);
                $qry = "SELECT modele from modeles where codeconst = '{$input['oem']}'
                   union
                   (select model as modele from Npi_Models where Artemis_Model is null and linked ='N' and oem = '{$input['oem']}')";
                $result = getIndexedArray($this->Npi_model->getQueryResult($qry, 'array'));
                echo json_encode($result);
            }

            if (isset($_POST['addNewNPI'])) {
                $input = filter_input_array(INPUT_POST);
                $data = [];
                foreach ($input as $key => $value) {
                    if ($key != 'addNewNPI') {                       
                        if ($key == 'comments') {
                            // Adds | if there is no | in string in order to be separated when shown in view
                            $data[$key] = (stripos($input[$key], '|') !== false) ? trim($input[$key]) : trim($input[$key]);
                            $data[$key] = str_replace("'", "''", $data[$key]);
                        } else {
                            $data[$key] = trim($input[$key]);
                        }
                    }
                }
                $data['NPI_ID'] = str_pad($this->Npi_model->get_next_seq("NPI_PROJECTS_SEQ"), 6, "0", STR_PAD_LEFT);
                $data['created_by'] = $userName;
                $query = generateInsertQuery("NPI_PROJECTS", $data);
                if ($this->Npi_model->executeQuery($query)) {
                    sendMsg("NPI created", "success", base_url()."npi/npi_interface");
                } else {
                    echo $query;
                }
                
            }

            if (isset($_POST['updateNPI'])) {
                $input = filter_input_array(INPUT_POST);
                $comments = trim(str_replace("'", "''", $input['comments'])); // sanitizing comments
                if ($input['status'] == 'closed') {
                    if ($this->sendClosingConfirmation($input['npi_id'])) {
                        sendMsg("NPI Closed", "success", base_url()."npi/npi_interface");
                    }
                } else {
                   $query = "UPDATE NPI_PROJECTS SET
                            LAUNCH_DATE = '{$input['launch_date']}',
                            STATUS = '{$input['status']}',
                            COMMENTS = '{$comments}',
                            UPDATE_DATE = sysdate,
                            UPDATE_BY = '{$userName}'
                            WHERE NPI_ID = '{$input['npi_id']}'";
                    if ($this->Npi_model->executeQuery($query)) {
                        sendMsg("NPI Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                    } 
                }
                
            }

            if (isset($_POST['closeProject'])) {
                $id = $_POST['id'];                
                if ($this->sendClosingConfirmation($id)) {
                    echo "closed";
                } else {
                    echo "not-closed";
                }            
                
            }

            if (isset($_POST['assignTask'])) {
                $input = filter_input_array(INPUT_POST);                
                foreach ($input['task_id'] as $key => $value) {
                    $conditions = "npi_id = {$input['npi_id']} and task_id = {$input['task_id'][$key]} and deleted = '0'";
                    $table = 'NPI_PROJECTS_TASKS';
                    $taskCheck = $this->Npi_model->check_if_value_exists($table, $conditions);
                    if ($taskCheck > 0) {
                       
                       sendMsg("System does not allow duplication of task per project", "failure", base_url()."npi/tasks/" . $input['npi_id']);
                    } else {
                        $data = [];
                        $task_id = $value;
                        //Prepare insert data in data array
                        foreach ($input as $key => $value) {
                            // exclude assignTask 
                            if ($key != 'assignTask') {
                                if ($key == 'task_id') {
                                    $data[$key] = $task_id;                            
                                } elseif ($key == 'participants' || $key == 'dependency') {
                                    $data[$key] = implode(", ", $value);
                                } else {
                                    $data[$key] = $value;
                                }
                            }
                        } // End foreach2 
                        // Generate unique id from oracle db sequence
                        $data['NPI_PROJECTS_TASKS_ID'] = str_pad($this->Npi_model->get_next_seq("NPI_PROJECTS_TASKS_SEQ"), 6, "0", STR_PAD_LEFT);
                        $data['created_by'] = $userName;
                        // Generate insert query
                        $insert_query = generateInsertQuery("NPI_PROJECTS_TASKS", $data);
                        
                        if($this->Npi_model->executeQuery($insert_query)) {
                           // After saving data send notification email to assignee
                           $data['oem'] = $this->Npi_model->getOemById($data['npi_id']); 
                           $data['model'] = $this->Npi_model->getModelById($data['npi_id']);
                           $data['task_description'] = $this->Npi_model->getTaskDescriptionById($data['task_id']); 
                           $data['assigneeEmail'] = $this->Npi_model->getEmailById($data['assignee']);
                           $data['updated_by'] = $userName;
                           
                           if (sendUpdateNotification($data)) {
                               sendMsg("NPI Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                           } 

                           // sendMsg("NPI Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                        }
                    }

                    
                }  // End foreach1          
            }

            if (isset($_POST['updateTask'])) {
                $input = filter_input_array(INPUT_POST);

                $data = [];
                $conditions = [];
                // Sorting through post values to generate query
                foreach ($input as $key => $value) {
                    if ($key !== 'updateTask' ) {
                        if ($key != 'npi_id') {
                            if ($key == 'participants' || $key == 'dependency') {
                            $data[$key] = implode(", ", $value);
                            } elseif ($key == 'npi_projects_tasks_id') {
                                $conditions[$key] = $value;
                            } else {
                                $data[$key] = $value;
                            }
                        }
                        
                    }
                }
                $data['updated_by'] = $userName;
                $updateQuery = generateUpdateQuery2("NPI_PROJECTS_TASKS", $data, $conditions, 'updated_on');
                
                if ($this->Npi_model->executeQuery($updateQuery)) {
                    // If status is set to close
                    // Check if this task is a dependency of another task
                    // Then if so send email notification that this task has been completed and assignee can now do their task
                    if ($input['status'] == 'closed') {
                        $task_id = $input['npi_projects_tasks_id'];
                        $dependents = $this->Npi_model->getDependents($input['npi_id'], $task_id);
                        if (!empty($dependents)) {
                            
                            $task_desc = getTaskDescription($task_id);
                            sendDependencyNotification($dependents, $task_desc);
                            sendMsg("Task Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                        } else {
                          sendMsg("Task Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);  
                        }

                        // sendMsg("Task Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                        
                    } else {
                        sendMsg("Task Updated Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
                    }

                }
            }

            if (isset($_POST['sendNotification'])) {
              $input = filter_input_array(INPUT_POST);
              $taskDetails = $this->Npi_model->getNpiTaskDetails($input['npi_projects_tasks_id']);
              if (sendCustomNotification($input['email'], $input['message'], $taskDetails)) {
                  sendMsg("Reminder Sent Successfully", "success", base_url()."npi/tasks/" . $input['npi_id']);
              }  
            }

            if (isset($_POST['email-updateTask'])) {
                $input = filter_input_array(INPUT_POST);            
                $data = [];
                $conditions = [];
                 // Sorting through post values to generate query
                foreach ($input as $key => $value) {
                    if ($key != 'updateTask') {
                        if ($key == 'npi_projects_tasks_id') {
                            $conditions[$key] = $value;
                        } else {
                            $data[$key] = $value;
                        }
                    }
                }
                $data['updated_by'] = $userName;
                $updateQuery = generateUpdateQuery2("NPI_PROJECTS_TASKS", $data, $conditions, 'updated_on');
                if ($this->Npi_model->executeQuery($updateQuery)) {
                    // If status is set to close
                    // Check if this task is a dependency of another task
                    // Then if so send email notification that this task has been completed and assignee can now do their task
                    if ($input['status'] == 'closed') {
                        $task_id = $input['npi_projects_tasks_id'];
                        $dependents = $this->Npi_model->getDependents($input['npi_id'], $task_id);
                        if (!empty($dependents)) {
                            
                            $task_desc = getTaskDescription($task_id);
                            sendDependencyNotification($dependents, $task_desc);
                            sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
                        } else {
                          sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" ); 
                        }

                        // sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
                        
                    } else {
                        sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
                    }       

                    
                } else {
                    sendMsg("Something went wrong", "failure", base_url()."npi/mytasks/" );
                }

            }

            if (isset($_POST['getAssignedTaskDetails'])) {
                $task_id = $_POST['AssignedTaskId'];
                echo json_encode($this->Npi_model->getAssignedTaskDetails($task_id));
            }

            if (isset($_POST['updateMyTask'])) {
                $input = filter_input_array(INPUT_POST);

                $updateQuery = "UPDATE NPI_PROJECTS_TASKS SET
                                    status = '{$input['status']}',
                                    assignee_comments = '{$input['assignee_comments']}',
                                    on_hold_comments = '{$input['on_hold_comments']}',
                                    customer_affecting = '{$input['customer_affecting']}',
                                    updated_on = sysdate,
                                    updated_by = '{$userName}'
                                WHERE NPI_PROJECTS_TASKS_ID = '{$input['npi_projects_tasks_id']}'";  
                        
                if ($this->Npi_model->executeQuery($updateQuery)) {
                    // If status is set to close                  
                    
                    if ($input['status'] == 'closed') {
                        // Check if this task is a dependency of another task
                        $task_id = $input['npi_projects_tasks_id'];
                        $dependents = $this->Npi_model->getDependents($input['npi_id'], $task_id);
                        
                        if (!empty($dependents)) {
                            // Then if so send email notification that this task has been completed and assignee can now do their task
                            $task_desc = getTaskDescription($task_id);
                            sendDependencyNotification($dependents, $task_desc);
                            sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
                        } else {
                          sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" ); 
                        }

                        // sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" ); 
                        
                    } else {
                        sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
                    }       

                    
                } else {
                    sendMsg("Something went wrong", "failure", base_url()."npi/mytasks/" );
                }
            }

            if (isset($_POST["deleteNpiProject"])) {
                $input = filter_input_array(INPUT_POST);
                $ids = json_decode($input['ids']);
                foreach ($ids as $id) {
                    // Set deletion of npi project
                    $deleteQueryA = "UPDATE NPI_PROJECTS 
                                        SET DELETED = '1',
                                            DELETED_DATE = sysdate,
                                            DELETED_BY = '{$userName}'
                                    WHERE NPI_ID = '{$id}'";                   

                    $this->Npi_model->executeQuery($deleteQueryA);
                    // Delete tasks connected to npi project
                    $deleteQueryB = "UPDATE NPI_PROJECTS_TASKS
                                     SET DELETED = '1',
                                         DELETED_BY = '{$userName}',
                                         DELETED_ON = sysdate
                                     WHERE NPI_ID = '{$id}'";
                    $this->Npi_model->executeQuery($deleteQueryB);
                }
                echo "deleted";
            }

            if (isset($_POST['deleteSelectedAssignedTasks'])) {
                $input = filter_input_array(INPUT_POST);
                $ids = json_decode($input['ids']);
                foreach ($ids as $id) {
                    $deleteQuery = "UPDATE NPI_PROJECTS_TASKS 
                                    SET DELETED = '1',
                                        DELETED_ON = sysdate,
                                        DELETED_BY = '{$userName}'
                                    WHERE NPI_PROJECTS_TASKS_ID = '{$id}'";
                    
                    $this->Npi_model->executeQuery($deleteQuery);
                }
                echo "deleted";
            }
            
        }/* <--  end  -->   */
        
        
        
    } /* <--  actions end  -->   */

    public function email_actions(){
        $userName = $this->session->userdata(PORTAL_NAME.'uname');

        if (isset($_POST['email-updateTask'])) {
            $input = filter_input_array(INPUT_POST);
            prints($input);
            $data = [];
            $conditions = [];
             // Sorting through post values to generate query
            foreach ($input as $key => $value) {
                if ($key != 'updateTask') {
                    if ($key == 'npi_projects_tasks_id') {
                        $conditions[$key] = $value;
                    } else {
                        $data[$key] = $value;
                    }
                }
            }
            $data['updated_by'] = $userName;
            $updateQuery = generateUpdateQuery2("NPI_PROJECTS_TASKS", $data, $conditions, 'updated_on');
            if ($this->Npi_model->executeQuery($updateQuery)) {
                sendMsg("Task Updated Successfully", "success", base_url()."npi/mytasks/" );
            } else {
                sendMsg("Something went wrong", "failure", base_url()."npi/mytasks/" );
            }

        }

        if (isset($_GET['test'])) {
            prints(getParticipantName('106433'));
        }
    }


	
    public function error_500()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/error_500', $this->data, true);
    }

    
  

    /**
     * [blank description]
     *
     * @method blank
     *
     * @return [type] [description]
     */
    public function blank()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/blank', $this->data, true);
    }


     /**
     * Function to send npi projects to awaiting confirmation to be closed to
     * technical manager ,SEBASTIAN OLSZEWSKI and production manager ,
     * MEHMOOD MALIK 
     * @method blank
     *
     * @return [type] [description]
     */
    public function sendClosingConfirmation($id)
    {
        $closeQuery = "UPDATE NPI_PROJECTS
                        SET 
                            STATUS = 'awaiting-confirmation',
                            CLOSED_DATE = sysdate,
                            CLOSED_BY = '{$this->data['userName']}'
                        WHERE NPI_ID = '{$id}'";
        if ($this->Npi_model->executeQuery($closeQuery)) {
            // When NPI Project is closed, close also all the tasks linked connected to the npi_id
            $closeQuery = "UPDATE NPI_PROJECTS_TASKS
                        SET 
                            STATUS = 'closed',
                            UPDATED_ON = sysdate,
                            UPDATED_BY = '{$this->data['userName']}'
                        WHERE NPI_ID = '{$id}'";
            if ($this->Npi_model->executeQuery($closeQuery)) {
                // Send closing confirmation to sebastian and mehmood
                $data = $this->Npi_model->getTasksByNpiId($id);
                if ($this->sendClosingConfirmationEmail($data, $this->data['managersArray'])) {
                    return true;
                } 
                             
            }
        }
        
    }

    /**
     * Using email library to send Closing confirmation email for npi that
     * are ready to be closed. It has to be confirmed by Technical and   
     * production manager.
     * 
     * @method blank
     *
     * @return [type] [description]
     */

    public function sendClosingConfirmationEmail($data, $managersArray) {
        // Load email library
        $this->load->library('email');
        // exporting task data to table for email body
        $taskTableBody = "";
        foreach ($data as $row) {
            $taskTableBody .= "<tr>";
            $taskTableBody .= "<td style='border: 1px solid #ccc; padding: 3px 10px;'>{$row['TASK_DESC']}</td>";
            $taskTableBody .= "<td style='border: 1px solid #ccc; padding: 3px 10px;'>{$row['ASSIGNEENAME']}</td>";
            $taskTableBody .= "<td style='border: 1px solid #ccc; padding: 3px 10px;'>{$row['DEPARTMENT']}</td>";
            $taskTableBody .= "<td style='border: 1px solid #ccc; padding: 3px 10px;'>{$row['STATUS']}</td>";
            $taskTableBody .= "</tr>";
        }        

        foreach ($managersArray as $key => $value) {
            if ($value['DEPARTMENT'] == 'TECHNICAL') {
                $formBody = "<form action='https://portal-ca.sbe-ltd.ca/sbe/actions' method='post' enctype='multipart/form-data' target='_blank' style='margin-bottom: 0;'>
                        <input type='hidden' name='technical_manager_badge' value='{$value['BADGE']}'/>
                        <input type='hidden' name='npi_id' value='{$data[0]['NPI_ID']}'/>
                        <input type='hidden' name='userName' value='{$value['LOGIN']}'/>
                        <input type='hidden' name='department' value='{$value['DEPARTMENT']}'/>
                        <input type='checkbox' id='check1' name='technical_manager_confirmed' value='yes'>

                        <label for='check1' style='display:inline-block;'><h5><strong><u><em>I certify and confirm this NPI is completed and will be closed.</u></em></strong><h5></label><br>

                        <br>
                        <button style='background: #afecff; border: 1px solid #68a5b8; padding: 5px 10px; margin-top: 10px; font-size: 15px; cursor: pointer;' type='submit' name='confirmClose'>Submit
                        </button>
                    </form>
                ";
            } elseif ($value['DEPARTMENT'] == 'PRODUCTION') {
                $formBody = "<form action='https://portal-ca.sbe-ltd.ca/sbe/actions' method='post' enctype='multipart/form-data' target='_blank' style='margin-bottom: 0;'>
                        <input type='hidden' name='production_manager_badge' value='{$value['BADGE']}'/>
                        <input type='hidden' name='npi_id' value='{$data[0]['NPI_ID']}'/>
                        
                        <input type='hidden' name='department' value='{$value['DEPARTMENT']}'/>
                        <input type='hidden' name='userName' value='{$value['LOGIN']}'/>
                        <input type='checkbox' id='check1' name='production_manager_confirmed' value='yes'>
                        <label for='check1' style='display:inline-block;'><h5><strong><u><em>I certify and confirm this NPI is completed and will be closed.</u></em></strong><h5></label><br>

                        <br>
                        <button style='background: #afecff; border: 1px solid #68a5b8; padding: 5px 10px; margin-top: 10px; font-size: 15px; cursor: pointer;' type='submit' name='confirmClose'>Submit
                        </button>
                    </form>
                ";
            }
            
            

            $emailBody = "
                <div class='container' style='width:640px;border-radius:5px;background-color: #f2f2f2;padding: 20px;box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;box-shadow: 5px 5px 5px 0 #888888;margin-top: 6px;margin-bottom: 16px;resize: vertical;'>
                    <h1 style='color:red;'>NPI NOTIFICATION:</h2>
                    <h2 style='color:#337AB7;'><ul>Please confirm that this NPI is completed and ready to be closed.</ul></h2>
                    <table style='width:100%;'>
                        <tr>
                            <th style='width:200px;'></th>
                            <th></th>

                        </tr>
                        <tr>
                            <td><strong>OEM:</strong></td>
                            <td>{$data[0]['OEM']}</td>
                        <tr>
                        <tr>
                            <td><strong>Model:</strong></td>
                            <td>{$data[0]['MODEL']}</td>
                        <tr>
                        <tr>
                            <td><strong>Launch Date:</strong></td>
                            <td>{$data[0]['LAUNCH_DATE']}</td>
                        <tr>
                        
                    </table>
                    <h2 style='color:red;'>TASKS FOR THIS NPI</h2>
                    <table cellspacing='0' cellpadding='0'>
                        <thead style='background: rgb(175, 236, 255);'>
                            <tr>
                                <th style='border: 1px solid #868686; padding: 5px 10px;'>TASK</th>
                                <th style='border: 1px solid #868686; padding: 5px 10px;'>ASSIGNED TO</th>                      
                                <th style='border: 1px solid #868686; padding: 5px 10px;'>DEPARTMENT</th>
                                <th style='border: 1px solid #868686; padding: 5px 10px;'>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$taskTableBody}
                        </tbody>
                    </table>
                    <br>
                    {$formBody}

                  </div>
            <h5>To view all Npi that is awaiting confirmation click <a href='https://portal-ca.sbe-ltd.ca/sbe/npi/awaiting_confirmation'>here</a></h5> <br/>         
            **Do not reply to this email as it is a system generated email<br/> 
                
            ";


            //Sending Email
            $this->email
                ->from('no-reply@sbe-ltd.ca', 'SBE NPI')
                ->to($value['EMAIL'])
                ->cc('aberrio@sbe-ltd.ca', 'cnayve@sbe-ltd.ca')
                ->subject("ATTENTION: NPI awaiting closing confirmation")
                ->message($emailBody)
                ->set_mailtype('html');

            $this->email->send();
        }

        return true;


    }

    
}
