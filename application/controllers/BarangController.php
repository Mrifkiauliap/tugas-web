<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // penting buat akses session
        $this->load->model('BarangModel');
		$this->load->library('form_validation'); // untuk validasi form
    }

    // ✅ Fungsi untuk cek login
    private function _check_login() {
        if (!$this->session->has_userdata('user_nama')) {
            $this->session->set_flashdata('pesan', [
                'type' => 'error',
                'message' => 'Anda belum login!'
            ]);
            redirect('user/login'); // redirect ke halaman login
        }
    }

    public function index() {
        $this->_check_login(); // ⛔ Wajib login dulu

        $data['barang'] = $this->BarangModel->get_all_barang();

        $data['user_name'] = $this->session->userdata('user_nama');
        $this->load->view('barang_view', $data);
    }

    public function tambah_barang() {
		// Cek apakah user sudah login
        $this->_check_login();
		// Validasi form tambah barang
        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', ['type' => 'danger', 'message' => 'Gagal menambah barang']);
            $this->load->view('tambah_barang');
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );
            $this->BarangModel->insert_barang($data);
            $this->session->set_flashdata('pesan', ['type' => 'success', 'message' => 'Barang berhasil disimpan']);
            redirect('BarangController/index');
        }
    }

    public function edit_barang($id) {
        $this->_check_login();

        // Validasi id barang
        $barang = $this->BarangModel->get_barang_by_id($id);
        if (!$barang) {
            $this->session->set_flashdata('pesan', [
                'type' => 'danger',
                'message' => 'Barang tidak ditemukan'
            ]);
            redirect('BarangController/index');
        }

        $data['barang'] = $barang;

        if ($this->input->post()) {
            $data_update = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );

            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
            $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('pesan', [
                    'type' => 'danger',
                    'message' => 'Gagal mengedit barang'
                ]);
            } else {
                $this->BarangModel->update_barang($id, $data_update);
                $this->session->set_flashdata('pesan', [
                    'type' => 'success',
                    'message' => 'Barang berhasil diedit'
                ]);
                redirect('BarangController/index');
            }
        }

        $this->load->view('edit_barang', $data);
    }

    public function delete_barang($id) {
        $this->_check_login();

        $barang = $this->BarangModel->get_barang_by_id($id);
        if (!$barang) {
            $this->session->set_flashdata('pesan', [
                'type' => 'danger',
                'message' => 'Barang tidak ditemukan'
            ]);
        } else {
            $this->BarangModel->delete_barang($id);
            $this->session->set_flashdata('pesan', [
                'type' => 'success',
                'message' => 'Barang berhasil dihapus'
            ]);
        }
        redirect('BarangController/index');
    }
}

