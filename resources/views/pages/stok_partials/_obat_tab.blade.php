<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Obat & Suplemen</h6>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addObatModal">Tambah Obat</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead><tr><th>Nama Obat</th><th>Fungsi</th><th>Jumlah</th><th>Kadaluarsa</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($obats as $obat)
                    <tr>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->fungsi }}</td>
                        <td>{{ $obat->jumlah_stok }} {{ $obat->satuan }}</td>
                        <td>{{ $obat->tanggal_kadaluarsa ? \Carbon\Carbon::parse($obat->tanggal_kadaluarsa)->isoFormat('D MMM YYYY') : '-' }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-obat-btn" data-id="{{ $obat->id }}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-obat-btn" data-id="{{ $obat->id }}"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data obat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>