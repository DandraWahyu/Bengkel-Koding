<x-layouts.app title="Daftar Poli">
    <div class="container-fluid px-4 mt-4">
        <h1 class="mb-4">Daftar Poli</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('pasien.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Jadwal Poli</label>
                        <select name="id_jadwal" class="form-control" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    {{ $jadwal->hari }} ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan</label>
                        <textarea name="keluhan" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route('pasien.daftar') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
