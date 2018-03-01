<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller
{

    private $_cm;

	public function __construct()
	{
        parent::__construct();
        //load model
        $this->load->model('customer/Customer_model');

        $this->_cm = new Customer_model();
	}

    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"       => "Customer",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> List Customer </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/customer/list.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('customer/index');
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Data Customer",
            "title_page"  => "Create Customer",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> Create Customer </li>",
            "active_page" => "category",
            "css" => array(
                    "assets/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "assets/js/pages/customer/create.js",
                "assets/js/plugins/select2/select2.full.min.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('customer/create');
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

        $result = $this->_cm->get_all_data();
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
        $no_tlp     = $this->input->post('no_tlp');
        $alamat 	= $this->input->post('alamat');
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if($this->form_validation->run() == false) {
            $message['error_msg'] = validation_errors();
        } else {
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "customer_name"    => $name,
                "no_tlp"           => $no_tlp,
                "customer_alamat"  => $alamat
            );
         
            //insert or update
            if($id == "") {
                $result = $this->_cm->insert($arrayToDB);

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
                    $message['redirect_to']     = "/crud_inventory/customer";
                }
            } 
            else {
                //conditions for update
                $conditions = array("customer_id" => $id);

                $result = $this->_dm->update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "Customer has been updated.";
                    $message['redirect_to']     = "/crud_inventory/customer";
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

    
    public function list_select()
    {
    	//must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q    = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();
        if($select_q != "") {
            $filters['nama_kategori'] = $select_q;

        }

        $conditions = array();
        $from = "tbl_kategori";
        //get data.
        $params = $this->_category_model->get_all_data(array(
            "select" => array("kategori_id", "nama_kategori"),
            "from"   => $from,
            "conditions" => $conditions,
            "filter_or" => $filters,
            "count_all_first" => true,
            "limit" => $limit,
            "start" => $start,
            "status" => STATUS_ACTIVE
        ));
        // pr($params);exit;

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        echo json_encode($message);
        exit;
    }
}

/* End of file Customer.php */
/* Location: ./application/modules/customer/controllers/Customer.php */