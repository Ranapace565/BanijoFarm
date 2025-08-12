@extends('layouts.app')
@section('title', 'Kelola Pemasukan')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Kelola Pemasukan</h1>

    {{-- Form Tambah Data --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Tambah Pemasukan Baru</h6></div>
        <div class="card-body">
            @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if ($errors->any()) <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div> @endif
            <form action="{{ route('pemasukan.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3"><div class="mb-3"><label for="tanggal" class="form-label fw-bold">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required></div></div>
                    <div class="col-md-4"><div class="mb-3"><label for="keterangan" class="form-label fw-bold">Keterangan</label><input type="text" class="form-control" name="keterangan" placeholder="Contoh: Penjualan domba" required></div></div>
                    <div class="col-md-3"><div class="mb-3"><label for="jumlah" class="form-label fw-bold">Jumlah (Rp)</label><input type="number" class="form-control" name="jumlah" placeholder="Contoh: 5000000" required></div></div>
                    <div class="col-md-2"><div class="mb-3"><label for="domba_id" class="form-label fw-bold">Domba Terjual</label><select name="domba_id" class="form-select"><option value="">-- Opsional --</option>@foreach ($dombasSiapJual as $domba)<option value="{{ $domba->id }}">{{ $domba->kode_domba }}</option>@endforeach</select></div></div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Pemasukan</button>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Pemasukan --}}
    <div class="card shadow-sm border-0">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Daftar Pemasukan</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%">
                    <thead class="table-dark">
                        <tr><th>Tanggal</th><th>Keterangan</th><th class="text-end">Jumlah</th><th class="text-center" style="width: 120px;">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($pemasukans as $pemasukan)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{{ $pemasukan->keterangan }}</td>
                                <td class="text-end">Rp {{ number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="{{ $pemasukan->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $pemasukan->id }}"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Belum ada data pemasukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPemasukanModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Edit Data Pemasukan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <form id="editPemasukanForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
            <div class="row">
                <div class="col-md-4"><div class="mb-3"><label for="edit_tanggal" class="form-label fw-bold">Tanggal</label><input type="date" class="form-control" id="edit_tanggal" name="tanggal" required></div></div>
                <div class="col-md-8"><div class="mb-3"><label for="edit_keterangan" class="form-label fw-bold">Keterangan</label><input type="text" class="form-control" id="edit_keterangan" name="keterangan" required></div></div>
                <div class="col-md-12"><div class="mb-3"><label for="edit_jumlah" class="form-label fw-bold">Jumlah (Rp)</label><input type="number" class="form-control" id="edit_jumlah" name="jumlah" required></div></div>
            </div>
        </div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div></form>
    </div></div></div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deletePemasukanModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus Data</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">Apakah Anda yakin ingin menghapus data ini?</div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><form id="deletePemasukanForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus!</button></form></div>
    </div></div></div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // === EDIT LOGIC ===
    $('body').on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.get(`/pemasukan/${id}`, function(data) {
            $('#edit_tanggal').val(data.tanggal);
            $('#edit_keterangan').val(data.keterangan);
            $('#edit_jumlah').val(data.jumlah);
            $('#editPemasukanForm').attr('action', `/pemasukan/${id}`);
            $('#editPemasukanModal').modal('show');
        });
    });

    $('#editPemasukanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#editPemasukanModal').modal('hide');
                alert('Data berhasil diperbarui!');
                location.reload();
            },
            error: function(xhr) { alert('Terjadi kesalahan. Periksa kembali data Anda.'); }
        });
    });

    // === DELETE LOGIC ===
    $('body').on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        $('#deletePemasukanForm').attr('action', `/pemasukan/${id}`);
        $('#deletePemasukanModal').modal('show');
    });

    $('#deletePemasukanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#deletePemasukanModal').modal('hide');
                alert('Data berhasil dihapus!');
                location.reload();
            },
            error: function(xhr) { alert('Gagal menghapus data.'); }
        });
    });
});
</script>
@endpush
