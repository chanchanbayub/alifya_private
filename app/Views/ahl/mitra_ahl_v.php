<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Aksi</h6>
                                </li>
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah <?= $title ?></a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Layanan AHL</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($mitra_pengajar_ahl as $mitra_pengajar_ahl) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $mitra_pengajar_ahl->nama_lengkap ?></td>
                                            <td><?= $mitra_pengajar_ahl->nama_layanan ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $mitra_pengajar_ahl->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $mitra_pengajar_ahl->id ?>" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                    <!-- EndForeach -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<!-- modal save-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">

                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="mitra_id" class="col-form-label">Silahkan Pilih :</label>
                        <select name="mitra_id" id="mitra_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($pengajar as $pengajar) : ?>
                                <option value="<?= $pengajar->id ?>"><?= $pengajar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-pengajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_layanan_id" class="col-form-label">Silahkan Pilih :</label>
                        <select name="jenis_layanan_id" id="jenis_layanan_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($layanan as $layanan) : ?>
                                <option value="<?= $layanan->id ?>"><?= $layanan->nama_layanan ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-layanan">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success save"> <i class="bi bi-arrow-right"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Save -->

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Form <small>Edit <?= $title ?></small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <label for="mitra_id_edit" class="col-form-label"><?= $title ?> :</label>
                        <select name="mitra_id" id="mitra_id_edit" class="form-control">
                            <option value="">Silahkan Pilih</option>
                        </select>
                        <div class="invalid-feedback error-mitra-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_layanan_id_edit" class="col-form-label">Jenis Layanan : </label>
                        <select name="jenis_layanan_id" id="jenis_layanan_id_edit" class="form-control">
                            <option value="">Silahkan Pilih</option>
                        </select>
                        <div class="invalid-feedback error-layanan-edit">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success update"> <i class="bi bi-arrow-right"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Modal-->

<!-- Modal hapus  -->
<div class="modal fade" id="deleteModal" tabindex="0">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form <small> Hapus <?= $title ?> </small></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="delete_form">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_delete" name="id">
                    <div class="modal-body">
                        <p>Apakah Anda Yakin ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"> <i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-danger button_delete"> <i class="bi bi-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End hapus Modal-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $('#mitra_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#jenis_layanan_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#jenis_layanan_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let mitra_id = $("#mitra_id").val();
            let jenis_layanan_id = $("#jenis_layanan_id").val();

            $.ajax({
                url: '/admin/mitra_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    mitra_id: mitra_id,
                    jenis_layanan_id: jenis_layanan_id,

                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {

                        if (response.error.mitra_id) {
                            $("#mitra_id").addClass('is-invalid');
                            $(".error-pengajar").html(response.error.mitra_id);
                        } else {
                            $("#mitra_id").removeClass('is-invalid');
                            $(".error-pengajar").html('');
                        }

                        if (response.error.jenis_layanan_id) {
                            $("#jenis_layanan_id").addClass('is-invalid');
                            $(".error-layanan").html(response.error.jenis_layanan_id);
                        } else {
                            $("#jenis_layanan_id").removeClass('is-invalid');
                            $(".error-layanan").html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: `${response.success}`,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });

    // Aksi Edit 
    $(document).on('click', "#edit", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/mitra_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.mitra_ahl.id);

                let jenis_layanan_data = `<option value="">--Silahkan Pilih--</option>`;

                response.layanan.forEach(function(e) {
                    jenis_layanan_data += `<option value="${e.id}"> ${e.nama_layanan} </option>`
                });

                $("#jenis_layanan_id_edit").html(jenis_layanan_data);

                $("#jenis_layanan_id_edit").val(response.mitra_ahl.jenis_layanan_id).trigger('change');

                let data_pengajar = `<option value="">--Silahkan Pilih--</option>`;

                response.pengajar.forEach(function(e) {
                    data_pengajar += `<option value="${e.id}"> ${e.nama_lengkap} </option>`
                });

                $("#mitra_id_edit").html(data_pengajar);

                $("#mitra_id_edit").val(response.mitra_ahl.mitra_id).trigger('change');

            }
        });
    });


    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let mitra_id = $("#mitra_id_edit").val();
        let jenis_layanan_id = $("#jenis_layanan_id_edit").val();

        $.ajax({
            url: '/admin/mitra_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                mitra_id: mitra_id,
                jenis_layanan_id: jenis_layanan_id,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Ubah');
                $('.update').prop('disabled', false);
                if (response.error) {

                    if (response.error.mitra_id) {
                        $("#mitra_id_edit").addClass('is-invalid');
                        $(".error-mitra-edit").html(response.error.mitra_id);
                    } else {
                        $("#mitra_id_edit").removeClass('is-invalid');
                        $(".error-mitra-edit").html('');
                    }

                    if (response.error.jenis_layanan_id) {
                        $("#jenis_layanan_id_edit").addClass('is-invalid');
                        $(".error-layanan-edit").html(response.error.jenis_layanan_id);
                    } else {
                        $("#jenis_layanan_id_edit").removeClass('is-invalid');
                        $(".error-layanan-edit").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: `Data Belum Tersimpan!`,
                });
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Ubah');
                $('.update').prop('disabled', false);
            }
        });
    });
    // End Aksi

    // Aksi Hapus
    $(document).on('click', "#delete", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/mitra_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.mitra_ahl.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/mitra_ahl/delete',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
            },
            beforeSend: function() {
                $('.button_delete').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.button_delete').prop('disabled', true);
            },
            success: function(response) {
                $('.button_delete').html('<i class="bi bi-trash"></i> Hapus');
                $('.button_delete').prop('disabled', false);

                $("#deleteModal").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                });
                setTimeout(function() {
                    location.reload();
                }, 1000)
            },
            error: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: `Data Gagal di Hapus!`,
                });
                $('.button_delete').html('<i class="bi bi-trash"></i> Hapus');
                $('.button_delete').prop('disabled', false);

            }
        });
    });
    // End Aksi Hapus
</script>

<?= $this->endSection(); ?>