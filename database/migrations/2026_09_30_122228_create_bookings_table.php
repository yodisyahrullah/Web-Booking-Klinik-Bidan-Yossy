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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('no_antrean'); 
        $table->string('nama_pasien');
        $table->string('no_wa');
        $table->string('keperluan');
        $table->enum('status', ['menunggu', 'dipanggil', 'dilayani', 'dilewati'])->default('menunggu');
        $table->integer('jumlah_panggil')->default(0); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
