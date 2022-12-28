<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    protected $table = "pembelis";
    // protected $primaryKey = "id_pembeli";
    protected $fillable = [
        'nama_pembeli',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'email',
        'password'
    ];
}
