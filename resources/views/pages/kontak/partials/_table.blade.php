<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Jenis</th>
                <th>Tanggal Dibuat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kontaks as $kontak)
            <tr>
                <td><strong>#{{ $kontak->id }}</strong></td>
                <td>{{ $kontak->nama }}</td>
                <td>{{ $kontak->no_hp ?? '-' }}</td>
                <td>
                    @if($kontak->jenis == 'pelanggan')
                        <span class="badge bg-primary-subtle text-primary">Pelanggan</span>
                    @else
                        <span class="badge bg-info-subtle text-info">Supplier</span>
                    @endif
                </td>
                <td>{{ $kontak->created_at->format('d M Y') }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $kontak->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    <form action="{{ route('kontak.destroy', $kontak->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kontak ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Belum ada data kontak.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $kontaks->withQueryString()->links() }}
</div>