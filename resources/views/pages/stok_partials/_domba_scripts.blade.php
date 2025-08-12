<script>
$(document).ready(function() {
    // DOMBA CRUD
    $('.edit-domba-btn').on('click', function() {
        let id = $(this).data('id');
        $.get(`/domba/${id}`, function(data) {
            $('#edit_domba_kode').val(data.kode_domba);
            $('#edit_domba_kelamin').val(data.jenis_kelamin);
            $('#edit_domba_tgl_masuk').val(data.tanggal_masuk);
            $('#edit_domba_usia').val(data.usia); // <-- MENGISI INPUT USIA
            $('#edit_domba_ras').val(data.ras);
            $('#edit_domba_status').val(data.status);
            $('#edit_domba_asal').val(data.asal_domba);
            $('#editDombaForm').attr('action', `/domba/${id}`);
            $('#editDombaModal').modal('show');
        });
    });
    $('#editDombaForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
    $('.delete-domba-btn').on('click', function() { let id = $(this).data('id'); $('#deleteDombaForm').attr('action', `/domba/${id}`); $('#deleteDombaModal').modal('show'); });
    $('#deleteDombaForm').on('submit', function(e) { e.preventDefault(); $.ajax({ url: $(this).attr('action'), method: 'POST', data: $(this).serialize(), success: function() { location.reload(); } }); });
});
</script>
