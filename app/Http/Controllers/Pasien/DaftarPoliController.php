<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;

class DaftarPoliController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal beserta relasi dokter dan poli
        $jadwals = JadwalPeriksa::with('dokter', 'poli')->get();

        // Ambil semua poli
        $polis = Poli::all();

        // Kirim ke view
        return view('pasien.daftar-poli.index', compact('jadwals', 'polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string',
        ]);

        // Hitung no antrian berdasarkan jadwal
        $noAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count() + 1;

        DaftarPoli::create([
            'id_pasien' => auth()->id(),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()
            ->route('pasien.daftar-poli.index')
            ->with('message', 'Berhasil daftar poli')
            ->with('type', 'success');
    }
}
