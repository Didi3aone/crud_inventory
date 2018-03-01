<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	private $_table = 'tbl_transaksi';
    private $_table_aliases = 'tt';
    private $_pk_field = 'transaksi_id';
      
    public function __construct() {
    	parent::__construct();
    }
	
    
    public function get_all_data_by_id($id = null) {
        
        $this->db->select($this->_table_aliases.'.*, tc.customer_name, tp.produk_name, tp.produk_id, tc.customer_id');
        $this->db->from($this->_table." ".$this->_table_aliases);
        $this->db->join('tbl_customer tc', 'tc.customer_id = '.$this->_table_aliases.'.transaksi_customer_id');
        $this->db->join('tbl_produk tp', 'tp.produk_id = '.$this->_table_aliases.'.transaksi_produk_id');
        $this->db->where($this->_table_aliases.'.transaksi_id', $id);
        
        $res = $this->db->get();
        return $res->row_array();
    }

    public function get_all_data($params = array()) {
        

        $this->db->select($this->_table_aliases.'.*, tc.customer_name, tp.produk_name, tkp.kategori_name');
        $this->db->from($this->_table." ".$this->_table_aliases);
        $this->db->join('tbl_customer tc', 'tc.customer_id = '.$this->_table_aliases.'.transaksi_customer_id');
        $this->db->join('tbl_produk tp', 'tp.produk_id = '.$this->_table_aliases.'.transaksi_produk_id');
        $this->db->join('tbl_kategori_produk tkp', 'tkp.kategori_produk_id = tp.produk_kategori_id', 'left');
        
        $res = $this->db->get();
        if(isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    public function _insert($datas) {
    	$this->db->insert($this->_table, $datas);
    	return $this->db->insert_id();
    }

    public function _update($datas, $conditions) {
    	return $this->db->update($this->_table, $datas, $conditions);
    }

    public function _insert_data($datas) {
    	$this->db->insert('tbl_trans_type', $datas);
    	return $this->db->insert_id();
    }

    public function delete($conditions) {
        return $this->db->delete($this->_table, $conditions);
    }
}

/* End of file Transaksi_model.php */
/* Location: ./application/modules/transaksi/models/Transaksi_model.php */