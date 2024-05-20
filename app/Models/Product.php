<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';


    protected $fillable = [
        'id_barang',
        'kode_barang',
        'nama_barang',
        'jumblah_barang',
        'satuan_barang',
        'harga_beli',
        'status_barang'
    ];
}
