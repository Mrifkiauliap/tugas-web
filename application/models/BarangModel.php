<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangModel extends CI_Model {

    // Fungsi untuk mengambil semua data barang berdasarkan uid
    public function get_all_barang_by_uid($uid) {
        // Mengambil data dari tabel 'barang' berdasarkan uid
        return $this->db->get_where('barang', ['uid' => $uid])->result();
    }

    // Fungsi untuk mengambil data barang berdasarkan ID
    public function get_barang_by_id($id) {
        // Mengambil data barang berdasarkan ID
        return $this->db->get_where('barang', ['id' => $id])->row();
    }

    // Fungsi untuk menambah data barang
    public function insert_barang($data) {
        // Menyimpan data barang ke dalam tabel 'barang'
        return $this->db->insert('barang', $data);
    }

    // Fungsi untuk mengupdate data barang
    public function update_barang($id, $data) {
        // Mengupdate data barang berdasarkan ID
        $this->db->where('id', $id);
        return $this->db->update('barang', $data);
    }

    // Fungsi untuk menghapus data barang
    public function delete_barang($id) {
        // Menghapus data barang berdasarkan ID
        $this->db->where('id', $id);
        return $this->db->delete('barang');
    }
}
?>
