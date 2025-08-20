{{-- resources/views/pages/keuangan/partials/_table.blade.php --}}
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($keuangan as $item)
            <tr>
                <td><strong>#{{ $item->id }}</strong></td>
                <td>
                    @if($item->jenis == 'pemasukan')
                        <span class="badge bg-success-subtle text-success">Pemasukan</span>
                    @else
                        <span class="badge bg-danger-subtle text-danger">Pengeluaran</span>
                    @endif
                </td>
                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $keuangan->links() }}
</div>