<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->model('User_model'); 
    }

    public function index() {
        $jenis = $this->input->get('jenis');
        $data['jenis'] = $jenis;
        $data['kelas'] = $this->Kelas_model->get_all();
        $data['pembayaran'] = $this->Pembayaran_model->get_by_jenis($jenis);
        $this->load->view('pembayaran', $data);
    }

    public function add() {
        $id_kelas = $this->input->post('id_kelas');
        $jenis = $this->input->post('jenis');
        $jumlah = $this->input->post('jumlah');
        $created_at = date('Y-m-d H:i:s');

        $siswa_kelas = $this->Siswa_model->get_by_kelas($id_kelas);

        foreach ($siswa_kelas as $siswa) {
            $data = [
                'id_user'       => $this->session->userdata('id_user') ?? 1, // default 1 kalau belum login
                'id_siswa'      => $siswa->id,
                'id_kelas'      => $id_kelas,
                'jenis'         => $jenis,
                'jumlah'        => $jumlah,
                'created_at'    => $created_at
            ];
            $this->Pembayaran_model->insert($data);
        }

        redirect('pembayaran?jenis=' . $jenis);
    }

    public function update() {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');

        $data = [
            'jumlah'        => $this->input->post('jumlah'),
            'tanggal_bayar' => $this->input->post('tanggal_bayar'),
            'keterangan'    => $this->input->post('keterangan'),
        ];

        $this->Pembayaran_model->update($id, $data);
        redirect('pembayaran?jenis=' . $jenis);
    }

    public function delete() {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');

        $this->Pembayaran_model->delete($id);
        redirect('pembayaran?jenis=' . $jenis);
    }
}
