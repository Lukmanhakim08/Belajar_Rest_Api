<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barangs";
    protected $fillable = [
        'nama_barang',
        'foto_barang',
        'harga_barang',
        'stok_barang',
        // 'id_supplier',
    ];
}
