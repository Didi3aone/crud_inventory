<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('transaksi/Transaksi_model');
	}

	public function index()
    {

        $header = array(
            "title"       => " List Data Transaksi",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li>  List Data Transaksi </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/transaksi/list.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('transaksi/index');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Create Transaksi",
            "title_page"  => "Create transaksi",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Create Transaksi </li>",
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
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('transaksi/create');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function edit($id = null)
    {

    	$data['item'] = $this->Transaksi_model->get_all_data_by_id($id);
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
        $this->load->view('transaksi/create',$data);
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

        $result = $this->Transaksi_model->get_all_data();
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
        
        $this->load->model('transaksi/Transaksi_model');
        $message['is_error'] = true;

        $id 		= $this->input->post('id');
        $type 		= $this->input->post('type_id');
        $tgl        = $this->input->post('tgl');
        $jml		= $this->input->post('jumlah');
        $hrg  		= $this->input->post('harga');
        // $tot        = $this->input->post('total');
        $cust_id    = $this->input->post('cust_id');
        $prod_id    = $this->input->post('prod_id');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('type_id', 'Transaksi TYpe', 'trim|required');
        $this->form_validation->set_rules('prod_id', 'Produk', 'trim|required');

        if($this->form_validation->run() == false) {
            $message['error_msg'] = validation_errors();
        } else {
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "transaksi_type_id"  => $type,
                "transaksi_tanggal"  => $tgl,
                "jumlah_item"		 => $jml,
                "transaksi_harga"	 => $hrg,
                "transaksi_tanggal"	 => date("Y-m-d H:i:s"),
                "transaksi_customer_id" => $cust_id,
                "transaksi_produk_id"   => $prod_id,
            );
         
            //insert or update
            if($id == "") {
            	
            	$total = ($jml * $hrg);

            	if($type == 1) {
            		$arrayToDB['transaksi_type'] = "Pengeluaran";
            	} else {
            		$arrayToDB['transaksi_type']  = "Pemasukan";
            	}

            	$arrayToDB['total_harga'] = $total;

                $result = $this->Transaksi_model->_insert($arrayToDB);

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
                    $message['redirect_to']     = "/crud_inventory/transaksi";
                }
            } 
            else {
                //conditions for update
                $conditions = array("transaksi_id" => $id);

                $total = ($jml * $hrg);
                if($type == 1) {
            		$arrayToDB['transaksi_type'] = "Pengeluaran";
            	} else {
            		$arrayToDB['transaksi_type']  = "Pemasukan";
            	}

                $result = $this->Transaksi_model->_update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "transaksi has been updated.";
                    $message['redirect_to']     = "/crud_inventory/transaksi";
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function list_select_produk()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $this->load->model('produk/Produk_model');

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['produk_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->Produk_model->select_ajax($limit, $start, $conditions);

        // print_r($params);exit;

        $message['page']        = $select_page;
        $message['get']         = $params;
        $message['paging_size'] = $limit;

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    public function list_select_customer()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $this->load->model('customer/Customer_model');

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['customer_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->Customer_model->select_ajax($limit, $start, $conditions);

        // print_r($params);exit;

        $message['page']        = $select_page;
        $message['get']         = $params;
        $message['paging_size'] = $limit;

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function delete()
    {
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;

        $id = $this->input->post('id');

        if(!empty($id)) {
            $conditions = array("transaksi_id" => $id);
            $delete = $this->Transaksi_model->delete($conditions);

            $message['is_error'] = false;
            $message['notif_title'] = "Transaksi has been deleted";
            $message['redirect_to'] = "";
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

}

/* End of file Transaksi.php */
/* Location: ./application/modules/transaksi/controllers/Transaksi.php */