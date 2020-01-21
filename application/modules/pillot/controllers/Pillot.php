<?php defined('BASEPATH') or exit('No direct script access allowed');


class Pillot extends BackendController
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
		$this->load->model('pillot/Backend_model');
		$this->load->model('pillot/Home_model');
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
		// ob_end_clean(); [UPLOADEDBY] => SAURABH SHARMA

		// echo $this->data['palletdata'] = $palletdata['data'] + $manual_pallet;
		// $seq = $this->Home_model->get_next_seq('PILLOT_PORTAL_TB1_SEQ');
		// prints($seq);
        $this->template('pillot/home/index', $this->data, true);
    }
	
	public function portal1()
    {
		if(isset($_POST['AGENT_NAME']) && $_POST['AGENT_NAME'] != ''){
			$keys = array_keys($_POST);
			foreach($keys as $key){
				if($key != 'newmanfr' && $key != 'newmodel'){
					if($key == 'MAKE'){
						if($_POST['MAKE'] == 'OTHER'){
							$data[$key] = $_POST['newmanfr'];
							
						}else{
							$data[$key] = $_POST[$key];
						}
					}elseif($key == 'MODEL'){
						if($_POST['MODEL'] == 'OTHER'){
							$data[$key] = $_POST['newmodel'];
						}else{
							$data[$key] = $_POST[$key];
						}
					}else{
						$data[$key] = $_POST[$key];
					}
				
				}
				
			}
		
		
			$check = $this->Home_model->check_imei_bbnum($_POST['IMEI_SCREENED'],$_POST['BB_NUMBER'],'PILLOT_PORTAL_TBL1');
			if(isset($check) && count($check) == 0){
			$insert = $this->Home_model->insert_portal1($data);
				if($insert){
				sendMsg('Data inserted Successfully','success','portal1');

				}else{
				sendMsg('Sorry unable to update data','error','portal1');
				}
				
			}else{
					// sendMsg('IMEI or BB Number is already inserted','error','portal1');
					  $this->session->set_flashdata('error', 'IMEI or BB Number is already inserted');
				
			}
			// insert_portal1
		}
		$this->data['manufacturer_list'] = getmanufacturer();
		$this->data['questions'] = $this->Home_model->get_portal_ques('1');
		$this->data['portal'] = 'Manual Screening';
		// $this->data['users'] = $this->Home_model->get_users();
        $this->template('pillot/portal1/portal1', $this->data, true);
    }
	
	public function portal2(){
		if(isset($_POST['AGENT_NAME']) && $_POST['AGENT_NAME'] != ''){
		
			$keys = array_keys($_POST);
			
			foreach($keys as $key){
				if($key != 'newmanfr' && $key != 'newmodel'){
					if($key == 'MAKE'){
						if($_POST['MAKE'] == 'OTHER'){
							$data[$key] = $_POST['newmanfr'];
							
						}else{
							$data[$key] = $_POST[$key];
						}
					}elseif($key == 'MODEL'){
						if($_POST['MODEL'] == 'OTHER'){
							$data[$key] = $_POST['newmodel'];
						}else{
							$data[$key] = $_POST[$key];
						}
					}else{
						$data[$key] = $_POST[$key];
					}
				}
			}
			// prints($data);
			
			$check = $this->Home_model->check_imei_bbnum($_POST['IMEI_SCREENED'],$_POST['BB_NUMBER'],'PILLOT_PORTAL_TBL2');
			if(isset($check) && count($check) == 0){
			$insert =  $this->Home_model->insert_portal2($data);
			 if($insert){
			sendMsg('Data inserted Successfully','success','portal2');
	
				}else{
					sendMsg('Sorry unable to update data','error','portal2');
					
				}
			}else{
					sendMsg('IMEI or BB Number is already inserted','error','portal2');
				
			}
			// insert_portal2
		}
		$this->data['portal'] = 'Pervacio App';
		$this->data['manufacturer_list'] = getmanufacturer();
		$this->data['questions'] = $this->Home_model->get_portal_ques('2');
		// $this->data['users'] = $this->Home_model->get_users();
        $this->template('pillot/portal1/portal1', $this->data, true);
    }

	
    public function downloadreport($portal){
		
		// prints($_POST);
	$startdate = $_POST['startdate'] ;
	$enddate = $_POST['enddate'] ;
	if($portal == 1){
		$table = 'PILLOT_PORTAL_TBL1';
		
	}else{
		$table = 'PILLOT_PORTAL_TBL2';
	}
	// echo $portal;
	$this->Home_model->get_report($startdate,$enddate,$table,$portal);
		     
	}
	
    public function error_500()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/error_500', $this->data, true);
    }

    /**
     * [register description]
     *
     * @method register
     *
     * @return [type]   [description]
     */
  

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
