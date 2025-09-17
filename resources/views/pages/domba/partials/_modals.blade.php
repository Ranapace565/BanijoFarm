<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Domba Baru</h5><button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            {{-- <form id="addForm" onsubmit="return false;"> --}}
            <form action="{{ route('domba.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="status" value="tersedia">

                    <div class="mb-3">
                        <label class="form-label">Jenis Domba</label>
                        <input type="text" class="form-control" name="jenis" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tag Domba</label>
                        <input type="text" class="form-control" name="no_tag">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Lahir</label>
                            <input type="time" class="form-control" name="jam_lahir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Induk</label>
                            <input type="text" class="form-control" name="induk">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jantan</label>
                            <input type="text" class="form-control" name="jantan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option value="">Pilih</option>
                            <option value="jantan">Jantan</option>
                            <option value="betina">Betina</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Domba</label>
                        <input type="text" class="form-control" name="nama">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Berat Badan Lahir (Kg)</label>
                        <input type="number" step="0.01" class="form-control" name="bb_lahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Tutup</button><button type="submit"
                        class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Domba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM SEKARANG LANGSUNG AKSI -->
            <form id="editForm" method="POST" action="">
                @csrf
                @method('POST') <!-- kita pakai POST karena route update kita POST -->
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Domba</label>
                        <input type="text" class="form-control" id="edit_jenis" name="jenis" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Lahir</label>
                            <input type="time" class="form-control" id="edit_jam_lahir" name="jam_lahir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Induk</label>
                            <input type="text" class="form-control" id="edit_induk" name="induk">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jantan</label>
                            <input type="text" class="form-control" id="edit_jantan" name="jantan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" id="edit_gender" name="gender">
                            <option value="">Pilih</option>
                            <option value="jantan">Jantan</option>
                            <option value="betina">Betina</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Domba</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Berat Badan Lahir (Kg)</label>
                        <input type="number" step="0.01" class="form-control" id="edit_bb_lahir"
                            name="bb_lahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="2"></textarea>
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
