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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            // Informasi User
                $table->string('nik')->unique();
                $table->string('name');
                $table->string('ktp');
                $table->timestamp('ttl');
                $table->string('tl');
                $table->string('warga');
                $table->string('agama');
                $table->string('goldar');
                $table->string('stper');
            //
            // Data Alamat
                $table->string('alamat');
                    // Laravolt
                    $table->string('kec');
                    $table->string('kota');
                    $table->string('prov');
                    //
            //





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
