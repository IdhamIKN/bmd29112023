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
        Schema::create('bahasa_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            // Bahasa
            $table->string('bahasa');
            $table->string('lisan');
            $table->string('tulisan');
            // bahasa
            // dropdown lisan (baik sedang kurang)
            // dropdown tulisan (baik sedang kurang)
            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahasa_user');
    }
};
