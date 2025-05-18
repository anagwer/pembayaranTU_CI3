<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get_all() {
		return $this->db
			->select('notifikasi.*, siswa.nis, siswa.nama') 
			->from('notifikasi')
			->join('siswa', 'siswa.id = notifikasi.id_siswa') 
			->order_by('notifikasi.created_at', 'DESC')
			->get()
			->result();
	}

    public function insert($data) {
        return $this->db->insert('notifikasi', $data);
    }

    public function get_by_siswa($id_siswa) {
		return $this->db
			->select('notifikasi.*, siswa.nis, siswa.nama') 
			->from('notifikasi')
			->join('siswa', 'siswa.id = notifikasi.id_siswa') 
			->where('notifikasi.id_siswa', $id_siswa)
			->order_by('notifikasi.created_at', 'DESC')
			->get()
			->result();
	}


    public function mark_as_read($id) {
        return $this->db
            ->where('id', $id)
            ->update('notifikasi', ['is_read' => 1]);
    }

    public function delete($id) {
        return $this->db
            ->where('id', $id)
            ->delete('notifikasi');
    }

    public function delete_by_siswa($id_siswa) {
        return $this->db
            ->where('id_siswa', $id_siswa)
            ->delete('notifikasi');
    }
}
