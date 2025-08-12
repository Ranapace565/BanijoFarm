<!-- Add Domba Modal -->
<div class="modal fade" id="addDombaModal"><div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Tambah Data Domba</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form action="{{ route('domba.store') }}" method="POST"> @csrf <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Kode Domba (Eartag)</label><input type="text" name="kode_domba" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" class="form-select" required><option value="Jantan">Jantan</option><option value="Betina">Betina</option></select></div>
            <div class="col-md-6 mb-3"><label class="form-label">Tanggal Masuk</label><input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">Usia</label><input type="text" name="usia" class="form-control" placeholder="Contoh: 5 Bulan"></div> {{-- <-- INPUT BARU --}}
            <div class="col-md-6 mb-3"><label class="form-label">Ras</label><input type="text" name="ras" class="form-control"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Siap Jual">Siap Jual</option><option value="Induk">Induk</option><option value="Anak">Anak</option><option value="Pejantan">Pejantan</option></select></div>
            <div class="col-md-12 mb-3"><label class="form-label">Asal Domba</label><input type="text" name="asal_domba" class="form-control"></div>
        </div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div></form>
</div></div></div>
<!-- Edit Domba Modal -->
<div class="modal fade" id="editDombaModal"><div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Edit Data Domba</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <form id="editDombaForm" method="POST"> @csrf @method('PUT') <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Kode Domba</label><input type="text" id="edit_domba_kode" name="kode_domba" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">Jenis Kelamin</label><select id="edit_domba_kelamin" name="jenis_kelamin" class="form-select" required><option value="Jantan">Jantan</option><option value="Betina">Betina</option></select></div>
            <div class="col-md-6 mb-3"><label class="form-label">Tanggal Masuk</label><input type="date" id="edit_domba_tgl_masuk" name="tanggal_masuk" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">Usia</label><input type="text" id="edit_domba_usia" name="usia" class="form-control"></div> {{-- <-- INPUT BARU --}}
            <div class="col-md-6 mb-3"><label class="form-label">Ras</label><input type="text" id="edit_domba_ras" name="ras" class="form-control"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Status</label><select id="edit_domba_status" name="status" class="form-select"><option value="Siap Jual">Siap Jual</option><option value="Induk">Induk</option><option value="Anak">Anak</option><option value="Pejantan">Pejantan</option><option value="Terjual">Terjual</option><option value="Mati">Mati</option></select></div>
            <div class="col-md-12 mb-3"><label class="form-label">Asal Domba</label><input type="text" id="edit_domba_asal" name="asal_domba" class="form-control"></div>
        </div>
    </div><div class="modal-footer"><button type="submit" class="btn btn-primary">Update</button></div></form>
</div></div></div>
<!-- Delete Domba Modal (Tidak ada perubahan) -->
<div class="modal fade" id="deleteDombaModal"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Hapus Data Domba</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">Yakin ingin menghapus data domba ini?</div>
    <div class="modal-footer"><form id="deleteDombaForm" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Ya, Hapus</button></form></div>
</div></div></div>
