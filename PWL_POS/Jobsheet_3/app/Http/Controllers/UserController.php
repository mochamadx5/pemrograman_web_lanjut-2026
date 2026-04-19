<?php

namespace App\Http\Controllers;

use App\Models\UserModel; // Import model yang baru dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
    {
        // Matikan kode ini agar tidak terus-terusan menambah data yang sama
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // Coba ambil semua data user
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}