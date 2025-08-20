<script>
document.addEventListener("DOMContentLoaded", function() {
    const addForm = document.getElementById('addForm');
    const editForm = document.getElementById('editForm');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const statusSelect = document.getElementById('edit_status');
    const hargaJualWrapper = document.getElementById('harga_jual_wrapper');

    // Handle form submit untuk TAMBAH data
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch('{{ route("domba.store") }}', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
            body: new FormData(this)
        }).then(response => response.json()).then(data => {
            if(data.success) location.reload();
        }).catch(error => console.error('Error:', error));
    });

    // Handle klik tombol EDIT
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/domba/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_jenis').value = data.jenis;
                    document.getElementById('edit_umur').value = data.umur;
                    document.getElementById('edit_harga').value = data.harga;
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('edit_keterangan').value = data.keterangan;
                    
                    // Reset dan cek status saat modal dibuka
                    document.getElementById('edit_harga_jual').value = '';
                    hargaJualWrapper.style.display = data.status === 'terjual' ? 'block' : 'none';
                    
                    editForm.action = `/domba/${data.id}`;
                });
        });
    });

    // Tampilkan/sembunyikan field harga jual berdasarkan status
    statusSelect.addEventListener('change', function() {
        hargaJualWrapper.style.display = this.value === 'terjual' ? 'block' : 'none';
    });

    // Handle form submit untuk UPDATE data
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch(this.action, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
            body: new FormData(this)
        }).then(response => response.json()).then(data => {
            if(data.success) location.reload();
        }).catch(error => console.error('Error:', error));
    });
});
</script>