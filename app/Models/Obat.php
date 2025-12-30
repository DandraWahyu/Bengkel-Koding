<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat'; // ⬅️ PENTING

    protected $fillable = [
        'nama_obat',
        'harga',
        'stok'
    ];
}
