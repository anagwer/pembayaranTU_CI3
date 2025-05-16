<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
	public function get_parents() {
		return $this->db->where('role', 'Orang Tua')->get('users')->result();
	}

}
