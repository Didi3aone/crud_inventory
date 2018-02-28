<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	private $_table = 'tbl_customer';
    private $_table_aliases = 'tu';
    private $_pk_field = 'customer_id';

	public function __construct() {
		parent::__construct();
	}

	public function get_all_data($params = array()) {

		if(isset($params['id'])) {
			$this->db->where('customer_id', $params['id']);
		}

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

        $this->db->select('customer_name,'.$this->_pk_field);
        $this->db->where($condition);
        $this->db->limit($limit, $start);

        return $this->db->get($this->_table)->result_array();
    }
}

/* End of file Customer_model.php */
/* Location: ./application/modules/customer/models/Customer_model.php */