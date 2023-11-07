<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaSekolahModel extends Model
{
    use HasFactory;

    protected $table = 'kepala_sekolah';
    protected $primaryKey = 'id_kepala_sekolah';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_kepala_sekolah', 'nama_kepala_sekolah', 'golongan_kepala_sekolah', 'nip_kepala_sekolah', 'tanda_tangan'];
}


