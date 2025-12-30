<x-layouts.app title="Periksa Pasien">

<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            <h1 class="mb-4">Periksa Pasien</h1>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dokter.periksa-pasien.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id_daftar_poli" value="{{ $daftarPoli->id }}">
                        <input type="hidden" name="obat_json" id="obat_json">
                        <input type="hidden" name="biaya_periksa" id="biaya_periksa" value="0">

                        {{-- Pilih Obat --}}
                        <div class="mb-3">
                            <label class="form-label">Pilih Obat</label>
                            <select id="select-obat" class="form-select">
                                <option value="">-- Pilih Obat --</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}"
                                        data-nama="{{ $obat->nama_obat }}"
                                        data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Catatan --}}
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control"></textarea>
                        </div>

                        {{-- Obat Terpilih --}}
                        <div class="mb-3">
                            <label class="form-label">Obat Terpilih</label>
                            <ul id="obat-terpilih" class="list-group"></ul>
                        </div>

                        {{-- Total --}}
                        <div class="mb-3">
                            <strong>Total Harga:</strong>
                            <p id="total-harga">Rp 0</p>
                        </div>

                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('dokter.periksa-pasien.index') }}"
                           class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
const selectObat = document.getElementById('select-obat');
const listObat = document.getElementById('obat-terpilih');
const inputJson = document.getElementById('obat_json');
const inputBiaya = document.getElementById('biaya_periksa');
const totalHargaEl = document.getElementById('total-harga');

let obatDipilih = [];

selectObat.addEventListener('change', () => {
    const opt = selectObat.options[selectObat.selectedIndex];
    if (!opt.value) return;

    const id = parseInt(opt.value);
    const harga = parseInt(opt.dataset.harga);

    if (obatDipilih.includes(id)) return;

    obatDipilih.push(id);

    const li = document.createElement('li');
    li.className = 'list-group-item';
    li.innerText = opt.text;
    listObat.appendChild(li);

    inputJson.value = JSON.stringify(obatDipilih);
    inputBiaya.value = obatDipilih.length * harga;
    totalHargaEl.innerText = 'Rp ' + inputBiaya.value;

    selectObat.selectedIndex = 0;
});
</script>


</x-layouts.app>
