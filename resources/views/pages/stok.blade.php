@extends('layouts.app')
@section('title', 'Manajemen Stok')

@section('content')
    <h1 class="h3 mb-4 text-gray-800" style="font-weight: 700;">Manajemen Stok</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <!-- Navigasi Tabs -->
    <ul class="nav nav-tabs mb-3" id="stokTab" role="tablist">
        <li class="nav-item" role="presentation"><button class="nav-link active" id="domba-tab" data-bs-toggle="tab" data-bs-target="#domba-pane" type="button">🐑 Stok Domba</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" id="pakan-tab" data-bs-toggle="tab" data-bs-target="#pakan-pane" type="button">🌾 Stok Pakan</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" id="obat-tab" data-bs-toggle="tab" data-bs-target="#obat-pane" type="button">💊 Stok Obat</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" id="peralatan-tab" data-bs-toggle="tab" data-bs-target="#peralatan-pane" type="button">🛠️ Stok Peralatan</button></li>
    </ul>

    <!-- Konten Tabs -->
    <div class="tab-content" id="stokTabContent">
        <!-- Tab Domba -->
        <div class="tab-pane fade show active" id="domba-pane" role="tabpanel">
            @include('pages.stok_partials._domba_tab')
        </div>

        <!-- Tab Pakan -->
        <div class="tab-pane fade" id="pakan-pane" role="tabpanel">
            @include('pages.stok_partials._pakan_tab')
        </div>

        <!-- Tab Obat -->
        <div class="tab-pane fade" id="obat-pane" role="tabpanel">
            @include('pages.stok_partials._obat_tab')
        </div>

        <!-- Tab Peralatan -->
        <div class="tab-pane fade" id="peralatan-pane" role="tabpanel">
            @include('pages.stok_partials._peralatan_tab')
        </div>
    </div>

    <!-- Include Semua Modals -->
    @include('pages.stok_partials._domba_modals')
    @include('pages.stok_partials._pakan_modals')
    @include('pages.stok_partials._obat_modals')
    @include('pages.stok_partials._peralatan_modals')
@endsection

@push('scripts')
    {{-- Include Semua Scripts --}}
    @include('pages.stok_partials._domba_scripts')
    @include('pages.stok_partials._pakan_scripts')
    @include('pages.stok_partials._obat_scripts')
    @include('pages.stok_partials._peralatan_scripts')
@endpush
