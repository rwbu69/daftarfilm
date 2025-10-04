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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('genre');
            $table->integer('year');
            $table->decimal('rating', 3, 1); // Rating dengan 1 digit di belakang koma (0.0 - 10.0)
            $table->boolean('watched')->default(false);
            $table->string('image')->nullable(); // Column untuk menyimpan path gambar
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
