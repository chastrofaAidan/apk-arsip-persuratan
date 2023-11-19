<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeSuratModel extends Model
{
    use HasFactory;
    protected $table = 'kode_surat';
    protected $primaryKey = 'id_kode_surat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_kode_surat', 'kode_surat', 'keterangan_kode_surat'];
}
