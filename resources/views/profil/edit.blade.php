<!-- Modal wrapper -->
<div id="modal-master" class="modal-dialog modal-md" role="document" style="margin: 100px auto;">
    <div class="modal-content bg-white">
        <form id="form-edit-profil" method="POST" action="{{ url('/profil/update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="close" id="close-and-redirect" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
                    <span class="text-danger error-text" id="error-username"></span>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}">
                    <span class="text-danger error-text" id="error-nama"></span>
                </div>

                <div class="form-group">
                    <label>Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                    <span class="text-danger error-text" id="error-password"></span>
                </div>

                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" name="foto" class="form-control">
                    <span class="text-danger error-text" id="error-foto"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalBtn">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>

<script>
    var currentEditProfilAjax = null;

    $(document).ready(function () {
        $("#form-edit-profil").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                password: {
                    minlength: 6,
                    maxlength: 20
                },
                foto: {
                    extension: "jpg|jpeg|png"
                }
            },
            messages: {
                foto: {
                    extension: "Format file harus jpg, jpeg, atau png"
                }
            },
            submitHandler: function (form) {
                if (currentEditProfilAjax) {
                    currentEditProfilAjax.abort();
                }

                currentEditProfilAjax = $.ajax({
                    url: form.action,
                    type: form.method,
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (key, val) {
                                $('#error-' + key).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        if (status !== 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menyimpan data.'
                            });
                        }
                    }
                });

                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#closeModalBtn, #close-and-redirect').on('click', function () {
            if (currentEditProfilAjax) {
                currentEditProfilAjax.abort();
            }
            $('#myModal').modal('hide');
            location.reload();
        });
    });
</script>
