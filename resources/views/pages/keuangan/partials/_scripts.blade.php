{{-- resources/views/pages/keuangan/partials/_scripts.blade.php --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addForm = document.getElementById('addForm');
    const editForm = document.getElementById('editForm');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    // Handle form submit untuk TAMBAH data
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('{{ route("keuangan.store") }}', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload(); // Reload halaman untuk lihat data baru
            }
        });
    });

    // Handle klik tombol EDIT
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            
            // Ambil data dari server
            fetch(`/keuangan/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi form modal edit dengan data
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_jenis').value = data.jenis;
                    document.getElementById('edit_jumlah').value = data.jumlah;
                    document.getElementById('edit_keterangan').value = data.keterangan;
                    
                    // Atur action form sesuai dengan ID
                    editForm.action = `/keuangan/${data.id}`;
                });
        });
    });

    // Handle form submit untuk UPDATE data
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const actionUrl = this.action;
        
        fetch(actionUrl, {
            method: 'POST', // HTML forms don't support PUT, so we use POST and a hidden _method field
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload(); // Reload halaman untuk lihat data yang diupdate
            }
        });
    });
});
</script>