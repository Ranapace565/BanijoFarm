<div class="modal fade" id="addPeralatanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Stok Peralatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('peralatan.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Alat</label><input type="text" name="nama_alat" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Jumlah Unit</label><input type="number" name="jumlah_unit" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kondisi</label><select name="kondisi" class="form-select" required><option value="Baik">Baik</option><option value="Rusak">Rusak</option><option value="Perbaikan">Perbaikan</option></select></div>
        <div class="mb-3"><label class="form-label">Lokasi Penyimpanan</label><input type="text" name="lokasi_penyimpanan" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Peralatan Modal -->
<div class="modal fade" id="editPeralatanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Stok Peralatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editPeralatanForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Alat</label><input type="text" id="edit_peralatan_nama" name="nama_alat" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Jumlah Unit</label><input type="number" id="edit_peralatan_jumlah" name="jumlah_unit" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kondisi</label><select id="edit_peralatan_kondisi" name="kondisi" class="form-select" required><option value="Baik">Baik</option><option value="Rusak">Rusak</option><option value="Perbaikan">Perbaikan</option></select></div>
        <div class="mb-3"><label class="form-label">Lokasi Penyimpanan</label><input type="text" id="edit_peralatan_lokasi" name="lokasi_penyimpanan" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div></form>
</div></div></div>
<!-- Delete Peralatan Modal -->
<div class="modal fade" id="deletePeralatanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Hapus Stok Peralatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data peralatan ini?</div>
    <div class="modal-footer"><form id="deletePeralatanForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>