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

class Welcome extends BackendController
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
		
		$this->load->model('Welcome_model');
		$this->load->library('form_validation');
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
        // $this->template('welcome/welcome/index', $this->data, true);
        $this->template('welcome/welcome/home', $this->data, false);
    }
	

}
