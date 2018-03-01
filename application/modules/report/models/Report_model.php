<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	private $_table = 'tbl_transaksi';
    private $_table_aliases = 'tt';
    private $_pk_field = 'transaksi_id';
      
    public function __construct() {
    	parent::__construct();
    }

    public function get_all_data_pengeluaran($params = array()) {
        
        $pengeluaran = 1;

		$this->db->select($this->_table_aliases.'.*, tc.customer_name, tp.produk_name, tkp.kategori_name');
		$this->db->from($this->_table." ".$this->_table_aliases);
		$this->db->join('tbl_customer tc', 'tc.customer_id = '.$this->_table_aliases.'.transaksi_customer_id');
		$this->db->join('tbl_produk tp', 'tp.produk_id = '.$this->_table_aliases.'.transaksi_produk_id');
		$this->db->join('tbl_kategori_produk tkp', 'tkp.kategori_produk_id = tp.produk_kategori_id', 'left');
		$this->db->where($this->_table_aliases.'.transaksi_type_id', $pengeluaran);
        
        $res = $this->db->get();
		if(isset($params['id'])) {
            return $res->row_array();
		} else {
			return $res->result_array();
		}
	}

	public function get_all_data_pemasukan($params = array()) {
        
        $pemasukan = 2;
        
		$this->db->select($this->_table_aliases.'.*, tc.customer_name, tp.produk_name, tkp.kategori_name');
		$this->db->from($this->_table." ".$this->_table_aliases);
		$this->db->join('tbl_customer tc', 'tc.customer_id = '.$this->_table_aliases.'.transaksi_customer_id');
		$this->db->join('tbl_produk tp', 'tp.produk_id = '.$this->_table_aliases.'.transaksi_produk_id');
		$this->db->join('tbl_kategori_produk tkp', 'tkp.kategori_produk_id = tp.produk_kategori_id', 'left');
		$this->db->where($this->_table_aliases.'.transaksi_type_id', $pemasukan);
        
        $res = $this->db->get();
		if(isset($params['id'])) {
            return $res->row_array();
		} else {
			return $res->result_array();
		}
	}
}

/* End of file Report_model.php */
/* Location: ./application/modules/report/models/Report_model.php */