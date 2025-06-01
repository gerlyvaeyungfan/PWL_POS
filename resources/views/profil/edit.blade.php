<form id="form-edit-profil" method="POST" action="{{ url('/profil/update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input value="{{ $user->username }}" type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input value="{{ $user->nama }}" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Abaikan jika tidak ingin mengubah password</small>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Foto Profil</label>
                    @if($user->foto)
                        <div class="mt-2">
                            <img src="{{ url($user->foto) }}" alt="Foto Profil" class="img-thumbnail" style="width: 150px; height: auto;">
                        </div>
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Abaikan jika tidak ingin mengubah foto</small>
                    <small id="error-foto" class="error-text text-danger"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
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
