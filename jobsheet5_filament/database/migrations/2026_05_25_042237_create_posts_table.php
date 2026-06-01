<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel Posts (Kolom JSON tags sudah dihapus)
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); 
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->text('body')->nullable();
            $table->boolean('published')->default(false);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Tags baru
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 3. Pivot Table (Tabel Penghubung post_tag)
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['post_id', 'tag_id']);
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus dari anak ke induk (urutan terbalik)
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('posts');
    }
};