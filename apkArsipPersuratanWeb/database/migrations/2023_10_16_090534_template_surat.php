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
        Schema::create('template_surat', function (Blueprint $table){
            $table ->id('id_template_surat');
            $table ->string('kode_pos');
            $table ->string('keterangan_kode_pos');
            $table ->string('keterangan_kode_pos');
            $table ->string('keterangan_kode_pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
