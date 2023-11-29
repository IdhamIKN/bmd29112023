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
        Schema::create('keluarga_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            // Data Keluarga
            $table->string('status');
            // dropdown status ( Suami Istri Anak Ayah Ibu (Mertua) Saudara )
            $table->string('nama');
            $table->string('telp');
            $table->timestamp('ttl');
            $table->string('tl');
            $table->string('pendidikan');
            // dropdown sd smp sma/slta/ma/D1 D2 D3 s1/d4/profesi s2/spesialis s3
            $table->string('pekerjaan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_user');
    }
};
