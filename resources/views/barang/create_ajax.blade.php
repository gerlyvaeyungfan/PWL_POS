<form action="{{ url('/barang/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input value="" type="text" name="barang_kode" id="barang_kode" class="form-control" required>
                    <small id="error-barang_kode" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input value="" type="text" name="barang_nama" id="barang_nama" class="form-control" required>
                    <small id="error-barang_nama" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input value="" type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                    <small id="error-harga_beli" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input value="" type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                    <small id="error-harga_jual" class="error-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
    // Inisialisasi form validasi
    $("#form-tambah").validate({
        rules: {
            kategori_id: { required: true, number: true },
            barang_kode: { required: true, minlength: 3, maxlength: 20 },
            barang_nama: { required: true, minlength: 3, maxlength: 100 },
            harga_beli: { required: true, number: true },
            harga_jual: { required: true, number: true }
        },
        submitHandler: function(form) {
            // Mengirim data menggunakan AJAX
            $.ajax({
                url: form.action, // URL untuk mengirim data
                type: form.method, // Method POST
                data: $(form).serialize(), // Serialize form data
                success: function(response) {
                    if (response.status) {
                        // Menutup modal dan memberikan feedback sukses
                        $('#myModal').modal('hide'); // Pastikan id modal sesuai dengan modal Anda
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        // Mengupdate data pada DataTable
                        dataBarang.ajax.reload(); // sesuaikan dengan nama datatable untuk barang
                    } else {
                        // Menampilkan error yang didapat dari response
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal mengirim data, silakan coba lagi!'
                    });
                }
            });
            return false; // Mencegah form submit default
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>