@extends('layouts.app')
@section('title', 'Manajemen Keuangan')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Manajemen Keuangan</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any()) <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div> @endif
    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi Baru</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#keuanganModal">Tambah Data</button>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pemasukan-pane">Pemasukan</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pengeluaran-pane">Pengeluaran</button></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pemasukan-pane">
            <div class="card shadow-sm border-0"><div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark"><tr><th>Tanggal</th><th>Keterangan</th><th class="text-end">Jumlah</th><th class="text-center">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($pemasukans as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM YYYY') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="text-end text-success fw-bold">+ Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada data pemasukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div></div>
        </div>
        <div class="tab-pane fade" id="pengeluaran-pane">
            <div class="card shadow-sm border-0"><div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark"><tr><th>Tanggal</th><th>Keterangan</th><th class="text-end">Jumlah</th><th class="text-center">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($pengeluarans as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM YYYY') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="text-end text-danger fw-bold">- Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada data pengeluaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div></div>
        </div>
    </div>

    <div class="modal fade" id="keuanganModal" tabindex="-1">
        <div class="modal-dialog"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="keuanganModalLabel">Tambah Transaksi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="keuanganForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="methodField">
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label fw-bold">Jenis Transaksi</label><select name="jenis" id="jenis" class="form-select" required><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
                    <div class="mb-3"><label class="form-label fw-bold">Tanggal</label><input type="date" class="form-control" id="tanggal" name="tanggal" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Keterangan</label><input type="text" class="form-control" id="keterangan" name="keterangan" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Jumlah (Rp)</label><input type="number" class="form-control" id="jumlah" name="jumlah" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div></div>
    </div>
    
    {{-- Modal Hapus --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus data ini?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus!</button></form>
            </div>
        </div></div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // === LOGIKA TAMBAH ===
    $('.btn-primary[data-bs-target="#keuanganModal"]').on('click', function() {
        $('#keuanganForm').trigger('reset');
        $('#keuanganForm').attr('action', '{{ route("keuangan.store") }}');
        $('#methodField').val('POST');
        $('#keuanganModalLabel').text('Tambah Transaksi');
        $('#tanggal').val(new Date().toISOString().slice(0, 10)); // Set tanggal hari ini
    });

    // === LOGIKA EDIT ===
    $('body').on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.get(`/keuangan/${id}`, function(data) {
            $('#keuanganForm').attr('action', `/keuangan/${id}`);
            $('#methodField').val('PUT');
            $('#keuanganModalLabel').text('Edit Transaksi');
            
            $('#jenis').val(data.jenis);
            $('#tanggal').val(data.tanggal.substring(0, 10));
            $('#keterangan').val(data.keterangan);
            $('#jumlah').val(data.jumlah);

            $('#keuanganModal').modal('show');
        });
    });

    // === LOGIKA HAPUS ===
    $('body').on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        $('#deleteForm').attr('action', `/keuangan/${id}`);
        $('#deleteModal').modal('show');
    });

    // Submit form (bisa untuk tambah dan edit)
    $('#keuanganForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $('#methodField').val(),
            data: $(this).serialize(),
            success: function(response) { location.reload(); },
            error: function(xhr) { alert('Terjadi kesalahan.'); }
        });
    });
});
</script>
@endpush