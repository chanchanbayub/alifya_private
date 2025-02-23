<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active">Jadwal Tetap Mitra</li>
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
                                        <th scope="col">Hari</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col">Jam Belajar</th>
                                        <th scope="col">Status Murid</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($jadwal_tetap as $jadwal) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $jadwal->nama_hari ?></td>
                                            <td><?= $jadwal->nama_lengkap ?></td>
                                            <td><?= $jadwal->nama_lengkap_anak ?></td>
                                            <td><?= $jadwal->jam_belajar ?></td>
                                            <td> <span class='<?= ($jadwal->status_murid_id == 1) ? "badge bg-success" : "badge bg-warning" ?>'><?= $jadwal->status_murid ?></span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $jadwal->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $jadwal->id ?>" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                        <label for="hari_id" class="col-form-label">Pilih Hari :</label>
                        <select name="hari_id" id="hari_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($hari_belajar as $hari) : ?>
                                <option value="<?= $hari->id ?>"><?= $hari->nama_hari ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-hari">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id" class="col-form-label">Pilih Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                                <option value="<?= $mitra_pengajar->id ?>"><?= $mitra_pengajar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="peserta_didik_id" class="col-form-label">Pilih Mitra Pengajar :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id" class="form-control" disabled>
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-peserta">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_belajar" class="col-form-label">Jam Belajar :</label>
                        <input type="time" name="jam_belajar" id="jam_belajar" class="form-control">
                        <div class="invalid-feedback error-jam">
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
                        <label for="hari_id_edit" class="col-form-label">Pilih Hari :</label>
                        <select name="hari_id" id="hari_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-hari-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id_edit" class="col-form-label">Pilih Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-mitra-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="peserta_didik_id_edit" class="col-form-label">Pilih Mitra Pengajar :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-peserta-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_belajar_edit" class="col-form-label">Jam Belajar :</label>
                        <input type="time" name="jam_belajar" id="jam_belajar_edit" class="form-control">
                        <div class="invalid-feedback error-jam-edit">
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

        $('#hari_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_pengajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#hari_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#mitra_pengajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#peserta_didik_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#mitra_pengajar_id').change(function(e) {
            e.preventDefault();
            let mitra_pengajar_id = $(this).val();

            $.ajax({
                url: '/admin/jadwal_tetap/getPesertaDidik',
                method: 'get',
                dataType: 'JSON',
                data: {
                    mitra_pengajar_id: mitra_pengajar_id,
                },
                success: function(response) {
                    let peserta_didik = `<option value="">--Silahkan Pilih-- </option>`;

                    if (response.peserta_didik.length >= 1) {
                        response.peserta_didik.forEach(function(e) {
                            $("#peserta_didik_id").removeAttr('disabled', false);
                            peserta_didik += `<option value="${e.peserta_didik_id}"> ${e.nama_lengkap_anak} </option>`;
                            // console.log(e.id);
                        });
                    } else {
                        $("#peserta_didik_id").attr('disabled', 'disabled');
                        $("#peserta_didik_id").html(peserta_didik);
                    }
                    $("#peserta_didik_id").html(peserta_didik);

                },
            });
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let hari_id = $("#hari_id").val();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let peserta_didik_id = $("#peserta_didik_id").val();
            let jam_belajar = $("#jam_belajar").val();

            $.ajax({
                url: '/admin/jadwal_tetap/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    hari_id: hari_id,
                    mitra_pengajar_id: mitra_pengajar_id,
                    peserta_didik_id: peserta_didik_id,
                    jam_belajar: jam_belajar,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.hari_id) {
                            $("#hari_id").addClass('is-invalid');
                            $(".error-hari").html(response.error.hari_id);
                        } else {
                            $("#hari_id").removeClass('is-invalid');
                            $(".error-hari").html('');
                        }

                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra").html('');
                        }

                        if (response.error.peserta_didik_id) {
                            $("#peserta_didik_id").addClass('is-invalid');
                            $(".error-peserta").html(response.error.peserta_didik_id);
                        } else {
                            $("#peserta_didik_id").removeClass('is-invalid');
                            $(".error-peserta").html('');
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
            url: '/admin/jadwal_tetap/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                // console.log(response.mitra_pengajar);
                $("#id_edit").val(response.jadwal_tetap.id);
                $("#jam_belajar_edit").val(response.jadwal_tetap.jam_belajar);

                let hari = `<option value="">--Silahkan Pilih--</option>`;

                if (response.hari.length >= 1) {
                    response.hari.forEach(function(e) {
                        hari += `<option value="${e.id}"> ${e.nama_hari} </option>`;
                    });
                    $("#hari_id_edit").html(hari);
                } else {
                    $("#hari_id_edit").attr('disabled', 'disabled');
                    $("#hari_id_edit").html(hari);
                }

                $("#hari_id_edit").val(response.jadwal_tetap.hari_id).trigger('change');

                let mitra_pengajar = `<option value="">--Silahkan Pilih--</option>`;

                if (response.mitra_pengajar.length >= 1) {
                    response.mitra_pengajar.forEach(function(e) {
                        mitra_pengajar += `<option value="${e.id}"> ${e.nama_lengkap} </option>`;
                    });
                    $("#mitra_pengajar_id_edit").html(mitra_pengajar);
                } else {
                    $("#mitra_pengajar_id_edit").attr('disabled', 'disabled');
                    $("#mitra_pengajar_id_edit").html(mitra_pengajar);
                }

                $("#mitra_pengajar_id_edit").val(response.jadwal_tetap.mitra_pengajar_id).trigger('change');

                let peserta_didik = `<option value="">--Silahkan Pilih--</option>`;

                if (response.peserta_didik.length >= 1) {
                    response.peserta_didik.forEach(function(e) {
                        $("#peserta_didik_id_edit").removeAttr('disabled', false);
                        peserta_didik += `<option value="${e.peserta_didik_id}"> ${e.nama_lengkap_anak} </option>`;
                    });
                    $("#peserta_didik_id_edit").html(peserta_didik);
                } else {
                    $("#peserta_didik_id_edit").attr('disabled', 'disabled');
                    $("#peserta_didik_id_edit").html(peserta_didik);
                }

                $("#peserta_didik_id_edit").val(response.jadwal_tetap.peserta_didik_id).trigger('change');

            }
        });
    });

    // $('#mitra_pengajar_id_edit').on('change', function(e) {
    //     e.preventDefault();
    //     let mitra_pengajar_id = $(this).val();

    //     $.ajax({
    //         url: '/admin/jadwal_tetap/getPesertaDidik',
    //         method: 'get',
    //         dataType: 'JSON',
    //         data: {
    //             mitra_pengajar_id: mitra_pengajar_id,
    //         },
    //         success: function(response) {
    //             let peserta_didik = `<option value="">--Silahkan Pilih-- </option>`;

    //             if (response.peserta_didik.length >= 1) {
    //                 response.peserta_didik.forEach(function(e) {
    //                     $("#peserta_didik_id_edit").removeAttr('disabled', false);
    //                     peserta_didik += `<option value="${e.peserta_didik_id}"> ${e.nama_lengkap_anak} </option>`;
    //                 });
    //             } else {
    //                 $("#peserta_didik_id_edit").attr('disabled', 'disabled');
    //                 $("#peserta_didik_id_edit").html(peserta_didik);
    //             }
    //             $("#peserta_didik_id_edit").html(peserta_didik);

    //         },
    //     });
    // });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let hari_id = $('#hari_id_edit').val();
        let mitra_pengajar_id = $('#mitra_pengajar_id_edit').val();
        let peserta_didik_id = $('#peserta_didik_id_edit').val();
        let jam_belajar = $('#jam_belajar_edit').val();

        $.ajax({
            url: '/admin/jadwal_tetap/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                hari_id: hari_id,
                mitra_pengajar_id: mitra_pengajar_id,
                peserta_didik_id: peserta_didik_id,
                jam_belajar: jam_belajar,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.hari) {
                        $("#hari_edit").addClass('is-invalid');
                        $(".error-hari-edit").html(response.error.hari);
                    } else {
                        $("#hari_edit").removeClass('is-invalid');
                        $(".error-hari-edit").html('');
                    }
                    if (response.error.mitra_pengajar_id) {
                        $("#mitra_pengajar_id_edit").addClass('is-invalid');
                        $(".error-mitra-edit").html(response.error.mitra_pengajar_id);
                    } else {
                        $("#mitra_pengajar_id_edit").removeClass('is-invalid');
                        $(".error-mitra-edit").html('');
                    }
                    if (response.error.peserta_didik_id) {
                        $("#peserta_didik_id_edit").addClass('is-invalid');
                        $(".error-peserta-edit").html(response.error.peserta_didik_id);
                    } else {
                        $("#peserta_didik_id_edit").removeClass('is-invalid');
                        $(".error-peserta-edit").html('');
                    }
                    if (response.error.jam_belajar) {
                        $("#jam_belajar_edit").addClass('is-invalid');
                        $(".error-jam-edit").html(response.error.jam_belajar);
                    } else {
                        $("#jam_belajar_edit").removeClass('is-invalid');
                        $(".error-jam-edit").html('');
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
    });
    // End Aksi

    // Aksi Hapus
    $(document).on('click', "#delete", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/jadwal_tetap/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.jadwal_tetap.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/jadwal_tetap/delete',
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