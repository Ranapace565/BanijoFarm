<div class="modal fade" id="addObatModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Stok Obat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('obat.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Obat/Suplemen</label><input type="text" name="nama_obat" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Fungsi</label><input type="text" name="fungsi" class="form-control" placeholder="Cacing, Vitamin, dll" required></div>
        <div class="row"><div class="col-6"><div class="mb-3"><label class="form-label">Jumlah</label><input type="number" step="0.1" name="jumlah_stok" class="form-control" required></div></div><div class="col-6"><div class="mb-3"><label class="form-label">Satuan</label><input type="text" name="satuan" class="form-control" placeholder="Botol, Tablet" required></div></div></div>
        <div class="mb-3"><label class="form-label">Tanggal Kadaluarsa</label><input type="date" name="tanggal_kadaluarsa" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Obat Modal -->
<div class="modal fade" id="editObatModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Stok Obat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editObatForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Obat/Suplemen</label><input type="text" id="edit_obat_nama" name="nama_obat" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Fungsi</label><input type="text" id="edit_obat_fungsi" name="fungsi" class="form-control" required></div>
        <div class="row"><div class="col-6"><div class="mb-3"><label class="form-label">Jumlah</label><input type="number" step="0.1" id="edit_obat_jumlah" name="jumlah_stok" class="form-control" required></div></div><div class="col-6"><div class="mb-3"><label class="form-label">Satuan</label><input type="text" id="edit_obat_satuan" name="satuan" class="form-control" required></div></div></div>
        <div class="mb-3"><label class="form-label">Tanggal Kadaluarsa</label><input type="date" id="edit_obat_kadaluarsa" name="tanggal_kadaluarsa" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div></form>
</div></div></div>
<!-- Delete Obat Modal -->
<div class="modal fade" id="deleteObatModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Hapus Stok Obat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data obat ini?</div>
    <div class="modal-footer"><form id="deleteObatForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>