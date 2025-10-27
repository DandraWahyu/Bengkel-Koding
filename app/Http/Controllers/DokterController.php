<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user dengan role dokter beserta relasi poli
        $dokters = User::where('role', 'dokter')->with('poli')->get();

        // Tampilkan ke view admin/dokter/index.blade.php
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|string|exists:poli,id',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan ke database
        User::create([
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'no_ktp' => $data['no_ktp'],
            'no_hp' => $data['no_hp'],
            'id_poli' => $data['id_poli'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'dokter',
        ]);

        // Redirect ke halaman index dokter
        return redirect()->route('admin.dokter.index')
            ->with('message', 'Data Dokter berhasil ditambahkan')
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $dokter)
    {
        // Validasi data yang diperbarui
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $dokter->id,
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|string|exists:poli,id',
            'email' => 'required|string|email|unique:users,email,' . $dokter->id,
            'password' => 'nullable|string|min:6',
        ]);

        // Update data dokter
        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $dokter->update($updateData);

        // Redirect kembali ke index
        return redirect()->route('admin.dokter.index')
            ->with('message', 'Data Dokter berhasil diubah')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $dokter)
    {
        $dokter->delete();

        return redirect()->route('admin.dokter.index')
            ->with('message', 'Data Dokter berhasil dihapus')
            ->with('type', 'success');
    }
}
