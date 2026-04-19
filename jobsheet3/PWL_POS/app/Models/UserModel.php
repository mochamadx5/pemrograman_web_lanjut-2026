<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'm_user';        // Mendefinisikan nama tabel [cite: 854]
    protected $primaryKey = 'user_id';  // Mendefinisikan primary key [cite: 854]
}