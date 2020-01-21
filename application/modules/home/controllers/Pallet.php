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

class Pallet extends BackendController
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
		$this->load->model('Pallet_model');
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
		$this->data['palletdata'] = palletcount();
		$this->data['palletdata']['manual_insert'] = $this->Pallet_model->get_manual_pallet();
		// prints($this->data['palletdata']);
        $this->template('home/pallet/pallet', $this->data, true);
    }
	
	public function addbox()
    {
		// echo 'fw'.$this->sbegn_badge;
		// echo 'fw'.$this->sbegn_account;
		$this->data['palletdata']['manual_insert'] = $this->Pallet_model->get_manual_pallet();
		// $this->data['palletdata']['manual_insert'] = palletcount();
        $this->template('home/box/addbox', $this->data, true);
    }
	public function editbox($id)
    {
		// echo 'fw'.$this->sbegn_badge;
		// echo 'fw'.$this->sbegn_account;
		$this->data['palletdata'] = $this->Pallet_model->get_manual_pallet_by_id($id);
        $this->template('home/box/editbox', $this->data, true);
    }
	
	public function savebox()
    {

		
			$this->form_validation->set_rules('box', 'box', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('addbox'));

			}
			else
			{
				$config['allowed_types']        = 'pdf|PDF';
				$config['upload_path']          = './uploads/parts/';
			$upload_data = do_upload('partsfile',$config);
			// prints($upload_data);
				if(isset($upload_data) && count($upload_data) > 0){
					$data['file_name'] = $upload_data['file_name'];
					$data['full_path'] = $upload_data['full_path'];
					$type =  $_POST['type'];
					if($type == '-'){
						$data['box'] = $type.$_POST['box'];
					}else{
						$data['box'] = $_POST['box'];
					}
					
					$data['sbegn_badge'] = $this->sbegn_badge;
					$insert = $this->Pallet_model->insert_box($data);
					if($insert){
						sendMsg('Data insert Successfully','success','addbox');
			
					}else{
						sendMsg('Sorry unable to update data','error','addbox');
					}	
				}else{
					sendMsg('Sorry unable to update data','error','addbox'); 
					 // $this->session->set_flashdata('error', 'Unable to upload data Please try again');

				  // redirect(base_url('addbox'));
					
				}
			}
	
		// $this->data['palletdata'] = palletcount();
        // $this->template('home/box/addbox', $this->data, true);
    }
	public function updatebox($id)
    {

		
			$this->form_validation->set_rules('box', 'box', 'required');


			if ($this->form_validation->run() == FALSE)
			{
		    $std = validation_errors(); //just uncomment this part, this should work
        
        $this->session->set_flashdata('error', $std);

			  redirect(base_url('../editbox/'.$id));

			}
			else
			{
				if($_FILES['partsfile'] && $_FILES['partsfile']['name'] !='' && $_FILES['partsfile']['size'] > 0){
				$config['allowed_types']        = 'pdf|PDF';
				$config['upload_path']          = './uploads/parts/';
				$upload_data = do_upload('partsfile',$config);
				 if(isset($upload_data) && count($upload_data) > 0){
				$data['FILE_NAME'] = $upload_data['file_name'];
				$data['PATH_LIST_PARTS'] = $upload_data['full_path'];
				  }else{
					sendMsg('Sorry unable to update data','error','../editbox/'.$id); 
					}
			
				}
			
			// prints($_FILES['partsfile']);
			// EXIT();
				// if(isset($upload_data) && count($upload_data) > 0){
					
					$type =  $_POST['type'];
					if($type == '-'){
						$data['QTY_BOX'] = $type.$_POST['box'];
					}else{
						$data['QTY_BOX'] = $_POST['box'];
					}
					
					$data['UPLOADED_BY'] = $this->sbegn_badge;
					$data['APPROVED'] = '';
					$data['APPROVED_BY'] = '';
					$data['APPROVED_ON'] = '';
					
					$insert = $this->Pallet_model->update_box($data,$id);
					if($insert){
						sendMsg('Data Updated Successfully','success','../addbox');
			
					}else{
						sendMsg('Sorry unable to update data','error','../editbox/'.$id);
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
