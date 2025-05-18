<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model'); // jika butuh data kelas
		$this->load->library('notif_lib');
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
		$this->load->model('User_model'); // pastikan model User diload

		$nis = $this->input->post('nis');
		$existing = $this->Siswa_model->get_by_nis($nis);

		if ($existing) {
			$this->session->set_flashdata('error', 'NIS sudah terdaftar!');
			$this->session->set_flashdata('show_add_modal', true); // untuk trigger modal
			redirect('siswa');
		}

		// Tambah siswa
		$this->Siswa_model->insert($this->input->post());

		// Set default password
		$password = password_hash('SP.2025', PASSWORD_DEFAULT);
		$created_at = date('Y-m-d H:i:s');

		// Tambah user untuk siswa
		$this->User_model->insert([
			'username' => $nis,
			'password' => $password,
			'role' => 'Siswa',
			'created_at' => $created_at
		]);

		// Tambah user untuk orangtua
		$this->User_model->insert([
			'username' => 'Or.' . $nis,
			'password' => $password,
			'role' => 'Ortu',
			'created_at' => $created_at
		]);

		$this->session->set_flashdata('success', 'Data siswa & akun berhasil ditambahkan.');
		redirect('siswa');
	}


    public function update() {
		$id = $this->input->post('id');
		$nis = $this->input->post('nis');

		$existing = $this->Siswa_model->get_by_nis($nis);

		if ($existing && $existing->id != $id) {
			$this->session->set_flashdata('error_edit_' . $id, 'NIS sudah terdaftar oleh siswa lain.');
			$this->session->set_flashdata('show_edit_modal_' . $id, true); // untuk buka modal edit
			redirect('siswa');
		}

		$this->Siswa_model->update($id, $this->input->post());
		$this->session->set_flashdata('success', 'Data siswa berhasil diperbarui.');
		redirect('siswa');
	}


    public function delete() {
		$id = $this->input->post('id');

		// Ambil data siswa berdasarkan ID
		$siswa = $this->Siswa_model->get_by_id($id);

		if ($siswa) {
			$nis = $siswa->nis;

			// Hapus siswa
			$this->Siswa_model->delete($id);

			// Hapus user dengan username = NIS atau Or.NIS
			$this->load->model('User_model');
			$this->db->where('username', $nis)->or_where('username', 'Or.' . $nis)->delete('users');
		}

		$this->session->set_flashdata('success', 'Data siswa dan akun terkait berhasil dihapus.');
		redirect('siswa');
	}

	public function export_pdf() {
			$this->load->library('pdf'); // Dompdf wrapper
			$this->load->model('Kelas_model');

			$kelas_id = $this->input->post('kelas_id');
			$from = $this->input->post('from_date');
			$to = $this->input->post('to_date');

			$data['kelas'] = $kelas_id ? $this->Kelas_model->get_by_id($kelas_id) : null;
			$data['from'] = $from;
			$data['to'] = $to;
			$data['siswa'] = $this->Siswa_model->filter_siswa($kelas_id, $from, $to);

			// Buat view HTML
			$html = $this->load->view('print/siswa', $data, true);

			// Load ke Dompdf
			$this->pdf->loadHtml($html);
			$this->pdf->setPaper('A4', 'portrait');
			$this->pdf->render();

			// Output PDF langsung
			$this->pdf->stream("Laporan_Siswa.pdf", array("Attachment" => true)); // true = download
	}


}
