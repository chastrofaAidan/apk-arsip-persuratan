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
        Schema::create('arsip', function (Blueprint $table){
            $table->id('id_surat');
            $table->unsignedBigInteger('id')->index()->nullable()->default(null);
            $table->string('kode_surat');
            $table->string('judul_surat');
            $table->string('perusahaan');
            $table->string('jenis_surat');
            $table->date('tanggal_surat');
            $table->string('perihal_surat');
            $table->string('file_surat');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Define foreign key
            $table->foreign('id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};
