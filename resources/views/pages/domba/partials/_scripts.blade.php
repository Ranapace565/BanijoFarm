<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addForm = document.getElementById('addForm');
        const editForm = document.getElementById('editForm');
        const editModalEl = document.getElementById('editModal');
        const editModal = new bootstrap.Modal(editModalEl);

        // === HANDLE FORM TAMBAH DATA ===
        // addForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     fetch('{{ route('domba.store') }}', {
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //             'Accept': 'application/json'
        //         },
        //         body: new FormData(this)
        //     }).then(response => response.json()).then(data => {
        //         if (data.success) location.reload();
        //     }).catch(error => console.error('Error:', error));
        // });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/domba/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_jenis').value = data.jenis ?? '';
                        document.getElementById('edit_tanggal_lahir').value = data
                            .tanggal_lahir ?? '';
                        document.getElementById('edit_jam_lahir').value = data.jam_lahir ??
                            '';
                        document.getElementById('edit_induk').value = data.induk ?? '';
                        document.getElementById('edit_jantan').value = data.jantan ?? '';
                        document.getElementById('edit_gender').value = data.gender ?? '';
                        document.getElementById('edit_nama').value = data.nama ?? '';
                        document.getElementById('edit_bb_lahir').value = data.bb_lahir ??
                            '';
                        document.getElementById('edit_keterangan').value = data
                            .keterangan ?? '';

                        document.getElementById('editForm').action =
                            `/domba/${data.id}/update`;
                        const editModal = new bootstrap.Modal(document.getElementById(
                            'editModal'));
                        editModal.show();
                    });
            });
        });


        // === HANDLE KLIK TOMBOL EDIT ===
        // document.querySelectorAll('.edit-btn').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const id = this.getAttribute('data-id');
        //         fetch(`/domba/${id}/edit`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 // isi field edit
        //                 document.getElementById('edit_id').value = data.id;
        //                 document.getElementById('edit_jenis').value = data.jenis ?? '';
        //                 document.getElementById('edit_tanggal_lahir').value = data
        //                     .tanggal_lahir ?? '';
        //                 document.getElementById('edit_jam_lahir').value = data.jam_lahir ??
        //                     '';
        //                 document.getElementById('edit_induk').value = data.induk ?? '';
        //                 document.getElementById('edit_jantan').value = data.jantan ?? '';
        //                 document.getElementById('edit_gender').value = data.gender ?? '';
        //                 document.getElementById('edit_nama').value = data.nama ?? '';
        //                 document.getElementById('edit_bb_lahir').value = data.bb_lahir ??
        //                     '';
        //                 document.getElementById('edit_status').value = data.status ??
        //                     'tersedia';
        //                 document.getElementById('edit_keterangan').value = data
        //                     .keterangan ?? '';

        //                 editForm.setAttribute('data-action', `/domba/${data.id}/update`);
        //                 editModal.show();
        //             });
        //     });
        // });

        // === HANDLE SUBMIT FORM UPDATE ===
        // editForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     const actionUrl = this.getAttribute('data-action');
        //     const formData = new FormData(this);
        //     formData.set('_method', 'PUT'); // spoof method PUT

        //     fetch(actionUrl, {
        //         method: 'POST', // masih POST, tapi _method=PUT dikirim agar route::resource menangkap update()
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //             'Accept': 'application/json'
        //         },
        //         body: formData
        //     }).then(response => {
        //         if (response.redirected) {
        //             window.location.href = response.url;
        //         } else {
        //             return response.json();
        //         }
        //     }).then(data => {
        //         if (data?.success) location.reload();
        //     }).catch(error => console.error('Error:', error));
        // });
    });
</script>
