<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	private $_table = 'tbl_kategori_produk';
    private $_table_aliases = 'tkp';
    private $_pk_field = 'kategori_produk_id';

	public function __construct() {
		parent::__construct();
	}

	public function get_all_data($params = array()) {
		$this->db->select('*');
		$this->db->from($this->_table);
        
        $res = $this->db->get();
		if(isset($params['id'])) {
            return $res->row_array();
		} else {
			return $res->result_array();
		}
	}

	public function insert($datas) {
		$this->db->insert($this->_table, $datas);
		return $this->db->insert_id();
	}

	public function update($datas, $conditions) {
		return $this->db->update($this->_table, $datas, $conditions);
	}

	public function delete($conditions) {
		return $this->db->delete($this->_table, $conditions);
	}

	public function select_ajax($limit, $start, $condition) {

        $this->db->select('kategori_name,'.$this->_pk_field);
        $this->db->where($condition);
        $this->db->limit($limit, $start);

        return $this->db->get($this->_table)->result_array();
    }

}

/* End of file Kategori_model.php */
/* Location: ./application/modules/kategori/models/Kategori_model.php */