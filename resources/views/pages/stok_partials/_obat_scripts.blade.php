<script>
$(document).ready(function() {
    $('.edit-obat-btn').on('click', function() {
        let id = $(this).data('id');
        $.get(`/obat/${id}`, function(data) {
            $('#edit_obat_nama').val(data.nama_obat);
            $('#edit_obat_fungsi').val(data.fungsi);
            $('#edit_obat_jumlah').val(data.jumlah_stok);
            $('#edit_obat_satuan').val(data.satuan);
            $('#edit_obat_kadaluarsa').val(data.tanggal_kadaluarsa);
            $('#editObatForm').attr('action', `/obat/${id}`);
            $('#editObatModal').modal('show');
        });
    });
    $('#editObatForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
    $('.delete-obat-btn').on('click', function() { let id = $(this).data('id'); $('#deleteObatForm').attr('action', `/obat/${id}`); $('#deleteObatModal').modal('show'); });
    $('#deleteObatForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
});
</script>