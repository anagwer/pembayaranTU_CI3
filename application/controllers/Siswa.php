<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model'); // jika butuh data kelas
    }

    public function index() {
		$this->load->model('Kelas_model');
		$this->load->model('User_model');

		$data['siswa'] = $this->Siswa_model->get_all();
		$data['kelas'] = $this->Kelas_model->get_all();
		$data['orangtua'] = $this->User_model->get_parents();

		$this->load->view('siswa', $data);
	}


    public function add() {
        $this->Siswa_model->insert($this->input->post());
        redirect('siswa');
    }

    public function update() {
        $this->Siswa_model->update($this->input->post('id'), $this->input->post());
        redirect('siswa');
    }

    public function delete() {
        $this->Siswa_model->delete($this->input->post('id'));
        redirect('siswa');
    }
}
