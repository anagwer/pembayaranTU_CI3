<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

    public function get_all() {
        return $this->db->get('kelas')->result();
    }

    public function insert($data) {
        return $this->db->insert('kelas', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('kelas', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('kelas');
    }
		public function get_all_aktif() {
				return $this->db->where('status', 'Aktif')->get('kelas')->result();
		}

}
