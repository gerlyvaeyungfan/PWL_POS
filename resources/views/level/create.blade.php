@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('level') }}" class="form-horizontal">
            @csrf
            <!-- Input field untuk level_kode -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Kode Level</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="level_kode" value="{{ old('level_kode') }}" required>
                    @error('level_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Input field untuk level_nama -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Nama Level</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="level_nama" value="{{ old('level_nama') }}" required>
                    @error('level_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Tombol simpan dan kembali -->
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
