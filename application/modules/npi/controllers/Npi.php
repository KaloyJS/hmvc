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
    	
        $this->template2('npi/home/index', $this->data, true);
               
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

    

    /**
     * [actions description] - this is where various types of actions to be called through  *  ajax
     *     
     */
    public function actions()
    {
        
        $date_today = date("Y/m/d");    
        $time_today = date("h:i:s");
        $username = $this->session->userdata(PORTAL_NAME.'uname');

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

        if(isset($_POST['action'])) {
            $badge = $_POST['BADGE'];
            echo $this->Npi_model->deleteAssignee($badge, $username);
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



    
}
