<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Domba Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="addForm" onsubmit="return false;">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="status" value="tersedia">
                    <div class="mb-3"><label for="add_jenis" class="form-label">Jenis Domba</label><input type="text" class="form-control" name="jenis" required></div>
                    <div class="mb-3"><label for="add_umur" class="form-label">Umur (Bulan)</label><input type="number" class="form-control" name="umur" required></div>
                    <div class="mb-3"><label for="add_harga" class="form-label">Harga Beli (Rp)</label><input type="number" class="form-control" name="harga" required></div>
                    <div class="mb-3"><label for="add_keterangan" class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Data Domba</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="editForm" onsubmit="return false;">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3"><label for="edit_jenis" class="form-label">Jenis Domba</label><input type="text" class="form-control" id="edit_jenis" name="jenis" required></div>
                    <div class="mb-3"><label for="edit_umur" class="form-label">Umur (Bulan)</label><input type="number" class="form-control" id="edit_umur" name="umur" required></div>
                    <div class="mb-3"><label for="edit_harga" class="form-label">Harga Beli (Rp)</label><input type="number" class="form-control" id="edit_harga" name="harga" required></div>
                    <div class="mb-3"><label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="tersedia">Tersedia</option><option value="terjual">Terjual</option><option value="mati">Mati</option>
                        </select>
                    </div>
                    <div class="mb-3" id="harga_jual_wrapper" style="display: none;">
                        <label for="edit_harga_jual" class="form-label fw-bold">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" id="edit_harga_jual" name="harga_jual">
                        <div class="form-text">Akan otomatis membuat catatan pemasukan baru.</div>
                    </div>
                    <div class="mb-3"><label for="edit_keterangan" class="form-label">Keterangan</label><textarea class="form-control" id="edit_keterangan" name="keterangan" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>