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
        Schema::create('kop_surat', function (Blueprint $table){
            $table ->id('id_kop_surat');
            $table ->string('kode_surat');
            $table ->string('nama_instansi');
            $table ->string('logo_instansi');
            $table ->string('alamat_instansi');
            $table ->string('kontak_instansi');
            $table ->string('website_instansi');
            $table ->string('email_instansi');
            $table ->string('kode_pos');
            $table ->string('lingkup_wilayah');
            $table  ->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kop_surat');
    }
};
