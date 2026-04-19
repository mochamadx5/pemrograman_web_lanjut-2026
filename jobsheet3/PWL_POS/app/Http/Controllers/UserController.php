<?php

namespace App\Http\Controllers;

use App\Models\UserModel; // Import model yang baru dibuat
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel m_user menggunakan Eloquent [cite: 797]
        $user = UserModel::all(); 
        return view('user', ['data' => $user]);
    }
}