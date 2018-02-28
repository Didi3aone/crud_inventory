<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = array(
            "title"      => "Dashboard",
            "title_page" => "Dashboard",
            "breadcrumb" => "<li> Dashboard </li>",
            "main"    =>  "admin/dashboard/dashboard"
        );

		$this->load->view(LAYOUT_HEADER);
        $this->load->view('dashboard/index',$data);
        $this->load->view(LAYOUT_FOOTER);
	} 

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */