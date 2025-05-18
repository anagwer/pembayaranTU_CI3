<?php
class Pembayaran_model extends CI_Model {

    public function get_by_jenis($jenis) {
        $this->db->select('pembayaran.*, siswa.nama as nama_siswa, kelas.nama_kelas');
        $this->db->from('pembayaran');
        $this->db->join('siswa', 'siswa.id = pembayaran.id_siswa');
        $this->db->join('kelas', 'kelas.id = pembayaran.id_kelas');
        $this->db->where('pembayaran.jenis', $jenis);
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('pembayaran', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('pembayaran');
    }

	public function get_by_id($id) {
		return $this->db->get_where('pembayaran', ['id' => $id])->row();
	}

	public function filter($kelas_id, $from, $to, $jenis) {
		$this->db->select('p.*, s.nama as nama_siswa, k.nama_kelas');
		$this->db->from('pembayaran p');
		$this->db->join('siswa s', 'p.id_siswa = s.id');
		$this->db->join('kelas k', 's.kelas_id = k.id');
		$this->db->where('p.jenis', $jenis);

		if ($kelas_id) {
			$this->db->where('s.kelas_id', $kelas_id);
		}

		if ($from && $to) {
			$this->db->where('p.created_at >=', $from);
			$this->db->where('p.created_at <=', $to);
		}

		return $this->db->get()->result();
	}
	public function get_by_jenis_and_siswa($jenis, $siswa_id) {
    return $this->db
        ->select('pembayaran.*, siswa.nama as nama_siswa, kelas.nama_kelas')
        ->from('pembayaran')
        ->join('siswa', 'siswa.id = pembayaran.id_siswa')
        ->join('kelas', 'kelas.id = siswa.kelas_id')
        ->where('pembayaran.jenis', $jenis)
        ->where('pembayaran.id_siswa', $siswa_id)
        ->get()
        ->result();
}




}
