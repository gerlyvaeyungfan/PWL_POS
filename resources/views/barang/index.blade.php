@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Barang</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah Barang</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var dataBarang = $('#table_barang').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('barang/list') }}",
                dataType: "json",
                type: "POST",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori.kategori_nama", // Mengambil nama kategori dari relasi
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_beli",
                    className: "text-right",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_jual",
                    className: "text-right",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        
        $('#barang_id').on('change', function () {
            dataBarang.ajax.reload();
        });

    });
</script>
@endpush