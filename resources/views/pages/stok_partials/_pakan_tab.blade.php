<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Pakan</h6>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPakanModal">Tambah Pakan</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama Pakan</th>
                        <th>Jumlah</th>
                        <th>Tgl Masuk</th>
                        <th>Supplier</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pakans as $pakan)
                    <tr>
                        <td>{{ $pakan->nama_pakan }}</td>
                        <td>{{ $pakan->jumlah_stok }} {{ $pakan->satuan }}</td>
                        <td>{{ \Carbon\Carbon::parse($pakan->tanggal_masuk)->isoFormat('D MMM YYYY') }}</td>
                        <td>{{ $pakan->supplier }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-pakan-btn" data-id="{{ $pakan->id }}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-pakan-btn" data-id="{{ $pakan->id }}"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data pakan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
