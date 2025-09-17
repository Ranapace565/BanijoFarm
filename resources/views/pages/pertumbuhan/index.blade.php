@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Monitoring Pertumbuhan - {{ $domba->nama ?? 'Domba #' . $domba->id }}</h3>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPertumbuhanModal">
            + Tambah Data Pertumbuhan
        </button>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Bulan Ke</th>
                        <th>Berat Badan (Kg)</th>
                        <th>Video</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pertumbuhan as $p)
                        <tr>
                            <td>{{ $p->bulan_ke }}</td>
                            <td>{{ $p->berat_badan }}</td>
                            <td>
                                @if ($p->video_url)
                                    <a href="{{ $p->video_url }}" target="_blank" class="btn btn-sm btn-info">Lihat Video</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editPertumbuhanModal{{ $p->id }}">Edit</button>
                                <form action="{{ route('pertumbuhan.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editPertumbuhanModal{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('pertumbuhan.update', $p->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pertumbuhan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Bulan Ke</label>
                                                <input type="number" name="bulan_ke" class="form-control"
                                                    value="{{ $p->bulan_ke }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Berat Badan</label>
                                                <input type="number" name="berat_badan" step="0.01" class="form-control"
                                                    value="{{ $p->berat_badan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Video (Opsional)</label>
                                                <input type="file" name="video" class="form-control" accept="video/*">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data pertumbuhan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addPertumbuhanModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pertumbuhan.store', $domba->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pertumbuhan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Bulan Ke</label>
                            <input type="number" name="bulan_ke" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Berat Badan</label>
                            <input type="number" name="berat_badan" step="0.01" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Video (Opsional)</label>
                            <input type="file" name="video" class="form-control" accept="video/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
