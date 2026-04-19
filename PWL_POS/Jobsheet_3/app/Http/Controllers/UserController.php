<?php

namespace App\Http\Controllers;

use App\Models\UserModel; // Import model yang baru dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
    $data = [
        'level_id' => 2,
        'username' => 'manager_dua',
        'nama' => 'Manager 2',
        'password' => Hash::make('12345')
    ];

    // Menggunakan mass assignment untuk menyimpan data [cite: 58]
    UserModel::create($data);

    $user = UserModel::all();
    return view('user', ['data' => $user]);
}
}