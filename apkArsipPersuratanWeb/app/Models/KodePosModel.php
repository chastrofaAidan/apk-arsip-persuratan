<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodePosModel extends Model
{
    use HasFactory;
    protected $table = 'kode_pos';
    protected $primaryKey = 'id_kode_pos';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_kode_pos', 'kode_pos', 'keterangan_kode_pos'];
}
