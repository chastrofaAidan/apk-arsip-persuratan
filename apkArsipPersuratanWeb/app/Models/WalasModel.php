<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalasModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = 'tbl_walas';
    protected $primaryKey   = 'idwalas';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idwalas', 'fotowalas','namawalas','nip','kelaswalas','mapel'];
    protected $dates = ['deleted_at'];


}
