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
    }

    public function index() {
        $data['jumlah_kategori'] = $this->db->count_all('pembayaran');
        $data['jumlah_sub_kategori'] = $this->db->count_all('siswa');
        $data['jumlah_anggaran'] = $this->db->count_all('users');
        $data['jumlah_detail_anggaran'] = $this->db->count_all('kelas');

        $this->load->view('dashboard', $data);
    }
}
