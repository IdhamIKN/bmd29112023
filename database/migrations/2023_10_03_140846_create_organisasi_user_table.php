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
        Schema::create('organisasi_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            // Organisasi
            $table->string('organisasi');
            $table->string('th1');
            $table->string('th2');
            $table->string('jabatan');
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_user');
    }
};
