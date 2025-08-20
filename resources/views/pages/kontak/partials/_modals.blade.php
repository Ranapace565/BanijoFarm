<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Kontak Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="addForm" onsubmit="return false;">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" required></div>
                    <div class="mb-3"><label class="form-label">No. HP</label><input type="text" class="form-control" name="no_hp"></div>
                    <div class="mb-3"><label class="form-label">Jenis Kontak</label>
                        <select class="form-select" name="jenis" required>
                            <option value="pelanggan">Pelanggan</option>
                            <option value="supplier">Supplier</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Kontak</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form id="editForm" onsubmit="return false;">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" id="edit_nama" name="nama" required></div>
                    <div class="mb-3"><label class="form-label">No. HP</label><input type="text" class="form-control" id="edit_no_hp" name="no_hp"></div>
                    <div class="mb-3"><label class="form-label">Jenis Kontak</label>
                        <select class="form-select" id="edit_jenis" name="jenis" required>
                            <option value="pelanggan">Pelanggan</option>
                            <option value="supplier">Supplier</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" id="edit_keterangan" name="keterangan" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>