<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'SUP01', 'supplier_nama' => 'PT Surya Elektronik', 'supplier_alamat' => 'Jl. Soekarno Hatta No. 1, Malang'],
            ['supplier_id' => 2, 'supplier_kode' => 'SUP02', 'supplier_nama' => 'CV Makmur Sandang', 'supplier_alamat' => 'Jl. Kawi No. 2, Malang'],
            ['supplier_id' => 3, 'supplier_kode' => 'SUP03', 'supplier_nama' => 'Toko Laris Pangan', 'supplier_alamat' => 'Jl. Ijen No. 3, Malang'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
