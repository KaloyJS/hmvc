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

class Logout extends BackendController
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
        // $CI =& get_instance();
			if($this->session->has_userdata(PORTAL_NAME.'portal')){
		
		$array_items = array(PORTAL_NAME.'fname', PORTAL_NAME.'lname',PORTAL_NAME.'account', PORTAL_NAME.'role', PORTAL_NAME.'processLine', PORTAL_NAME.'uname', PORTAL_NAME.'badge', PORTAL_NAME.'portal');

		// print_r($array_items);
		$this->session->unset_userdata($array_items);
		// $ci->session->set_userdata($newdata);
			header('location: login');
			
		}else{
			header('location: login');
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
		// header('location: login');

       

        // $this->template('Login/login', $this->data, false);
    }

   
    public function blank()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/blank', $this->data, true);
    }
}
