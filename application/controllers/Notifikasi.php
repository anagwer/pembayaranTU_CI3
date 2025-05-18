<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Notifikasi_model');
        $this->load->helper('url');
				$this->load->library('notif_lib');
  }

	public function index() {
			$role = $this->session->userdata('role');
			if($role=='Admin'){
				$data['notifikasi'] = $this->Notifikasi_model->get_all();
			}else{
				$username = $this->session->userdata('username'); // Or.12345

				$siswa = $this->db
						->from('siswa')
						->where("INSTR('$username', nis) >", 0, false) // SQL native, no escaping
						->get()
						->row();

				$data['notifikasi'] = $this->Notifikasi_model->get_by_siswa($siswa->id);
			}
			$this->load->view('notifikasi', $data);
	}

	public function mark_as_read() {
			$id = $this->input->post('id');
			$this->Notifikasi_model->mark_as_read($id);
			redirect('notifikasi');
	}

	public function delete() {
			$id = $this->input->post('id');
			$this->Notifikasi_model->delete($id);
			redirect('notifikasi');
	}

}
