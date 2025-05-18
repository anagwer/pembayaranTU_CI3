<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
	public function get_parents() {
		return $this->db->where('role', 'Orang Tua')->get('users')->result();
	}

    public function get_all() {
        return $this->db->get('users')->result();
    }

    public function insert($data) {
        return $this->db->insert('users', $data);
    }

    public function delete($id) {
        return $this->db->delete('users', ['id' => $id]);
    }

	public function update($id, $data) {
		return $this->db->where('id', $id)->update('users', $data);
	}
	public function is_username_taken($username) {
		return $this->db->get_where('user', ['username' => $username])->num_rows() > 0;
	}

	public function get_by_id($id) {
		return $this->db->get_where('users', ['id' => $id])->row();
	}


}
