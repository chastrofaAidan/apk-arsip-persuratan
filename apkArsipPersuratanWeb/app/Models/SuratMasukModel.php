<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasukModel extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $primaryKey = 'no_masuk';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['no_masuk', 'tanggal_masuk', 'kode_masuk', 'pengirim', 'identitas_masuk', 'pokok_masuk', 'keterangan_masuk'];
    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
