<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	private $_pr;

	public function __construct()
	{
        parent::__construct();
        //load model
        $this->load->model('produk/Produk_model');

        $this->_pr = new Produk_model();
	}

    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"       => "produk",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> List produk </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/produk/list.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('produk/index');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Data produk",
            "title_page"  => "Create produk",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Create produk </li>",
            "active_page" => "category",
            "css" => array(
                    "assets/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "assets/js/pages/produk/create.js",
                "assets/js/plugins/select2/select2.full.min.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('produk/create');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function edit($id = null)
    {

        $data['item'] = $this->Produk_model->get_all_data(array('id' => $id));
        // var_dump($data['item']);
        
        $header = array(
            "title"       => "transaksi",
            "title_page"  => "Create transaksi",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Create transaksi </li>",
            "active_page" => "category",
            "css" => array(
                    "assets/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "assets/js/pages/transaksi/create.js",
                "assets/js/plugins/select2/select2.full.min.js",
            ),
        );

        //load views
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('produk/create',$data);
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

        $result = $this->_pr->get_all_data();
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

        $id 			= $this->input->post('id');
        $name 			= $this->input->post('name');
        $kategori_id 	= $this->input->post('kategori_id');
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama', 'trim|required');

        if($this->form_validation->run() == false) {
            $message['error_msg'] = validation_errors();
        } else {
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "produk_name"    	 => $name,
                "produk_kategori_id" => $kategori_id
            );
         
            //insert or update
            if($id == "") {
                $result = $this->_pr->insert($arrayToDB);

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
                    $message['redirect_to']     = "/crud_inventory/produk";
                }
            } 
            else {
                //conditions for update
                $conditions = array("produk_id" => $id);

                $result = $this->_pr->update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "produk has been updated.";
                    $message['redirect_to']     = "/crud_inventory/produk";
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function delete()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        // $is_active = $this->input->post('active');

        if(!empty($id)) {
            
            $data = array(
                "find_by_pk" => array($id),
                "count_all_first" => true,
                "status"          => STATUS_ACTIVE,
                "row_array"       => true,
            );
            $this->_category_model->get_all_data($data); 
        
        if($data['total'] == '') {
                show_404();
            } else {
                $this->db->trans_begin();

                $conditions = array('kategori_id' => $id);

                $result  = $this->_category_model->delete($conditions);

                //end transaction.
                if ($this->db->trans_status() === false) {
                    //failed.
                    $this->db->trans_rollback();

                    //failed.
                    $message['error_msg'] = 'database operation failed';

                } else {
                    //success.
                    $this->db->trans_commit();

                    $message['is_error'] = false;
                    $message['error_msg'] = '';

                    //smallbox.
                    $message['notif_title'] = "Done!";
                    $message['notif_message'] = "Category has been deleted.";
                    $message['redirect_to'] = "";
                }
                }
        } else {
            //id is not passed.
            $message['error_msg'] = 'Invalid ID.';
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    
    public function list_select_kategori()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $this->load->model('kategori/Kategori_model');

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['kategori_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->Kategori_model->select_ajax($limit, $start, $conditions);

        // print_r($params);exit;

        $message['page']        = $select_page;
        $message['get']         = $params;
        $message['paging_size'] = $limit;

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

}

/* End of file Produk.php */
/* Location: ./application/modules/produk/controllers/Produk.php */