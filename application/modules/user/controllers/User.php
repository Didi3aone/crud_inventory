<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {
    private $_User;
    private $_view = 'layout';

	public function __construct() {
		parent::__construct();

		$this->load->model('user/User_model');
		$this->load->library('form_validation');

		$this->_User = new User_model();
	}

	public function index()
	{
		$header = array(
            "title"      => "Login Admin",   
                'css' => array(
                    'assets/css/sweetalert2.css'
            )
        );

        $data = array(
             "title_page" =>  "Login Administrator", 
        );

       $footer = array(
            'js' => array(
                'assets/js/plugins/sweetalert.min.js',
                'assets/js/pages/login.js'
            )
        );
       
        $this->load->view(LAYOUT_LOGIN_HEADER, $header);
        $this->load->view($this->_view.'/login',$data);
        $this->load->view(LAYOUT_LOGIN_FOOTER, $footer);
	}

	public function login() 
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if($this->form_validation->run() == false) {
            $message['error_msg'] = validation_errors();;
        } 
        else {

            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
            
            $user = $this->_User->check_login($username ,$password);
            // print_r($user);exit();

            if ($user) {
            	foreach ($user as $key => $value) {
	                $this->session->set_userdata("user_id",$value['user_id']);
            	}

                $message['is_error']      = false;
                $message['notif_title']   = "Excellent!";
                $message['notif_message'] = "Login succes";
                $message['redirect_to']   = site_url('dashboard');

            } 
            else {
                // Login failed
                $message['error_msg']   = "Username or Password is wrong!";
            }
        }  
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */