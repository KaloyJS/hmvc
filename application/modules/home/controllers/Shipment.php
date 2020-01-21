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

class Shipment extends BackendController
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
		$this->load->model('Shipment_model');
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
		$this->data['shipments'] = $this->Shipment_model->get_shipments();
        $this->template('home/shipment/shipment', $this->data, true);
    }
	
	public function addshipment()
    {

		$this->data['shipments'] = $this->Shipment_model->get_shipments();
        $this->template('home/shipment/addshipment', $this->data, true);
    }
	public function editshipment($id)
    {

		$this->data['shipment'] = $this->Shipment_model->get_shipment_by_id($id);
        $this->template('home/shipment/editshipment', $this->data, true);
    }
	public function saveshipment()
    {
			$this->form_validation->set_rules('tracking_number', 'tracking_number', 'required');
			$this->form_validation->set_rules('shipped_from', 'shipped_from', 'required');
			$this->form_validation->set_rules('received_by', 'received_by', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('addshipment'));

			}
			else
			{
			$config['allowed_types']        = 'pdf|PDF';
			$config['upload_path']          = './uploads/shipment/';
			$upload_data = do_upload('packing_slip',$config);
			// prints($upload_data);
				if(isset($upload_data) && count($upload_data) > 0){
					$data['TRACKING_FILE_NAME'] = $upload_data['file_name'];
					$data['TRACKING_FILE_PATH'] = $upload_data['full_path'];
					$data['TRACKING_NUMBER'] = $_POST['tracking_number'];
					$data['SHIPPED_FROM'] = $_POST['shipped_from'];
					$data['RECEIVED_BY'] = $_POST['received_by'];
					$data['UPLOADED_BY'] = $this->sbegn_badge;
					$insert = $this->Shipment_model->insert_shipment($data);
					if($insert){
						sendMsg('Data insert Successfully','success','addshipment');
			
					}else{
						sendMsg('Sorry unable to update data','error','addshipment');
					}	
				}else{
					sendMsg('Sorry unable to update data','error','addshipment'); 
					 // $this->session->set_flashdata('error', 'Unable to upload data Please try again');

				  // redirect(base_url('addbox'));
					
				}
			}
	
		// $this->data['palletdata'] = palletcount();
        // $this->template('home/box/addbox', $this->data, true);
    }
	
	public function updateshipment($id)
    {
			$this->form_validation->set_rules('tracking_number', 'tracking_number', 'required');
			$this->form_validation->set_rules('shipped_from', 'shipped_from', 'required');
			$this->form_validation->set_rules('received_by', 'received_by', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('addshipment'));

			}
			else
			{

			if($_FILES['packing_slip'] && $_FILES['packing_slip']['name'] !='' && $_FILES['packing_slip']['size'] > 0){
				$config['allowed_types']        = 'pdf|PDF';
				$config['upload_path']          = './uploads/shipment/';
				$upload_data = do_upload('packing_slip',$config);
				 if(isset($upload_data) && count($upload_data) > 0){
				$data['TRACKING_FILE_NAME'] = $upload_data['file_name'];
				$data['TRACKING_FILE_PATH'] = $upload_data['full_path'];
				  }else{
					sendMsg('Sorry unable to update data','error','../editshipment/'.$id); 
					}
			
				}
			// prints($upload_data);
			
					// $data['TRACKING_FILE_NAME'] = $upload_data['file_name'];
					// $data['TRACKING_FILE_PATH'] = $upload_data['full_path'];
					$data['TRACKING_NUMBER'] = $_POST['tracking_number'];
					$data['SHIPPED_FROM'] = $_POST['shipped_from'];
					$data['RECEIVED_BY'] = $_POST['received_by'];
					$data['UPLOADED_BY'] = $this->sbegn_badge;
					$insert = $this->Shipment_model->update_shipment($data,$id);
					if($insert){
						sendMsg('Data updated Successfully','success','../addshipment');
			
					}else{
						sendMsg('Sorry unable to update data','error','../editshipment/'.$id);
					}	
				
			}
	
		// $this->data['palletdata'] = palletcount();
        // $this->template('home/box/addbox', $this->data, true);
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
