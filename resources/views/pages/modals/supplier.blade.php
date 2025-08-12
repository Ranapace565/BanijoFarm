<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Supplier Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('supplier.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input type="text" name="nomor_telepon" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="2"></textarea></div>
        <div class="mb-3"><label class="form-label">Produk Disediakan</label><input type="text" name="produk_disediakan" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Data Supplier</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editSupplierForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" id="edit_supplier_nama" name="nama" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input type="text" id="edit_supplier_nomor_telepon" name="nomor_telepon" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Alamat</label><textarea id="edit_supplier_alamat" name="alamat" class="form-control" rows="2"></textarea></div>
        <div class="mb-3"><label class="form-label">Produk Disediakan</label><input type="text" id="edit_supplier_produk" name="produk_disediakan" class="form-control"></div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div></form>
</div></div></div>
<!-- Delete Supplier Modal -->
<div class="modal fade" id="deleteSupplierModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data supplier ini?</div>
    <div class="modal-footer"><form id="deleteSupplierForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>