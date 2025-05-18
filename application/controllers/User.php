<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');
				$this->load->library('notif_lib');

    }

    public function index() {
        $data['users'] = $this->User_model->get_all();
        $data['siswa'] = $this->Siswa_model->get_all_aktif();

        $this->load->view('user', $data);
    }

    public function add() {
        $role = $this->input->post('role');
        $created_at = date('Y-m-d H:i:s');

        if ($role == 'admin') {
            $data = [
                'username'   => $this->input->post('username'),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => $role,
                'created_at' => $created_at
            ];
            $this->User_model->insert($data);
        } else {
            $nis = $this->input->post('nis');
            // siswa
            $this->User_model->insert([
                'username'   => $nis,
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => 'siswa',
                'created_at' => $created_at
            ]);
            // ortu
            $this->User_model->insert([
                'username'   => 'Or.' . $nis,
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => 'ortu',
                'created_at' => $created_at
            ]);
        }

        redirect('user');
    }

		public function update() {
				$id = $this->input->post('id');
				$username = $this->input->post('username');
				$role = $this->input->post('role');
				$password = $this->input->post('password');

				$data = [
						'username' => $username,
						'role' => $role
				];

				if (!empty($password)) {
						$data['password'] = password_hash($password, PASSWORD_DEFAULT);
				}

				$this->User_model->update($id, $data);
				redirect('user');
		}


    public function delete($id) {
        $this->User_model->delete($id);
        redirect('user');
    }

	public function setting() {
		$id_user = $this->session->userdata('id'); // pastikan ini diset saat login
		$data['user'] = $this->User_model->get_by_id($id_user);
		$this->load->view('user_setting', $data);
	}


	public function update_profile() {
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = ['username' => $username];
		if (!empty($password)) {
			$data['password'] = password_hash($password, PASSWORD_DEFAULT);
		}

		$this->User_model->update($id, $data);

		// Update session kalau username diubah
		$this->session->set_userdata('username', $username);

		redirect('user/setting');
	}

}
