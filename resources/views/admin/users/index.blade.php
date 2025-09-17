{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-weight: 800;">Manajemen Pengguna</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tab Navigasi --}}
        <ul class="nav nav-tabs mb-3" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                    type="button" role="tab" aria-controls="pending" aria-selected="true">
                    Pengajuan Akses
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button"
                    role="tab" aria-controls="approved" aria-selected="false">
                    Pengguna Aktif
                </button>
            </li>
        </ul>

        <div class="tab-content" id="userTabsContent">
            {{-- TAB PENDING USERS --}}
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                @if ($pendingUsers->isEmpty())
                    <div class="alert alert-info">
                        Tidak ada pengajuan akses saat ini.
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Diajukan Pada</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-check-circle me-1"></i> Setujui
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-x-circle me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            {{-- TAB APPROVED USERS --}}
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                @if ($approvedUsers->isEmpty())
                    <div class="alert alert-secondary">
                        Belum ada pengguna yang disetujui.
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvedUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->status === 'approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            {{-- <td class="text-center">
                                                <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn {{ $user->status === 'approved' ? 'btn-warning' : 'btn-primary' }} btn-sm">
                                                        {{ $user->status === 'approved' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </td> --}}
                                            <td class="text-center">
                                                <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn {{ $user->status === 'active' ? 'btn-warning' : 'btn-primary' }} btn-sm">
                                                        {{ $user->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
