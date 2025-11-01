<x-layouts.app title="Edit Jadwal Periksa Dokter">

    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                {{-- 🔔 Judul Halaman --}}
                <h1 class="mb-4">Edit Jadwal Periksa</h1>

                {{-- 🔔 Alert Flash Message --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- 🔹 Form Edit Jadwal --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Pilih Hari --}}
                            <div class="form-group mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <select name="hari" id="hari"
                                        class="form-select @error('hari') is-invalid @enderror"
                                        required>
                                    <option value="">Pilih Hari</option>
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                        <option value="{{ $day }}"
                                            {{ (old('hari', $jadwalPeriksa->hari) == $day) ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="form-group mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai"
                                       class="form-control @error('jam_mulai') is-invalid @enderror"
                                       value="{{ old('jam_mulai', $jadwalPeriksa->jam_mulai) }}"
                                       required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="form-group mb-4">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai"
                                       class="form-control @error('jam_selesai') is-invalid @enderror"
                                       value="{{ old('jam_selesai', $jadwalPeriksa->jam_selesai) }}"
                                       required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 🔔 Auto hide alert --}}
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>

</x-layouts.app>
