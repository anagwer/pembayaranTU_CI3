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
}
