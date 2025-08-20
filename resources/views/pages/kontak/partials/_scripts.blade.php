<script>
document.addEventListener("DOMContentLoaded", function() {
    const addForm = document.getElementById('addForm');
    const editForm = document.getElementById('editForm');

    // Handle form submit untuk TAMBAH data
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch('{{ route("kontak.store") }}', {
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
            fetch(`/kontak/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nama').value = data.nama;
                    document.getElementById('edit_no_hp').value = data.no_hp;
                    document.getElementById('edit_jenis').value = data.jenis;
                    document.getElementById('edit_keterangan').value = data.keterangan;
                    editForm.action = `/kontak/${data.id}`;
                });
        });
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