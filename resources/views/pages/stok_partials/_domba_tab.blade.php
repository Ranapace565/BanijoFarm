<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Domba</h6>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDombaModal">Tambah Domba</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Kelamin</th>
                        <th>Usia</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dombas as $domba)
                    <tr>
                        <td><strong>{{ $domba->kode_domba }}</strong></td>
                        <td>{{ $domba->jenis_kelamin }}</td>
                        <td>{{ $domba->usia }}</td> {{-- <-- MENAMPILKAN USIA LANGSUNG DARI DB --}}
                        <td><span class="badge bg-{{ $domba->status == 'Tersedia' || $domba->status == 'Siap Jual' ? 'success' : 'secondary' }}">{{ $domba->status }}</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-domba-btn" data-id="{{ $domba->id }}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger delete-domba-btn" data-id="{{ $domba->id }}"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada data domba.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
