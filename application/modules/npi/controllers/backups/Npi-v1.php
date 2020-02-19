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
		

		if($this->session->has_userdata(PORTAL_NAME.'portal')) {
			$sbegn_u_name = $this->session->userdata(PORTAL_NAME.'uname');
			$sbegn_role = $this->session->userdata(PORTAL_NAME.'role');
			$sbegn_account = $this->session->userdata(PORTAL_NAME.'account');
			$sbegn_badge = $this->session->userdata(PORTAL_NAME.'badge');
			$sbegn_fname = $this->session->userdata(PORTAL_NAME.'fname');
			$sbegn_lname = $this->session->userdata(PORTAL_NAME.'lname');
			$sbegn_access = $this->session->userdata(PORTAL_NAME.'access');		
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
        $this->data['taskList'] = $this->Npi_model->getTaskList();
        $this->data['assignees'] = $this->Npi_model->getNpiAssignees(); 
        $this->data['oems'] = $this->Npi_model->getOEMs();
        $this->data['npiDetails'] = $this->Npi_model->getNpiById($id);
        $this->template2('npi/tasks/tasks', $this->data, true, 'npi/tasks/js');
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

    

    /**
     * [actions description] - this is where various types of actions to be called through  *  ajax
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

            if(isset($_GET['test_download'])){
                $data = [];
                $data[0]['qry'] = "SELECT Distinct d.Badge,d.First_Name,d.Last_Name from Dir_Indir d where Date_Ins=(select max(Date_Ins) from Dir_Indir) order by d.First_Name ASC";
                $data[0]['sheetname'] = "test";
                $report_name = "test";
                generateExcel($data, $report_name);
            }

            if(isset($_GET['test_emailer'])){
                // load email library
                $this->load->library('email');

                // prepare email
                $this->email
                    ->from('info@example.com', 'Example Inc.')
                    ->to('cnayve@sbe-ltd.ca')
                    ->subject('Hello from Example Inc.')
                    ->message('
                        <html>
                        <head>
                        <title>Birthday Reminders for August</title>
                        </head>
                        <body>
                        <p>Here are the birthdays upcoming in August!</p>
                        <table>
                            <tr>
                            <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
                            </tr>
                            <tr>
                            <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
                            </tr>
                            <tr>
                            <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
                            </tr>
                        </table>
                        </body>
                        </html>
                    ')
                    ->set_mailtype('html');

                // send email
                $this->email->send();               

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
                prints($input);
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
                }
                
            }

            if (isset($_POST['updateNPI'])) {
                $input = filter_input_array(INPUT_POST);
                $comments = trim(str_replace("'", "''", $input['comments'])); // sanitizing comments
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

            if (isset($_POST['close'])) {
                $id = $_POST['id'];
                $query = "UPDATE NPI_PROJECTS SET
                          STATUS = 'closed',
                          UPDATE_DATE = sysdate,
                          UPDATE_BY = '{$userName}'
                          WHERE NPI_ID = '{$id}'";
                if($this->Npi_model->executeQuery($query)) {
                    echo "closed";
                }
            }

            if (isset($_POST['assignTask'])) {
                $input = filter_input_array(INPUT_POST);
                foreach ($input['task'] as $key => $value) {
                    $data = [];
                    $task_id = $value;
                    //Prepare insert data in data array
                    foreach ($input as $key => $value) {
                        // exclude assignTask 
                        if ($key != 'assignTask') {
                            if ($key == 'task') {
                                $data[$key] = $task_id;                            
                            } elseif ($key == 'participants' || $key == 'dependency') {
                                $data[$key] = implode(", ", $value);
                            } else {
                                $data[$key] = $value;
                            }
                        }
                    } // End foreach2 
                    prints($data);
                }  // End foreach1          
            }
            
        }/* <--  end  -->   */
        
        
    } /* <--  actions end  -->   */


	
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



    
}
