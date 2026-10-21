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
        Schema::create('borrowings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Siapa yang pinjam (Siswa)
    $table->foreignId('book_id')->constrained()->cascadeOnDelete(); // Buku apa yang dipinjam
    $table->date('borrow_date');
    $table->date('return_date')->nullable();
    $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
