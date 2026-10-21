<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'Id_Produk';

    protected $fillable = [
        'Nama_Produk',
        'Deskripsi',
        'Keterangan_Tambahan',
        'Harga',
        'Stok',
        'Status',
    ];
}
