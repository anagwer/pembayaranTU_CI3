<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('id')) {
            redirect('auth'); // arahkan ke login jika belum login
        }

        $this->load->database();
        $this->load->library('notif_lib');
    }

    public function index() {
        // Ringkasan
        $data['jumlah_siswa_aktif'] = $this->db->where('status', 'Aktif')->count_all_results('siswa');
        $data['jumlah_kelas'] = $this->db->count_all('kelas');

        // Data Pembayaran
        $jenis_list = ['SPP', 'Uang Gedung', 'Kegiatan', 'Ujian'];
        $data['pembayaran_chart'] = [];

        foreach ($jenis_list as $jenis) {
            $sudah = $this->db->where('jenis', $jenis)
                              ->where('tanggal_bayar !=', '0000-00-00')
                              ->count_all_results('pembayaran');

            $belum = $this->db->where('jenis', $jenis)
                              ->where('tanggal_bayar', '0000-00-00')
                              ->count_all_results('pembayaran');

            $data['pembayaran_chart'][] = [
                'jenis' => $jenis,
                'sudah' => $sudah,
                'belum' => $belum
            ];
        }

        // Data Pembayaran Belum Lunas
        $data['belum_lunas'] = $this->db->select('jenis, COUNT(*) as jumlah')
                                        ->where('tanggal_bayar', '0000-00-00')
                                        ->group_by('jenis')
                                        ->get('pembayaran')
                                        ->result();

        // Load View
        $this->load->view('dashboard', $data);
    }
}
