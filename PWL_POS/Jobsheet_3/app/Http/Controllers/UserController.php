<?php

namespace App\Http\Controllers;

use App\Models\UserModel; // Import model yang baru dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
    {
        $user = UserModel::findOrFail(20); 
        return view('user', ['data' => $user]);
    }
}
