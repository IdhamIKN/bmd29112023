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
        Schema::create('pendidikan_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            // Pendidikan
            //Formal
            $table->string('jenjang');
            // dropdown sd smp sma/slta/ma/D1 D2 D3 s1/d4/profesi s2/spesialis s3
            $table->string('sekolah');
            $table->string('jurusan')->nullable();
            $table->string('kota');
            $table->string('mulai');
            $table->string('selesai');
            $table->string('status');

            $table->string('ipk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_user');
    }
};
