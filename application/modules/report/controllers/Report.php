<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('report/Report_model');
	}

	public function list_pengeluaran()
    {
    	$data['item'] = $this->Report_model->get_all_data_pengeluaran();

        $header = array(
            "title"       => "Report Transaksi Pengeluaran",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> List transaksi </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/report/list_pengeluaran.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('report/index_pengeluaran',$data);
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function list_pemasukan()
    {

        $data['item'] = $this->Report_model->get_all_data_pemasukan();

        $header = array(
            "title"       => "Report Transaksi Pemasukan",
            "breadcrumb"  => "<li><a href=''>Home</a></li><li> List transaksi </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "assets/js/plugins/datatables/jquery.dataTables.min.js",
                "assets/js/plugins/datatables/dataTables.tableTools.min.js",
                "assets/js/plugins/datatables/dataTables.bootstrap.min.js",
                "assets/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "assets/js/pages/report/list_pemasukan.js",
            ),
        );
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('report/index_pemasukan',$data);
        $this->load->view(LAYOUT_FOOTER, $footer);
    } 

    public function create()
    {
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
       
        $this->load->view(LAYOUT_HEADER, $header);
        $this->load->view('transaksi/create');
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

        $result = $this->Report_model->get_all_data_pengeluaran();
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

    public function list_all_datas()
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

        $result = $this->Report_model->get_all_data_pemasukan();
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

}

/* End of file Report.php */
/* Location: ./application/modules/report/controllers/Report.php */