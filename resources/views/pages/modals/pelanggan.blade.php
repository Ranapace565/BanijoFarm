<!-- Add Pelanggan Modal -->
<div class="modal fade" id="addPelangganModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Pelanggan Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('pelanggan.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input type="text" name="nomor_telepon" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="2"></textarea></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Pelanggan Modal -->
<div class="modal fade" id="editPelangganModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Data Pelanggan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editPelangganForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" id="edit_pelanggan_nama" name="nama" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input type="text" id="edit_pelanggan_nomor_telepon" name="nomor_telepon" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea id="edit_pelanggan_alamat" name="alamat" class="form-control" rows="2"></textarea></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div></form>
</div></div></div>
<!-- Delete Pelanggan Modal -->
<div class="modal fade" id="deletePelangganModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data pelanggan ini?</div>
    <div class="modal-footer"><form id="deletePelangganForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>