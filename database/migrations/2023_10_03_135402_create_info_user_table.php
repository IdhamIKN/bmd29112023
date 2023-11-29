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
        Schema::create('info_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            // Informasi User
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('ktp');
            $table->timestamp('ttl');
            $table->string('tl');
            $table->string('penempatan');
            $table->string('divisi');
            $table->string('jk');
            $table->string('warga');
            $table->string('agama');
            $table->string('goldar')->nullable();
            $table->string('stper');
            $table->string('foto')->nullable();
            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_user');
    }
};
