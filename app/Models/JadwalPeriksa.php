<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $table = 'jadwal_periksa';

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function daftarPolis(){
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
