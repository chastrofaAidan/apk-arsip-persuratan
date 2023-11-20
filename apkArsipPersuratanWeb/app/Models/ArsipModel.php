<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ArsipModel extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'arsip';
    protected $primaryKey = 'id_surat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_surat', 'kode_surat', 'judul_surat', 'perusahaan', 'jenis_surat', 'tanggal_surat', 'perihal_surat', 'file_surat', 'keterangan'];
    protected $casts = [
        'tanggal_surat' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // protected $dates = ['deleted_at'];
}
