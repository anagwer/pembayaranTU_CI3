<?php
class Siswa_model extends CI_Model {
    public function get_all() {
		$this->db->select('siswa.*, kelas.nama_kelas as nama_kelas, kelas.tahun_ajaran');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id = siswa.kelas_id', 'left');
		return $this->db->get()->result();
	}

	public function get_all_aktif() {
		$this->db->select('siswa.*, kelas.nama_kelas as nama_kelas, kelas.tahun_ajaran');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id = siswa.kelas_id', 'left');
		$this->db->join('users', 'users.username = siswa.nis', 'left'); // Join ke users
		$this->db->where('siswa.status', 'Aktif');
		$this->db->where('users.username IS NULL'); // Hanya ambil siswa yang tidak ada di users
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
		return $this->db->get_where('siswa', [
			'kelas_id' => $id_kelas,
			'status'   => 'Aktif'
		])->result();
	}

	public function get_by_nis($nis) {
		return $this->db->get_where('siswa', ['nis' => $nis])->row();
	}
	public function get_by_id($id) {
		return $this->db->get_where('siswa', ['id' => $id])->row();
	}
	public function filter_siswa($kelas_id = null, $from = null, $to = null) {
		$this->db->select('siswa.*, kelas.nama_kelas, kelas.tahun_ajaran');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id = siswa.kelas_id');

		if ($kelas_id) {
			$this->db->where('siswa.kelas_id', $kelas_id);
		}

		if ($from && $to) {
			$this->db->where('siswa.created_at >=', $from . ' 00:00:00');
			$this->db->where('siswa.created_at <=', $to . ' 23:59:59');
		}

		return $this->db->get()->result();
	}

}
