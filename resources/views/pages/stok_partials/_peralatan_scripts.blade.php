<script>
$(document).ready(function() {
    $('.edit-peralatan-btn').on('click', function() {
        let id = $(this).data('id');
        $.get(`/peralatan/${id}`, function(data) {
            $('#edit_peralatan_nama').val(data.nama_alat);
            $('#edit_peralatan_jumlah').val(data.jumlah_unit);
            $('#edit_peralatan_kondisi').val(data.kondisi);
            $('#edit_peralatan_lokasi').val(data.lokasi_penyimpanan);
            $('#editPeralatanForm').attr('action', `/peralatan/${id}`);
            $('#editPeralatanModal').modal('show');
        });
    });
    $('#editPeralatanForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
    $('.delete-peralatan-btn').on('click', function() { let id = $(this).data('id'); $('#deletePeralatanForm').attr('action', `/peralatan/${id}`); $('#deletePeralatanModal').modal('show'); });
    $('#deletePeralatanForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
});
</script>