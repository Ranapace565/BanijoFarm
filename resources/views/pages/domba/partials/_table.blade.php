<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>No.Tag</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Tanggal Lahir</th>
                <th>Status</th>
                <th>Pertumbuhan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dombas as $domba)
                <tr>
                    <td><strong>#{{ $domba->id }}</strong></td>
                    <td><strong>#{{ $domba->no_tag }}</strong></td>
                    <td>{{ $domba->jenis }}</td>
                    <td>{{ $domba->nama ?? '-' }}</td>
                    <td>{{ ucfirst($domba->gender ?? '-') }}</td>
                    <td>
                        {{ !empty($domba->tanggal_lahir) && $domba->tanggal_lahir != '-'
                            ? \Carbon\Carbon::parse($domba->tanggal_lahir)->format('d M Y')
                            : '-' }}
                    </td>

                    </td>
                    <td>
                        @if ($domba->status == 'tersedia')
                            <span class="badge bg-success-subtle text-success">Tersedia</span>
                        @elseif($domba->status == 'terjual')
                            <span class="badge bg-warning-subtle text-warning">Terjual</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Mati</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pertumbuhan.index', $domba->id) }}" class="btn btn-sm btn-info">
                            Lihat Pertumbuhan
                        </a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $domba->id }}"
                            data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                        <form action="{{ route('domba.destroy', $domba->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada data domba.</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>
<div class="mt-3">
    {{ $dombas->links() }}
</div>
