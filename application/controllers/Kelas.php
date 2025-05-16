<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['kelas'] = $this->Kelas_model->get_all();
        $this->load->view('kelas_view', $data);
    }

    public function add() {
        $data = [
            'nama_kelas'    => $this->input->post('nama_kelas'),
            'tahun_ajaran'  => $this->input->post('tahun_ajaran'),
            'status'        => $this->input->post('status'),
        ];
        $this->Kelas_model->insert($data);
        redirect('kelas');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'nama_kelas'    => $this->input->post('nama_kelas'),
            'tahun_ajaran'  => $this->input->post('tahun_ajaran'),
            'status'        => $this->input->post('status'),
        ];
        $this->Kelas_model->update($id, $data);
        redirect('kelas');
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->Kelas_model->delete($id);
        redirect('kelas');
    }
}
