<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    private $_km;

	public function __construct() {
        parent::__construct();
        $this->load->model('kategori/Kategori_model');

        $this->_km = new Kategori_model();

        $this->load->library('form_validation');
    }
/*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"       => "Kategori Produk",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Kategori Produk </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/kategori/list.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('kategori/index');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Kategori",
            "title_page"  => "Create Kategori",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Create Kategori </li>",
            "active_page" => "category",
            "css" => array(
                    "assets/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "assets/js/pages/kategori/create.js",
                "assets/js/plugins/select2/select2.full.min.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('kategori/create');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function list_all_data()
    {
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        //declare variable here
        $sort_col = $this->input->get("iSortCol_0");
        $sort_dir = $this->input->get("sSortDir_0");
        $limit    = $this->input->get("iDisplayLength");
        $start    = $this->input->get("iDisplayStart");
        $search   = $this->input->get("sSearch");

        //modification query selected

        $result = $this->_km->get_all_data();
        // print_r($result);exit;

        $output = array(
            "aaData" => $result,
            "sEcho"  => intval($this->input->get("sEcho")),
            "iTotalRecords" => $result,
            "iTotalDisplayRecords" => $result,
        );

        //output json encoding
        echo json_encode($output);
    }

    public function proccess_form()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;

        $id 		= $this->input->post('id');
        $name 		= $this->input->post('name');
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama', 'trim|required');

        if($this->form_validation->run() == false) {
            $message['error_msg'] = validation_errors();
        } else {
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "kategori_name"    => $name,
            );
         
            //insert or update
            if($id == "") {
                $result = $this->_km->insert($arrayToDB);

                if ($this->db->trans_status() === FALSE || !$result) {
                    $this->db->trans_rollback();

                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "New category has been added.";
                    $message['redirect_to']     = "/crud_inventory/kategori";
                }
            } 
            else {
                //conditions for update
                $conditions = array("kategori_produk_id" => $id);

                $result = $this->_km->update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "kategori has been updated.";
                    $message['redirect_to']     = "/crud_inventory/kategori";
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}

/* End of file Kategori.php */
/* Location: ./application/modules/kategori/controllers/Kategori.php */