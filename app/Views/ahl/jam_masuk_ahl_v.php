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
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah Jadwal AHL</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jenis Pekerjaan</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Pulang</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($jadwal_ahl as $jadwal_ahl) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $jadwal_ahl->jenis_pekerjaan ?></td>
                                            <td><?= $jadwal_ahl->jam_masuk_ahl ?></td>
                                            <td><?= $jadwal_ahl->jam_pulang_ahl ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $jadwal_ahl->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $jadwal_ahl->id ?>" type="button">
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
                        <label for="jenis_pekerjaan" class="col-form-label">Jenis Pekerjaan :</label>
                        <select name="jenis_pekerjaan_id" id="jenis_pekerjaan_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($jenis_pekerjaan as $jenis_pekerjaan) : ?>
                                <option value="<?= $jenis_pekerjaan->id ?>"><?= $jenis_pekerjaan->jenis_pekerjaan ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-jenis-pekerjaan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_masuk_ahl" class="col-form-label">Jam Masuk :</label>
                        <input type="time" name="jam_masuk_ahl" id="jam_masuk_ahl" class="form-control">
                        <div class="invalid-feedback error-jam-masuk">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_pulang_ahl" class="col-form-label">Jam Pulang :</label>
                        <input type="time" name="jam_pulang_ahl" id="jam_pulang_ahl" class="form-control">
                        <div class="invalid-feedback error-jam-pulang">
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
                        <label for="jenis_pekerjaan_id_edit" class="col-form-label">Jenis Pekerjaan:</label>
                        <select name="jenis_pekerjaan_id" id="jenis_pekerjaan_id_edit" class="form-control">
                            <option value="">Silahkan Pilih</option>
                        </select>
                        <div class="invalid-feedback error-jenis-pekerjaan-id-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_masuk_ahl_edit" class="col-form-label">Jam Masuk:</label>
                        <input type="time" name="jam_masuk_ahl" id="jam_masuk_ahl_edit" class="form-control">
                        <div class="invalid-feedback error-jam-masuk-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_pulang_ahl_edit" class="col-form-label">Jam pulang:</label>
                        <input type="time" name="jam_pulang_ahl" id="jam_pulang_ahl_edit" class="form-control">
                        <div class="invalid-feedback error-jam-pulang-edit">
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


        $("#add_form").submit(function(e) {
            e.preventDefault();

            let jenis_pekerjaan_id = $("#jenis_pekerjaan_id").val();
            let jam_masuk_ahl = $("#jam_masuk_ahl").val();
            let jam_pulang_ahl = $("#jam_pulang_ahl").val();

            $.ajax({
                url: '/admin/jam_masuk_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    jenis_pekerjaan_id: jenis_pekerjaan_id,
                    jam_masuk_ahl: jam_masuk_ahl,
                    jam_pulang_ahl: jam_pulang_ahl,

                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {

                        if (response.error.jenis_pekerjaan_id) {
                            $("#jenis_pekerjaan_id").addClass('is-invalid');
                            $(".error-jenis-pekerjaan").html(response.error.jenis_pekerjaan_id);
                        } else {
                            $("#jenis_pekerjaan_id").removeClass('is-invalid');
                            $(".error-jenis-pekerjaan").html('');
                        }

                        if (response.error.jam_masuk_ahl) {
                            $("#jam_masuk_ahl").addClass('is-invalid');
                            $(".error-jam-masuk").html(response.error.jam_masuk_ahl);
                        } else {
                            $("#jam_masuk_ahl").removeClass('is-invalid');
                            $(".error-jam-masuk").html('');
                        }

                        if (response.error.jam_pulang_ahl) {
                            $("#jam_pulang_ahl").addClass('is-invalid');
                            $(".error-jam-pulang").html(response.error.jam_pulang_ahl);
                        } else {
                            $("#jam_pulang_ahl").removeClass('is-invalid');
                            $(".error-jam-pulang").html('');
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
            url: '/admin/jam_masuk_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_edit").val(response.jadwal_ahl.id);
                $("#jam_masuk_ahl_edit").val(response.jadwal_ahl.jam_masuk_ahl);
                $("#jam_pulang_ahl_edit").val(response.jadwal_ahl.jam_pulang_ahl);

                let jenis_pekerjaan_data = `<option value="">--Silahkan Pilih--</option>`;

                response.jenis_pekerjaan.forEach(function(e) {
                    jenis_pekerjaan_data += `<option value="${e.id}"> ${e.jenis_pekerjaan} </option>`
                });

                $("#jenis_pekerjaan_id_edit").html(jenis_pekerjaan_data);

                $("#jenis_pekerjaan_id_edit").val(response.jadwal_ahl.jenis_pekerjaan_id).trigger('change');

            }
        });
    });


    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let jenis_pekerjaan_id = $('#jenis_pekerjaan_id_edit').val();
        let jam_masuk_ahl = $('#jam_masuk_ahl_edit').val();
        let jam_pulang_ahl = $('#jam_pulang_ahl_edit').val();

        $.ajax({
            url: '/admin/jam_masuk_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                jenis_pekerjaan_id: jenis_pekerjaan_id,
                jam_masuk_ahl: jam_masuk_ahl,
                jam_pulang_ahl: jam_pulang_ahl,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Ubah');
                $('.update').prop('disabled', false);
                if (response.error) {

                    if (response.error.jenis_pekerjaan_id) {
                        $("#jenis_pekerjaan_id_edit").addClass('is-invalid');
                        $(".error-jenis-pekerjaan-id-edit").html(response.error.jenis_pekerjaan_id);
                    } else {
                        $("#jenis_pekerjaan_id_edit").removeClass('is-invalid');
                        $(".error-jenis-pekerjaan-id-edit").html('');
                    }
                    if (response.error.jam_masuk_ahl) {
                        $("#jam_masuk_ahl_edit").addClass('is-invalid');
                        $(".error-jam-masuk-edit").html(response.error.jam_masuk_ahl);
                    } else {
                        $("#jam_masuk_ahl_edit").removeClass('is-invalid');
                        $(".error-jam-masuk-edit").html('');
                    }
                    if (response.error.jam_pulang_ahl) {
                        $("#jam_pulang_ahl_edit").addClass('is-invalid');
                        $(".error-jam-pulang-edit").html(response.error.jam_pulang_ahl);
                    } else {
                        $("#jam_pulang_ahl_edit").removeClass('is-invalid');
                        $(".error-jam-pulang-edit").html('');
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
            url: '/admin/jam_masuk_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.jadwal_ahl.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/jam_masuk_ahl/delete',
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