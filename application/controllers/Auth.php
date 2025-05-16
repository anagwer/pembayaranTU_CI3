<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('id')) {
            redirect('dashboard');
        }

        $this->load->view('login');
    }

    public function login() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        if (!empty($username) && !empty($password)) {
            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'id'       => $user->id,
                    'username' => $user->username,
                    'role'     => $user->role
                ]);
                redirect('dashboard'); 
            } else {
                $data['error'] = 'Username atau password salah.';
                $this->load->view('login', $data);
            }
        } else {
            $data['error'] = 'Username dan password harus diisi.';
            $this->load->view('login', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
