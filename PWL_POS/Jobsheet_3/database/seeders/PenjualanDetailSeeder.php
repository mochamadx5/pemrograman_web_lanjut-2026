<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $counter = 1;
        
        // Loop untuk 10 transaksi (penjualan_id 1-10)
        for ($i = 1; $i <= 10; $i++) {
            // Setiap transaksi membeli 3 barang berbeda
            for ($j = 1; $j <= 3; $j++) {
                $barang_id = (($i + $j) % 15) + 1; // Rotasi barang_id 1-15
                $data[] = [
                    'detail_id' => $counter++,
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                    'harga' => 10000, // Harga dummy (bisa disesuaikan dengan m_barang)
                    'jumlah' => rand(1, 5),
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}