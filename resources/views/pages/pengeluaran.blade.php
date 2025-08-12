@extends('layouts.app')
@section('title', 'Kelola Pengeluaran')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Kelola Pengeluaran</h1>

    {{-- Form Tambah Data --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Pengeluaran Baru</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div> @endif

            <form action="{{ route('pengeluaran.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <div class="mb-3"><label for="tanggal" class="form-label fw-bold">Tanggal</label><input type="date"
                                class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required></div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3"><label for="keterangan" class="form-label fw-bold">Keterangan</label><input
                                type="text" class="form-control" name="keterangan" placeholder="Contoh: Pembelian pakan"
                                required></div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3"><label for="jumlah" class="form-label fw-bold">Total Biaya (Rp)</label><input
                                type="number" class="form-control" name="jumlah" placeholder="Contoh: 1500000" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="pakan_id" class="form-label fw-bold">Stok Terkait</label>
                            <select name="pakan_id" class="form-select">
                                <option value="">-- Opsional --</option>
                                @foreach ($pakans as $pakan)
                                    <option value="{{ $pakan->id }}">{{ $pakan->nama_pakan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="jumlah_pembelian" class="form-label fw-bold">Jumlah Dibeli</label>
                            <input type="number" step="0.1" name="jumlah_pembelian" class="form-control"
                                placeholder="Contoh: 50 (Kg)">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Simpan Pengeluaran</button>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Pengeluaran --}}
    <div class="card shadow-sm border-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-end">Jumlah</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengeluarans as $pengeluaran)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{{ $pengeluaran->keterangan }}</td>
                                <td class="text-end">Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-warning me-2 edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $pengeluaran->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $pengeluaran->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data pengeluaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pengeluaran</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3"><label for="edit_tanggal" class="form-label fw-bold">Tanggal</label><input
                                        type="date" class="form-control" id="edit_tanggal" name="tanggal" required></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3"><label for="edit_keterangan"
                                        class="form-label fw-bold">Keterangan</label><input type="text" class="form-control"
                                        id="edit_keterangan" name="keterangan" required></div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3"><label for="edit_jumlah" class="form-label fw-bold">Jumlah
                                        (Rp)</label><input type="number" class="form-control" id="edit_jumlah" name="jumlah"
                                        required></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // AJAX Setup
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            // === LOGIKA EDIT ===
            $('.edit-btn').on('click', function () {
                let id = $(this).data('id');
                $.get(`/pengeluaran/${id}`, function (data) {
                    $('#edit_tanggal').val(data.tanggal);
                    $('#edit_keterangan').val(data.keterangan);
                    $('#edit_jumlah').val(data.jumlah);
                    $('#editForm').attr('action', `/pengeluaran/${id}`);
                });
            });

            $('#editForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#editModal').modal('hide');
                        alert('Data berhasil diperbarui!');
                        location.reload();
                    },
                    error: function (xhr) { alert('Terjadi kesalahan. Pastikan semua field terisi.'); }
                });
            });

            // === LOGIKA HAPUS ===
            $('.delete-btn').on('click', function () {
                let id = $(this).data('id');
                $('#deleteForm').attr('action', `/pengeluaran/${id}`);
            });

            $('#deleteForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#deleteModal').modal('hide');
                        alert('Data berhasil dihapus!');
                        location.reload();
                    },
                    error: function (xhr) { alert('Gagal menghapus data.'); }
                });
            });
        });
    </script>
@endpush