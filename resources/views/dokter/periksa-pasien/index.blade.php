<x-layouts.app title="Periksa Pasien">

<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="mb-4">Periksa Pasien</h1>

            {{-- ALERT --}}
            @if (session('message'))
                <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Keluhan</th>
                            <th>No Antrian</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPasien as $dp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dp->pasien->nama }}</td>
                            <td>{{ $dp->keluhan }}</td>
                            <td>{{ $dp->no_antrian }}</td>
                            <td>
                                @if ($dp->periksa)
                                    <span class="badge bg-success">Sudah Diperiksa</span>
                                @else
                                    <a href="{{ route('dokter.periksa-pasien.periksa', $dp->id) }}"
                                    class="btn btn-warning btn-sm">Periksa</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</x-layouts.app>
