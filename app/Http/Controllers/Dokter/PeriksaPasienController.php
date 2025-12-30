<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        $daftarPasien = DaftarPoli::with(['pasien', 'jadwal', 'periksa'])
            ->whereHas('jadwal', function ($q) use ($dokterId) {
                $q->where('id_dokter', $dokterId);
            })
            ->orderBy('no_antrian')
            ->get();

        return view('dokter.periksa-pasien.index', compact('daftarPasien'));
    }

    public function periksa($id)
    {
        $daftarPoli = DaftarPoli::findOrFail($id);

        // ⛔ cegah double periksa
        if ($daftarPoli->periksa) {
            return redirect()->back()
                ->with('message', 'Pasien sudah diperiksa')
                ->with('type', 'danger');
        }

        $obats = Obat::all();

        return view('dokter.periksa-pasien.create', compact('daftarPoli', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_daftar_poli' => 'required|exists:daftar_poli,id',
            'obat_json' => 'required',
            'biaya_periksa' => 'required|integer',
            'catatan' => 'nullable|string'
        ]);

        $obatIds = json_decode($request->obat_json, true);

        if (!is_array($obatIds) || count($obatIds) == 0) {
            return back()->withErrors('Obat wajib dipilih');
        }

        DB::beginTransaction();

        try {
            $periksa = Periksa::create([
                'id_daftar_poli' => $request->id_daftar_poli,
                'tgl_periksa' => now(),
                'catatan' => $request->catatan,
                'biaya_periksa' => $request->biaya_periksa + 150000
            ]);

            foreach ($obatIds as $idObat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $idObat
                ]);

                Obat::where('id', $idObat)->decrement('stok', 1);
            }

            DB::commit();

            return redirect()
                ->route('dokter.periksa-pasien.index')
                ->with('message', 'Pasien berhasil diperiksa')
                ->with('type', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

}
