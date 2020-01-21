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

class Brs extends BackendController
{
    //
    public $CI;
	// public $sbegn_u_name;
	// public $sbegn_role;
	// public $sbegn_account;
	// public $sbegn_badge;
	// public $sbegn_fname;
	// public $sbegn_lname;
	// public $sbegn_access;
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
		$this->load->model('Brs_model');
		$this->load->library('form_validation');
		// $this->load->model('Test_model');
		if($this->session->has_userdata(PORTAL_NAME.'portal')){
		$this->sbegn_u_name = $this->session->userdata(PORTAL_NAME.'uname');
		$this->sbegn_role = $this->session->userdata(PORTAL_NAME.'role');
		$this->sbegn_account = $this->session->userdata(PORTAL_NAME.'account');
		$this->sbegn_badge = $this->session->userdata(PORTAL_NAME.'badge');
		$this->sbegn_fname = $this->session->userdata(PORTAL_NAME.'fname');
		$this->sbegn_lname = $this->session->userdata(PORTAL_NAME.'lname');
		$this->sbegn_access = $this->session->userdata(PORTAL_NAME.'access');
	

			
		}else{
			header('location: login');
		}
		// prints($this->session->userdata());
		// echo $this->session->userdata(PORTAL_NAME.'badge');
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
		// $this->data['palletdata'] = palletcount();
		$this->data['details']= $this->Brs_model->getdetails();
		// prints($this->data['details']);
        $this->template('brs/device/details', $this->data, true);
    }
	
	public function adddetails()
    {
        $this->template('brs/device/adddevice', $this->data, true);
    }
	public function editdetails($brs_id)
    {
		// echo 'fw'.$this->sbegn_badge;
		// echo 'fw'.$this->sbegn_account;
		$this->data['details'] = $this->Brs_model->get_manual_device_by_id($brs_id);
        $this->template('brs/device/editdevice', $this->data, true);
    }
	

	public function savedetails()
    {

		// SERIALNUMBER VARCHAR2(200 BYTE),
// DEVICE_MODEL VARCHAR2(200 BYTE),
// DESCRIPTION VARCHAR2(4000 BYTE),
// STORECODE VARCHAR2(200 BYTE),
// INBOUND_WAYBILL VARCHAR2(200 BYTE),
// COSMETIC_GRADE VARCHAR2(200 BYTE),
// FRONT_IMAGE_NAME VARCHAR2(500 BYTE),
// FRONT_IMAGE_FULL_PATH VARCHAR2(2000 BYTE),
// BACK_IMAGE_NAME VARCHAR2(500 BYTE),
// BACK_IMAGE_FULL_PATH VARCHAR2(2000 BYTE)
// BRS_ID CREATED_ON
// CREATED_BY
			$this->form_validation->set_rules('sn', 'sn', 'required');
			$this->form_validation->set_rules('model', 'model', 'required');
			$this->form_validation->set_rules('str_code', 'str_code', 'required');
			$this->form_validation->set_rules('waybill', 'waybill', 'required');
			$this->form_validation->set_rules('cgrade', 'cgrade', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
			
			$this->session->set_flashdata('error', $std);
			redirect(base_url('adddetails'));

			}
			else
			{
				$config['allowed_types']        = 'JPG|jpg|jpeg|JPEG|PNG|png';
				$config['upload_path']          = './uploads/BRS/';
			$upload_data1 = do_upload('frontimage',$config);
			$upload_data = do_upload('backimage',$config);
			// prints($upload_data);
				if(isset($upload_data1) && count($upload_data1) > 0){
					$data['FRONT_IMAGE_NAME'] = $upload_data1['file_name'];
					$data['FRONT_IMAGE_FULL_PATH'] = $upload_data1['full_path'];
				
					
					// $data['sbegn_badge'] = $this->sbegn_badge;
					
				}else{
					sendMsg('Sorry unable to update data','error','adddetails');
					
				}
				if(isset($upload_data) && count($upload_data) > 0){
					$data['BACK_IMAGE_NAME'] = $upload_data['file_name'];
					$data['BACK_IMAGE_FULL_PATH'] = $upload_data['full_path'];
				
					
					// $data['sbegn_badge'] = $this->sbegn_badge;
					
				}else{
					sendMsg('Sorry unable to update data','error','adddetails');
					
				}
				
	
				$data['SERIALNUMBER'] = $_POST['sn'];
				$data['DEVICE_MODEL'] = $_POST['model'];
				$data['DESCRIPTION'] = $_POST['description'];
				$data['STORECODE'] = $_POST['str_code'];
				$data['INBOUND_WAYBILL'] = $_POST['waybill'];
				$data['COSMETIC_GRADE'] = $_POST['cgrade'];
				$data['CREATED_BY'] = $this->sbegn_badge;
				
				$insert = $this->Brs_model->insert_details($data);
					if($insert){
						sendMsg('Data insert Successfully','success','adddetails');
			
					}else{
						sendMsg('Sorry unable to update data','error','adddetails');
					}	
				
				
			}
	
		// $this->data['palletdata'] = palletcount();
        // $this->template('home/box/addbox', $this->data, true);
    }
	public function updatedetails($id)
    {

		
			$this->form_validation->set_rules('sn', 'sn', 'required');
			$this->form_validation->set_rules('model', 'model', 'required');
			$this->form_validation->set_rules('str_code', 'str_code', 'required');
			$this->form_validation->set_rules('waybill', 'waybill', 'required');
			$this->form_validation->set_rules('cgrade', 'cgrade', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('../editdetails/'.$id));

			}
			else
			{

				if($_FILES['frontimage'] && $_FILES['frontimage']['name'] !='' && $_FILES['frontimage']['size'] > 0){
				$config['allowed_types']        = 'JPG|jpg|jpeg|JPEG|PNG|png';
				$config['upload_path']          = './uploads/BRS/';
				$upload_data1 = do_upload('frontimage',$config);
				 if(isset($upload_data1) && count($upload_data1) > 0){
				$data['FRONT_IMAGE_NAME'] = $upload_data1['file_name'];
				$data['FRONT_IMAGE_FULL_PATH'] = $upload_data1['full_path'];
				  }else{
					sendMsg('Sorry unable to update data','error','../editdetails/'.$id); 
					}
			
				}
				
				if($_FILES['backimage'] && $_FILES['backimage']['name'] !='' && $_FILES['backimage']['size'] > 0){
				$config['allowed_types']        = 'JPG|jpg|jpeg|JPEG|PNG|png';
				$config['upload_path']          = './uploads/BRS/';
				$upload_data = do_upload('backimage',$config);
				 if(isset($upload_data) && count($upload_data) > 0){
				$data['BACK_IMAGE_NAME'] = $upload_data['file_name'];
					$data['BACK_IMAGE_FULL_PATH'] = $upload_data['full_path'];
				  }else{
					sendMsg('Sorry unable to update data','error','../editdetails/'.$id); 
					}
			
				}
				$data['SERIALNUMBER'] = $_POST['sn'];
				$data['DEVICE_MODEL'] = $_POST['model'];
				$data['DESCRIPTION'] = $_POST['description'];
				$data['STORECODE'] = $_POST['str_code'];
				$data['INBOUND_WAYBILL'] = $_POST['waybill'];
				$data['COSMETIC_GRADE'] = $_POST['cgrade'];
				$data['UPDATED_BY'] = $this->sbegn_badge;
				$data['UPDATED_ON'] = date('Y-m-d');
					

					$insert = $this->Brs_model->update_details($data,$id);
					if($insert){
						sendMsg('Data Updated Successfully','success','../brs');
			
					}else{
						sendMsg('Sorry unable to update data1','error','../editdetails/'.$id);
					}	
				
			}
	
		// $this->data['palletdata'] = palletcount();
        // $this->template('home/box/addbox', $this->data, true);
    }
	
	public function setapproved(){
			$res = array();
			if(isset($_POST['projectapproved'])){
				
				$data['APPROVED'] = $_POST['projectapproved'];
				$box_id = $_POST['boxid'];
				$data['APPROVED_BY'] = $this->sbegn_badge;
				$insert = $this->Pallet_model->update_approved($data,$box_id);
				// ECHO 'DONE';
				if($insert){
					 $res = 'YES';
					
				}else{
					
					 $res = 'NO';
				}
			}else{
				
					 $res = 'NO';
			}
			
			echo json_encode($res);
			
	}
	
	


   
    /**
     * [error_500 description]
     *
     * @method error_500
     *
     * @return [type]    [description]
     */
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
