<?php
class Notif_lib {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function get_notifikasi() {
        $username = $this->CI->session->userdata('username');
        if (!$username) return [];

        $siswa = $this->CI->db->query("
            SELECT * FROM siswa
            WHERE ? LIKE CONCAT('%', nis, '%')
            LIMIT 1
        ", [$username])->row();

        if ($siswa) {
            return $this->CI->db
                ->where('id_siswa', $siswa->id)
                ->where('is_read', 0)
                ->order_by('created_at', 'DESC')
                ->limit(5)
                ->get('notifikasi')
                ->result();
        }

        return [];
    }
}
