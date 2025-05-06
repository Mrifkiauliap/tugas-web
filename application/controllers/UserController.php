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
		# Validasi form registrasi
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'status' => 'Non Aktif',
                'last_login' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->UserModel->insert_user($data);
            $this->session->set_flashdata('pesan', [
                'type' => 'success',
                'message' => 'Registrasi berhasil, silakan login'
            ]);
            redirect('user/login');
        }
    }

    public function login() {
		# Validasi form login
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
					# Ubah status user
					$this->UserModel->update_last_login($user->id, 'Aktif');
                    $data = array(
                        'user_id' => $user->id,
                        'user_nama' => $user->nama,
                        'user_email' => $user->email,
                        'user_status' => $user->status,
                        'user_last_login' => $user->last_login
                    );
                    log_message('info', 'User logged in: ' . $user->nama);
                    $this->session->set_userdata($data);
                    redirect('BarangController/index');
                } else {
                    $this->session->set_flashdata('pesan', array(
                        'type' => 'danger',
                        'message' => 'Email atau password salah'
                    ));
                    redirect('user/login');
                }
            } else {
                $this->session->set_flashdata('pesan', array(
                    'type' => 'danger',
                    'message' => 'Email atau password salah'
                ));
                redirect('user/login');
            }
        }
    }

    public function logout() {
		# Ubah status user
        $this->UserModel->logout($this->session->userdata('user_id'));
		# Hapus session user
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan', array(
            'type' => 'success',
            'message' => 'Logged out successfully'
        ));
        redirect('user/login');
    }
}


