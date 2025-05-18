<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->model('User_model'); 
				$this->load->library('notif_lib');
				$this->load->model('Notifikasi_model');

    }

    public function index() {
				$jenis = $this->input->get('jenis');
				$data['jenis'] = $jenis;
				$data['kelas'] = $this->Kelas_model->get_all();

				$role = $this->session->userdata('role');

				if ($role == 'Admin') {
						$data['pembayaran'] = $this->Pembayaran_model->get_by_jenis($jenis);
				} else {
						$username = $this->session->userdata('username'); // Contoh: Or.12345

						$siswa = $this->db
								->from('siswa')
								->where("INSTR('$username', nis) >", 0, false)
								->get()
								->row();

						if ($siswa) {
								$data['pembayaran'] = $this->Pembayaran_model->get_by_jenis_and_siswa($jenis, $siswa->id);
						} else {
								$data['pembayaran'] = []; // fallback kalau siswa tidak ditemukan
						}
				}

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
					'id_user'       => $this->session->userdata('id_user') ?? 1,
					'id_siswa'      => $siswa->id,
					'id_kelas'      => $id_kelas,
					'jenis'         => $jenis,
					'jumlah'        => $jumlah,
					'created_at'    => $created_at
				];
				$this->Pembayaran_model->insert($data);

				$notifikasi = [
					'id_siswa'   => $siswa->id,
					'pesan'      => "Tagihan pembayaran $jenis sebesar Rp $jumlah telah ditambahkan.",
					'is_read'    => 0,
					'created_at' => $created_at
				];
				$this->Notifikasi_model->insert($notifikasi);
			}

			redirect('pembayaran?jenis=' . $jenis);
		}


    public function update() {
			$id = $this->input->post('id');
			$jenis = $this->input->post('jenis');
			$jumlah = $this->input->post('jumlah');
			$tanggal_bayar = $this->input->post('tanggal_bayar');
			$keterangan = $this->input->post('keterangan');

			$data = [
				'jumlah'        => $jumlah,
				'tanggal_bayar' => $tanggal_bayar,
				'keterangan'    => $keterangan,
			];

			$this->Pembayaran_model->update($id, $data);

			$pembayaran = $this->Pembayaran_model->get_by_id($id);

			if ($pembayaran) {
				$notifikasi = [
					'id_siswa'   => $pembayaran->id_siswa,
					'pesan'      => "Pembayaran $jenis sebesar Rp $jumlah pada $tanggal_bayar telah <b>Lunas</b>.",
					'is_read'    => 0,
					'created_at' => date('Y-m-d H:i:s')
				];
				$this->Notifikasi_model->insert($notifikasi);
			}

			redirect('pembayaran?jenis=' . $jenis);
		}

    public function delete() {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');

        $this->Pembayaran_model->delete($id);
        redirect('pembayaran?jenis=' . $jenis);
    }

		public function export_pdf() {
			$this->load->library('pdf'); // Dompdf
			$this->load->model('Pembayaran_model');
			$this->load->model('Kelas_model');

			$kelas_id = $this->input->post('kelas_id');
			$from = $this->input->post('from_date');
			$to = $this->input->post('to_date');
			$jenis = $this->input->post('jenis');

			$data['pembayaran'] = $this->Pembayaran_model->filter($kelas_id, $from, $to, $jenis);
			$data['kelas'] = $kelas_id ? $this->Kelas_model->get_by_id($kelas_id) : null;
			$data['from'] = $from;
			$data['to'] = $to;
			$data['jenis'] = $jenis;

			$html = $this->load->view('print/pembayaran', $data, true);
			
			$this->pdf->loadHtml($html);
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->render();
			$this->pdf->stream("Laporan_Pembayaran_{$jenis}.pdf", array("Attachment" => true));
	}

}
