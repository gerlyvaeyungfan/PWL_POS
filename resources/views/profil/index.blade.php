@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Detail Informasi Pribadi Anda</h3>
        <div class="ml-auto">
            <button onclick="modalAction('{{ url('/profil/edit') }}')" class="btn btn-sm btn-primary">
                <i class="fa fa-edit"></i> Edit Profil
            </button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-3">
                @if($user->foto)
                    <img src="{{ asset($user->foto) }}" alt="Foto Profil" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded-circle shadow" style="width: 150px; height: 150px;">
                        <i class="fa fa-user fa-4x"></i>
                    </div>
                @endif
                <h5 class="mt-3">{{ $user->nama }}</h5>
                <span class="badge badge-info">{{ $user->level->level_nama ?? 'Level Tidak Diketahui' }}</span>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <strong><i class="fa fa-user-circle mr-2"></i>Username:</strong>
                    <p class="text-muted mb-0">{{ $user->username }}</p>
                </div>
                <div class="mb-3">
                    <strong><i class="fa fa-id-badge mr-2"></i>Nama Lengkap:</strong>
                    <p class="text-muted mb-0">{{ $user->nama }}</p>
                </div>
                <div class="mb-3">
                    <strong><i class="fa fa-shield-alt mr-2"></i>Level Pengguna:</strong>
                    <p class="text-muted mb-0">{{ $user->level->level_nama ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }
</script>
@endpush