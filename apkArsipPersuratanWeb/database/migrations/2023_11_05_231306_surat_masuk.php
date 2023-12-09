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
        Schema::create('surat_masuk', function (Blueprint $table){
            $table ->id('no_masuk');
            $table ->unsignedBigInteger('id')->index()->nullable()->default(null);
            $table ->date('tanggal_masuk');
            $table ->string('kode_masuk');
            $table ->string('pengirim');
            $table ->string('identitas_masuk');
            $table ->string('pokok_masuk');
            $table ->text('keterangan_masuk');
            $table  ->timestamps(); 
            // $table->softDeletes();

            
            // Define foreign key
            $table->foreign('id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};