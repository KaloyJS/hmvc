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

class Login extends BackendController
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
		$this->load->model('Login_model');
		if($this->session->has_userdata(PORTAL_NAME.'portal')){
		// $newdata = array(
        // PORTAL_NAME.'fname'  => $fname2,
        // PORTAL_NAME.'lname'  => $lname2,
        // PORTAL_NAME.'account'  => $account2,
        // PORTAL_NAME.'role'  => $role2,
        // PORTAL_NAME.'processLine'  => $processLine2,
        // PORTAL_NAME.'uname'  => $user_name2,
        // PORTAL_NAME.'badge'  => $badge2,
        // PORTAL_NAME.'portal'     => PORTAL_NAME,
		// );
		$sbegn_u_name = $this->session->userdata(PORTAL_NAME.'uname');
		$sbegn_role = $this->session->userdata(PORTAL_NAME.'role');
		$sbegn_account = $this->session->userdata(PORTAL_NAME.'account');
		$sbegn_badge = $this->session->userdata(PORTAL_NAME.'badge');
		$sbegn_fname = $this->session->userdata(PORTAL_NAME.'fname');
		$sbegn_lname = $this->session->userdata(PORTAL_NAME.'lname');
		$sbegn_access = $this->session->userdata(PORTAL_NAME.'access');

		header('location: home');
		
			
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
		
		// $this->load->helper('url');
		if(isset($_POST['screen_login'])){
		if(!empty($_POST['screen_login'])){
			$sbe_uname = $_POST['username'];
			$sbe_pass = $_POST['password'];
		
			$data = login($sbe_uname,$sbe_pass);
			// print_r($data);
			if($data == 1){
				// Checking if there is a url set on the Session superglobal
				// If there is then redirect to that url after login if not go to welcome page
				$url = '';
				if(isset($_SESSION['url'])) {
					$url = str_replace('sbe/', '', $_SESSION['url']);

				} else {
					$url = 'welcome';
				} 	
				
				unset($_SESSION['url']);				
				redirect(base_url($url));				

			}elseif($data == 0){
			
				echo "<script type=\"text/javascript\">
				alert('User Not Allowed !');					
				</script>";
				
			}else{
				echo "<script type=\"text/javascript\">
					window.location.href='login';
				</script>";
				
				
			}
		}	
		}
        // Display page with the template function from MY_Controller
		// $data['data'] = $this->Backend_model->get_last_ten_entries();
		// $this->data['data1'] = $this->Login_model->get_last_ten_entries();
		// $this->data['data2'] = 'hello data 2';
		// $this->data['data3'] = $this->Backend_model->get_last_ten_entries();
		// print_r($data);

        $this->template('Login/login', $this->data, false);
    }

   
    public function blank()
    {
        // Display page with the template function from MY_Controller
        $this->template('examples/blank', $this->data, true);
    }
}
