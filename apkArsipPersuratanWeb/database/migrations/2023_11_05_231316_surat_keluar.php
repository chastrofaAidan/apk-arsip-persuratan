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
        Schema::create('surat_keluar', function (Blueprint $table){
            $table ->id('no_keluar');
            $table ->date('tanggal_keluar');
            $table ->string('kode_keluar');
            $table ->string('ditujukan');
            $table ->string('perihal_keluar');
            $table ->string('surat_keluar');
            $table ->text('keterangan_keluar')->nullable()->default(null);
            $table  ->timestamps();            
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
