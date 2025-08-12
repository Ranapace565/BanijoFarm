<!-- Add Pakan Modal -->
<div class="modal fade" id="addPakanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Stok Pakan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('pakan.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Pakan</label><input type="text" name="nama_pakan" class="form-control" required></div>
        <div class="row"><div class="col-6"><div class="mb-3"><label class="form-label">Jumlah</label><input type="number" step="0.1" name="jumlah_stok" class="form-control" required></div></div><div class="col-6"><div class="mb-3"><label class="form-label">Satuan</label><input type="text" name="satuan" class="form-control" placeholder="Kg, Karung" required></div></div></div>
        <div class="mb-3"><label class="form-label">Tanggal Masuk</label><input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required></div>
        <div class="mb-3"><label class="form-label">Tanggal Kadaluarsa</label><input type="date" name="tanggal_kadaluarsa" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Supplier</label><input type="text" name="supplier" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Pakan Modal -->
<div class="modal fade" id="editPakanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Stok Pakan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editPakanForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama Pakan</label><input type="text" id="edit_pakan_nama" name="nama_pakan" class="form-control" required></div>
        <div class="row"><div class="col-6"><div class="mb-3"><label class="form-label">Jumlah</label><input type="number" step="0.1" id="edit_pakan_jumlah" name="jumlah_stok" class="form-control" required></div></div><div class="col-6"><div class="mb-3"><label class="form-label">Satuan</label><input type="text" id="edit_pakan_satuan" name="satuan" class="form-control" required></div></div></div>
        <div class="mb-3"><label class="form-label">Tanggal Masuk</label><input type="date" id="edit_pakan_tgl_masuk" name="tanggal_masuk" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Tanggal Kadaluarsa</label><input type="date" id="edit_pakan_tgl_kadaluarsa" name="tanggal_kadaluarsa" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Supplier</label><input type="text" id="edit_pakan_supplier" name="supplier" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div></form>
</div></div></div>
<!-- Delete Pakan Modal -->
<div class="modal fade" id="deletePakanModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Hapus Stok Pakan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data pakan ini?</div>
    <div class="modal-footer"><form id="deletePakanForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>
