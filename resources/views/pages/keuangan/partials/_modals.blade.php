{{-- resources/views/pages/keuangan/partials/_modals.blade.php --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addForm">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="add_jenis" class="form-label">Jenis Transaksi</label>
                        <select class="form-select" id="add_jenis" name="jenis" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="number" class="form-control" id="add_jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="add_keterangan" name="keterangan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    {{-- Form fields are identical to add modal --}}
                    <div class="mb-3">
                        <label for="edit_jenis" class="form-label">Jenis Transaksi</label>
                        <select class="form-select" id="edit_jenis" name="jenis" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="number" class="form-control" id="edit_jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" name="keterangan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>