<?php
class Siswa_model extends CI_Model {
    public function get_all() {
		$this->db->select('siswa.*, kelas.nama_kelas as nama_kelas, kelas.tahun_ajaran');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id = siswa.kelas_id', 'left');
		return $this->db->get()->result();
	}

    public function insert($data) {
        unset($data['id']); // jaga-jaga
        $this->db->insert('siswa', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('siswa', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('siswa');
    }
	public function get_by_kelas($id_kelas) {
		return $this->db->get_where('siswa', ['kelas_id' => $id_kelas])->result();
	}

}
