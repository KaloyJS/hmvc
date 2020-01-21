<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC-AdminLTE
 *
 * @package    CodeIgniter-HMVC-AdminLTE
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @todo       (description)
 *
 */

class Home extends BackendController
{
    //
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
		$this->load->model('Backend_model');
		$this->load->model('Home_model');
		$this->load->model('Pallet_model');
		$this->load->library('form_validation');
		// $this->load->model('Test_model');
		if($this->session->has_userdata(PORTAL_NAME.'portal')){
		$sbegn_u_name = $this->session->userdata(PORTAL_NAME.'uname');
		$sbegn_role = $this->session->userdata(PORTAL_NAME.'role');
		$sbegn_account = $this->session->userdata(PORTAL_NAME.'account');
		$sbegn_badge = $this->session->userdata(PORTAL_NAME.'badge');
		$sbegn_fname = $this->session->userdata(PORTAL_NAME.'fname');
		$sbegn_lname = $this->session->userdata(PORTAL_NAME.'lname');
		 $sbegn_access = $this->session->userdata(PORTAL_NAME.'access');
	

			
		}else{
			header('location: login');
		}
		
		require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
		require_once APPPATH.'third_party/phpexcel/PHPExcel/Writer/Excel2007.php';

        $this->excel = new PHPExcel(); 
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
		
		$manual_insert = $this->Pallet_model->get_approved_manual_pallet();
		$this->data['hrs'] = $this->Home_model->get_current_month_projects();
		// prints($manual_insert);
		$box_qty = 0;
		foreach($manual_insert as $mi){
			
			$box_qty = $box_qty+$mi['QTY_BOX'] ;
			
		}
		// echo $box_qty;
		$this->data['manual_pallet'] = round($box_qty/15,2);
		 $this->data['palletdata'] = palletcount();
		$this->data['parts'] = count($this->Pallet_model->lessparts());
		 // echo $palletdata['data']
		// echo $this->data['palletdata'] = $palletdata['data'] + $manual_pallet;
        $this->template('home/home/index', $this->data, true);
    }
	
	public function addproject()
    {
		$this->data['projects'] = $this->Home_model->get_all_projects();
		$this->data['users'] = $this->Home_model->get_users();
        $this->template('home/project/index', $this->data, true);
    }
	
	public function projects()
    {
		$this->data['projects'] = $this->Home_model->get_all_projects();
		$this->data['users'] = $this->Home_model->get_users();
        $this->template('home/project/projects', $this->data, true);
    }
	public function partsinfo()
    {
		$this->data['parts'] = $this->Pallet_model->lessparts();
		$this->data['users'] = $this->Home_model->get_users();
        $this->template('home/home/partsinfo', $this->data, true);
    }
	public function stocksinfo()
    {
		$this->data['stock'] = $this->Pallet_model->get_monthlystock();
		$this->data['users'] = $this->Home_model->get_users();
        $this->template('home/home/stockinfo', $this->data, true);
    }

	public function saveproject()
    {
	
	// print_r($_POST);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

			$this->form_validation->set_rules('project', 'project', 'required');
			$this->form_validation->set_rules('taskdesc', 'taskdesc', 'required');
			$this->form_validation->set_rules('user', 'user', 'required');
			$this->form_validation->set_rules('hours', 'hours', 'required');
			$this->form_validation->set_rules('startdate', 'startdate', 'required');
			$this->form_validation->set_rules('enddate', 'enddate', 'required');
			// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			// $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('addproject'));

			}
			else
			{
					// $this->load->view('formsuccess');
			
		$data['PROJECT_ID'] = 'RAZER_PARTS_PROJECT_SEQ.nextval';
		$data['PROJECT_NAME'] = $_POST['project'];
		$data['PROJECT_DESC'] = $_POST['taskdesc'];
		$data['MONITORED_BY'] = $_POST['user'];
		$data['HOURS_COMPLETE'] = $_POST['hours'];
		$data['END_DATE'] = $_POST['enddate'];
		$data['START_DATE'] = $_POST['startdate'];
		
		$insert = $this->Home_model->insert_project($data);
		$this->data['users'] = $this->Home_model->get_users();
		
		if($insert){
			sendMsg('Data insert Successfully','success','addproject');
	
		}else{
			sendMsg('Sorry unable to update data','error','addproject');
			
		}
        // $this->template('home/project/index', $this->data, true);
		}
    }
	
	public function editproject($id)
    {        
		$this->data['projects'] = $this->Home_model->get_project_by_id($id);

		$this->data['users'] = $this->Home_model->get_users();
        $this->template('home/project/editproject', $this->data, true);
    }
	public function updateproject($id)
    {
	
	// print_r($_POST);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

			$this->form_validation->set_rules('project', 'project', 'required');
			$this->form_validation->set_rules('taskdesc', 'taskdesc', 'required');
			$this->form_validation->set_rules('user', 'user', 'required');
			$this->form_validation->set_rules('hours', 'hours', 'required');
			$this->form_validation->set_rules('startdate', 'startdate', 'required');
			$this->form_validation->set_rules('enddate', 'enddate', 'required');
			// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			// $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
			$this->session->set_flashdata('error', $std);
			redirect(base_url('editproject/').$id);
			}
			else
			{// $this->load->view('formsuccess');
			// $data['PROJECT_ID'] = 'RAZER_PARTS_PROJECT_SEQ.nextval';
			$data['PROJECT_NAME'] = $_POST['project'];
			$data['PROJECT_DESC'] = $_POST['taskdesc'];
			$data['MONITORED_BY'] = $_POST['user'];
			$data['HOURS_COMPLETE'] = $_POST['hours'];
			$data['END_DATE'] = $_POST['enddate'];
			$data['START_DATE'] = $_POST['startdate'];
			
			$insert = $this->Home_model->update_project($data,$id);
			$this->data['users'] = $this->Home_model->get_users();
			
			if($insert){
				sendMsg('Data Updated Successfully','success',base_url('addproject'));
		
			}else{
				sendMsg('Sorry unable to update data','error',base_url('editproject/'.$id));
				
			}
			// $this->template('home/project/index', $this->data, true);
		}
    }


    public function error_500()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/error_500', $this->data, true);
    }


    public function blank()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/blank', $this->data, true);
    }
}
