<x-layouts.app title="Tambah Dokter">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="mb-4">Tambah Dokter</h1>
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        {{-- Gunakan route admin.dokter.store --}}
                        <form action="{{ route('admin.dokter.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Nama --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama" class="form-label">
                                            Nama Dokter <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="nama"
                                            name="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama') }}"
                                            required
                                        >
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}"
                                            required
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- No KTP --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_ktp" class="form-label">
                                            No KTP <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="number"
                                            id="no_ktp"
                                            name="no_ktp"
                                            class="form-control @error('no_ktp') is-invalid @enderror"
                                            value="{{ old('no_ktp') }}"
                                            required
                                        >
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- No HP --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_hp" class="form-label">
                                            No HP <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="no_hp"
                                            name="no_hp"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp') }}"
                                            required
                                        >
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">
                                    Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    rows="3"
                                    required
                                >{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Poli --}}
                            <div class="form-group mb-3">
                                <label for="id_poli" class="form-label">
                                    Poli <span class="text-danger">*</span>
                                </label>
                                <select
                                    id="id_poli"
                                    name="id_poli"
                                    class="form-control @error('id_poli') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ old('id_poli') == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_poli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group mb-4">
                                <label for="password" class="form-label">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
