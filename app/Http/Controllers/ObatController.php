<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:100',
            'harga'     => 'required|integer|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')
            ->with('message', 'Data Obat berhasil dibuat')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_obat' => 'required',
        'harga' => 'required|integer',
        'stok' => 'required|integer|min:0',
    ]);

    $obat = Obat::findOrFail($id);
    $obat->update($request->all());

    return redirect()->route('admin.obat.index')
        ->with('message', 'Stok obat berhasil diperbarui');
}


    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat.index')
            ->with('message', 'Data Obat berhasil dihapus')
            ->with('type', 'success');
    }

    public function stok($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.stok', compact('obat'));
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:1',
            'aksi' => 'required|in:tambah,kurang'
        ]);

        $obat = Obat::findOrFail($id);

        if ($request->aksi === 'tambah') {
            $obat->stok = $obat->stok + $request->stok;
        } else {
            if ($obat->stok < $request->stok) {
                return back()->with([
                    'message' => 'Stok tidak mencukupi',
                    'type' => 'danger'
                ]);
            }
            $obat->stok = $obat->stok - $request->stok;
        }

        $obat->save();

        return redirect()->back()->with([
            'message' => 'Stok berhasil diperbarui',
            'type' => 'success'
        ]);
    }


}
