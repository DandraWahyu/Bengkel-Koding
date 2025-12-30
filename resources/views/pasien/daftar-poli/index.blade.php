<x-layouts.app title="Daftar Poli">
    <div class="container-fluid px-4 mt-4">
        <h1>Daftar Poli</h1>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form method="POST" action="{{ route('pasien.daftar-poli.store') }}">
            @csrf

            {{-- Pilih Poli --}}
            <div class="mb-3">
                <select name="id_poli" class="form-control" required>
                    <option value="">-- Pilih Poli --</option>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                    @endforeach
                </select>

            </div>

            {{-- Pilih Jadwal --}}
            <div class="mb-3">
                <label>Pilih Jadwal Dokter</label>
                <select name="id_jadwal" class="form-control" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach ($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            {{ optional($jadwal->poli)->nama_poli ?? '-' }} |
                            {{ optional($jadwal->dokter)->nama ?? '-' }} |
                            {{ $jadwal->hari }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Keluhan --}}
            <div class="mb-3">
                <label>Keluhan</label>
                <textarea name="keluhan" class="form-control" placeholder="Tuliskan keluhan Anda..." required></textarea>
            </div>

            <button class="btn btn-primary">Daftar</button>
        </form>
    </div>
</x-layouts.app>
