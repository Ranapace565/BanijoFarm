<script>
$(document).ready(function() {
    // === LOGIKA CRUD UNTUK PAKAN ===
    
    // Saat tombol edit pakan di klik
    $('.edit-pakan-btn').on('click', function() {
        let id = $(this).data('id');
        
        // Ambil data dari server
        $.get(`/pakan/${id}`, function(data) {
            // Isi form di dalam modal edit pakan
            $('#edit_pakan_nama').val(data.nama_pakan);
            $('#edit_pakan_jumlah').val(data.jumlah_stok);
            $('#edit_pakan_satuan').val(data.satuan);
            $('#edit_pakan_tgl_masuk').val(data.tanggal_masuk);
            $('#edit_pakan_tgl_kadaluarsa').val(data.tanggal_kadaluarsa);
            $('#edit_pakan_supplier').val(data.supplier);
            
            // Set action form secara dinamis
            $('#editPakanForm').attr('action', `/pakan/${id}`);

            // Tampilkan modal
            $('#editPakanModal').modal('show');
        });
    });

    // Saat form edit pakan di-submit
    $('#editPakanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#editPakanModal').modal('hide');
                alert('Stok pakan berhasil diperbarui!');
                location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan. Periksa kembali data Anda.');
            }
        });
    });

    // Saat tombol hapus pakan di klik
    $('.delete-pakan-btn').on('click', function() {
        let id = $(this).data('id');
        $('#deletePakanForm').attr('action', `/pakan/${id}`);
        $('#deletePakanModal').modal('show');
    });

    // Saat form hapus pakan di-submit
    $('#deletePakanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#deletePakanModal').modal('hide');
                alert('Stok pakan berhasil dihapus!');
                location.reload();
            },
            error: function(xhr) {
                alert('Gagal menghapus data pakan.');
            }
        });
    });
});
</script>
