<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
		$this->load->library('form_validation');
    }

    public function register() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];
            $this->UserModel->insert_user($data);
            redirect('user/login');
        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->UserModel->get_user_by_email($email);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    $data = array(
                        'user_id' => $user->id,
                        'user_nama' => $user->nama,
                        'user_email' => $user->email
                    );
					log_message('info', 'User logged in: ' . $user->nama);
                    $this->session->set_userdata($data);
                    redirect('BarangController/index');
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or password');
                    redirect('user/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('user/login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logged out successfully');
        redirect('user/login');
    }
}


