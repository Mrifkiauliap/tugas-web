<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tambah Barang | Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%233b82f6'><path d='M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z'/></svg>">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 flex flex-col items-center justify-center">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-xl shadow-sm mb-4">
                <i class="fas fa-boxes text-blue-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Barang Baru</h1>
            <p class="mt-2 text-gray-600">Isi form berikut untuk menambahkan barang ke inventori</p>
        </div>

        <!-- Form Card -->
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
            
            <form action="<?= site_url('BarangController/tambah_barang') ?>" method="POST" class="p-6 space-y-6">
                <!-- Nama Barang Field -->
                <div class="space-y-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700 flex items-center">
                        <span class="text-red-500 mr-1">*</span> Nama Barang
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        <input type="text" name="nama" id="nama" 
                               class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               placeholder="Nama barang" required>
                    </div>
                </div>

                <!-- Harga Field -->
                <div class="space-y-2">
                    <label for="harga" class="block text-sm font-medium text-gray-700 flex items-center">
                        <span class="text-red-500 mr-1">*</span> Harga
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">Rp</span>
                        </div>
                        <input type="number" name="harga" id="harga" 
                               class="pl-12 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               placeholder="0" min="0" required>
                    </div>
                </div>

                <!-- Stok Field -->
                <div class="space-y-2">
                    <label for="stok" class="block text-sm font-medium text-gray-700 flex items-center">
                        <span class="text-red-500 mr-1">*</span> Stok Awal
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-layer-group text-gray-400"></i>
                        </div>
                        <input type="number" name="stok" id="stok" 
                               class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               placeholder="0" min="0" required>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 pt-4">
                    <a href="<?= site_url('BarangController') ?>" 
                       class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i> Batal
                    </a>
                    <button type="submit" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 shadow hover:shadow-md flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Footer -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Semua field bertanda (<span class="text-red-500">*</span>) wajib diisi</p>
        </div>
    </div>

    <script>
        // Simpan harga tanpa tanda titik ketika di submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const harga = document.getElementById('harga');
            harga.value = parseInt(harga.value.replace(/\./g, ''));
        });

        // Format harga input on blur
        document.getElementById('harga').addEventListener('blur', function(e) {
            const value = parseInt(e.target.value);
            if (!isNaN(value) && value >= 0) {
                e.target.value = value.toLocaleString('id-ID');
            }
        });

        // Remove formatting on focus
        document.getElementById('harga').addEventListener('focus', function(e) {
            const value = parseInt(e.target.value.replace(/\./g, ''));
            if (!isNaN(value) && value >= 0) {
                e.target.value = value;
            }
        });

        // Input validation for stok
        document.getElementById('stok').addEventListener('change', function(e) {
            if (e.target.value < 0) {
                e.target.value = 0;
            }
        });
    </script>
</body>
</html>
