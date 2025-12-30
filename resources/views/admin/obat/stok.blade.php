<x-layouts.app title="Kelola Stok Obat">
<div class="container">
    <h3>{{ $obat->nama_obat }}</h3>
    <p>Stok saat ini: <b>{{ $obat->stok }}</b></p>

    <form method="POST" action="{{ route('admin.obat.update-stok', $obat->id) }}">
        @csrf
        <div class="mb-3">
            <label>Jumlah (+ / -)</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</x-layouts.app>
