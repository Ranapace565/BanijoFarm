<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Peralatan</h6>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPeralatanModal">Tambah Alat</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead><tr><th>Nama Alat</th><th>Jumlah</th><th>Kondisi</th><th>Lokasi</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($peralatans as $peralatan)
                    <tr>
                        <td>{{ $peralatan->nama_alat }}</td>
                        <td>{{ $peralatan->jumlah_unit }} Unit</td>
                        <td><span class="badge bg-{{ $peralatan->kondisi == 'Baik' ? 'success' : 'warning' }}">{{ $peralatan->kondisi }}</span></td>
                        <td>{{ $peralatan->lokasi_penyimpanan }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-peralatan-btn" data-id="{{ $peralatan->id }}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-peralatan-btn" data-id="{{ $peralatan->id }}"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data peralatan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>