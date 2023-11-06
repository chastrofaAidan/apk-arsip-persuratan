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
        Schema::create('kepala_sekolah', function (Blueprint $table){
            $table ->id('id_kepala_sekolah');
            $table ->date('nama_kepala_sekolah');
            $table ->string('golongan_kepala_sekolah');
            $table ->string('nip_kepala_sekolah');
            $table ->string('tanda_tangan');
            $table  ->timestamps();            
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_sekolah');
    }
};
