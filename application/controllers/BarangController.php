<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // penting buat akses session
        $this->load->model('BarangModel');
    }

    // ✅ Fungsi untuk cek login
    private function _check_login() {
        if (!$this->session->has_userdata('user_nama')) {
            redirect('user/login'); // redirect ke halaman login
        }
    }

    public function index() {
        $this->_check_login(); // ⛔ Wajib login dulu

        $data['barang'] = $this->BarangModel->get_all_barang();
        log_message('info', 'Data barang diambil dari database');
        log_message('info', 'Jumlah barang: ' . count($data['barang']));

        $data['user_name'] = $this->session->userdata('user_nama');
        $this->load->view('barang_view', $data);
    }

    public function tambah_barang() {
        $this->_check_login();

        if ($this->input->post()) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );
            $this->BarangModel->insert_barang($data);
            redirect('BarangController/index');
        }

        $this->load->view('tambah_barang');
    }

    public function edit_barang($id) {
        $this->_check_login();

        $data['barang'] = $this->BarangModel->get_barang_by_id($id);

        if ($this->input->post()) {
            $data_update = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );
            $this->BarangModel->update_barang($id, $data_update);
            redirect('BarangController/index');
        }

        $this->load->view('edit_barang', $data);
    }

    public function delete_barang($id) {
        $this->_check_login();

        $this->BarangModel->delete_barang($id);
        redirect('BarangController/index');
    }
}
?>
