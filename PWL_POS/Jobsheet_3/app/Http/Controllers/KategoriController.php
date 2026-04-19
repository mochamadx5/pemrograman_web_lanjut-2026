<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        // Menampilkan semua data dari tabel m_kategori
        $data = DB::table('m_kategori')->get();
        return view('kategori', ['data' => $data]);
    }
}