<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang dari Supplier 1 (Elektronik & Kebersihan)
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG01', 'barang_nama' => 'Mouse Wireless', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'BRG02', 'barang_nama' => 'Keyboard Mechanic', 'harga_beli' => 250000, 'harga_jual' => 350000],
            ['barang_id' => 3, 'kategori_id' => 1, 'barang_kode' => 'BRG03', 'barang_nama' => 'Flashdisk 32GB', 'harga_beli' => 40000, 'harga_jual' => 60000],
            ['barang_id' => 4, 'kategori_id' => 5, 'barang_kode' => 'BRG04', 'barang_nama' => 'Sabun Cuci Piring', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 5, 'kategori_id' => 5, 'barang_kode' => 'BRG05', 'barang_nama' => 'Pembersih Lantai', 'harga_beli' => 12000, 'harga_jual' => 18000],

            // Barang dari Supplier 2 (Pakaian)
            ['barang_id' => 6, 'kategori_id' => 2, 'barang_kode' => 'BRG06', 'barang_nama' => 'Kaos Polos Putih', 'harga_beli' => 30000, 'harga_jual' => 50000],
            ['barang_id' => 7, 'kategori_id' => 2, 'barang_kode' => 'BRG07', 'barang_nama' => 'Kemeja Flanel', 'harga_beli' => 80000, 'harga_jual' => 120000],
            ['barang_id' => 8, 'kategori_id' => 2, 'barang_kode' => 'BRG08', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['barang_id' => 9, 'kategori_id' => 2, 'barang_kode' => 'BRG09', 'barang_nama' => 'Jaket Hoodie', 'harga_beli' => 120000, 'harga_jual' => 180000],
            ['barang_id' => 10, 'kategori_id' => 2, 'barang_kode' => 'BRG10', 'barang_nama' => 'Topi Baseball', 'harga_beli' => 20000, 'harga_jual' => 35000],

            // Barang dari Supplier 3 (Makanan & Minuman)
            ['barang_id' => 11, 'kategori_id' => 3, 'barang_kode' => 'BRG11', 'barang_nama' => 'Roti Tawar', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 12, 'kategori_id' => 3, 'barang_kode' => 'BRG12', 'barang_nama' => 'Biskuit Cokelat', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['barang_id' => 13, 'kategori_id' => 4, 'barang_kode' => 'BRG13', 'barang_nama' => 'Air Mineral 600ml', 'harga_beli' => 2000, 'harga_jual' => 3500],
            ['barang_id' => 14, 'kategori_id' => 4, 'barang_kode' => 'BRG14', 'barang_nama' => 'Teh Kotak', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['barang_id' => 15, 'kategori_id' => 4, 'barang_kode' => 'BRG15', 'barang_nama' => 'Kopi Botol', 'harga_beli' => 5000, 'harga_jual' => 8000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
