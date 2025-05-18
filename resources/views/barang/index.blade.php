@extends('layouts.template')

@section('content')
@php
    $role = Auth::user()->getRole(); // sesuai dengan pengecekan di middleware
@endphp

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            {{-- Tombol hanya muncul jika role user diizinkan oleh middleware --}}
            @if (in_array($role, ['ADM', 'MNG']))
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
                <button onclick="modalAction('{{ url('barang/create_ajax') }}')" 
                    class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            @endif
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">- Semua -</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori Barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
<!-- SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function modalAction(url = '') {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#myModal').html(response);
                $('#myModal').modal('show');
            },
            error: function(xhr) {
                if (xhr.status === 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Akses Ditolak',
                        text: xhr.responseText || 'Anda tidak memiliki izin.'
                    });
                } else {
                    console.error(xhr);
                }
            }
        });
    }

    var dataBarang;
    $(document).ready(function() {
        dataBarang = $('#table_barang').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('barang/list') }}",
                dataType: 'json',
                type: 'POST',
                data: function (d) {
                    d.kategori_id = $('#kategori_id').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kategori.kategori_nama",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang_kode",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_nama",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_beli",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "harga_jual",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        var role = "{{ $role }}";

                        // Buat elemen sementara dari html tombol yang dikirim server
                        var $container = $('<div>').html(data);

                        // Ambil tombol detail (misal tombol dengan class btn-info)
                        var detailBtn = $container.find('.btn-info').prop('outerHTML') || '';

                        // Ambil tombol edit dan hapus (misal btn-warning dan btn-danger)
                        var editBtn = '';
                        var hapusBtn = '';

                        if (role === 'ADM' || role === 'MNG') {
                            editBtn = $container.find('.btn-warning').prop('outerHTML') || '';
                            hapusBtn = $container.find('.btn-danger').prop('outerHTML') || '';
                        }

                        return detailBtn + ' ' + editBtn + ' ' + hapusBtn;
                    }
                }
            ]
        });

        $('#kategori_id').on('change', function () {
            dataBarang.ajax.reload();
        });
    });
</script>
@endpush
