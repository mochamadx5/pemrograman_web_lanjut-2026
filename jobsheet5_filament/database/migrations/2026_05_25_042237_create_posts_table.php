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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
    
            // Baris ini membuat foreign key yang terhubung ke tabel categories
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); 
    
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->text('body')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('published')->default(false);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    } // <--- INI YANG KURANG TADI

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};