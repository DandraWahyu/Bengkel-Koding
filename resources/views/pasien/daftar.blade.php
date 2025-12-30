<x-layouts.app title="Daftar Poli">

    <div class="container-fluid px-4 mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h1 class="mb-4">Daftar Poli</h1>

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-hospital-user"></i> Form Pendaftaran Poli
                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pasien.store') }}" method="POST">
                            @csrf

                            {{-- Pilih Jadwal --}}
                            <div class="form-group">
                                <label for="id_jadwal">Pilih Jadwal Dokter</label>
                                <select name="id_jadwal" id="id_jadwal"
                                        class="form-control @error('id_jadwal') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jadwal --</option>
                                    @foreach ($jadwals as $jadwal)
                                        <option value="{{ $jadwal->id }}">
                                            {{ $jadwal->hari }} |
                                            {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jadwal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Keluhan --}}
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea name="keluhan" id="keluhan" rows="4"
                                          class="form-control @error('keluhan') is-invalid @enderror"
                                          placeholder="Tuliskan keluhan Anda..." required>{{ old('keluhan') }}</textarea>
                                @error('keluhan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Daftar
                                </button>
                                <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-layouts.app>
