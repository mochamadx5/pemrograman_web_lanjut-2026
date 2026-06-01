<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Mengizinkan kolom name diisi
    protected $fillable = ['name'];

    // Relasi Many-to-Many ke tabel Post
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}