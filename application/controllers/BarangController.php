<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller {

    // Konstruktor untuk memuat model
    public function __construct() {
        parent::__construct();
        // Memuat model Barang
        $this->load->model('BarangModel');
    }

    // Fungsi untuk menampilkan daftar barang
    public function index() {
        // Mengambil data barang dari model
        $data['barang'] = $this->BarangModel->get_all_barang();

        // Menampilkan view dengan data barang
        $this->load->view('barang_view', $data);
    }

    // Fungsi untuk menambah barang
    public function tambah_barang() {
        // Jika form disubmit, simpan data barang
        if ($this->input->post()) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );
            $this->BarangModel->insert_barang($data);

            // Redirect ke halaman daftar barang
            redirect('BarangController/index');
        }

        // Menampilkan form tambah barang
        $this->load->view('tambah_barang');
    }

    // Fungsi untuk mengedit data barang
    public function edit_barang($id) {
        // Mengambil data barang berdasarkan ID
        $data['barang'] = $this->BarangModel->get_barang_by_id($id);

        // Jika form disubmit, simpan perubahan data barang
        if ($this->input->post()) {
            $data_update = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );
            $this->BarangModel->update_barang($id, $data_update);

            // Redirect ke halaman daftar barang
            redirect('BarangController/index');
        }

        // Menampilkan form edit barang
        $this->load->view('edit_barang', $data);
    }

    // Fungsi untuk menghapus data barang
    public function delete_barang($id) {
        // Menghapus data barang berdasarkan ID
        $this->BarangModel->delete_barang($id);

        // Redirect ke halaman daftar barang setelah penghapusan
        redirect('BarangController/index');
    }
}
?>
