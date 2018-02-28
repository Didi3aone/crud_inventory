<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
     
    private $_table = 'user';
    private $_table_aliases = 'u';
    private $_pk_field = 'user_id';
    
    public function __construct() {
    	parent::__construct();
    }
	
    public function get() {
    	$this->db->select('*');
    	$this->db->from($this->_table);
    	$res = $this->db->get();

    	return $res->result_array();
    }

    public function check_login($user, $pass) {
    	$this->db->where('user_name', $user);
    	$this->db->where('user_password', $pass);
        $this->db->from($this->_table);

    	$res = $this->db->get();
    	return $res->result_array();
    }
}

/* End of file User_model.php */
/* Location: ./application/modules/user/models/User_model.php */