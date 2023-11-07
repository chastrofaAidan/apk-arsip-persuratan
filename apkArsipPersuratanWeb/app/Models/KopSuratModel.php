<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KopSuratModel extends Model
{
    use HasFactory;

    protected $table = 'kop_surat';
    protected $primaryKey = 'id_kop_surat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_kop_surat', 'nama_instansi', 'logo_instansi', 'alamat_instansi', 'kontak_instansi', 'website_instansi', 'email_instansi', 'kode_pos', 'lingkup_wilayah'];
}
