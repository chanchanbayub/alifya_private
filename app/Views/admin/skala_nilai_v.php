<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Skala Nilai APR</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active">Skala Nilai APR</li>
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
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah Skala Nilai</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Skala Nilai APR <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Bobot</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($skala_nilai as $skala_nilai) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $skala_nilai->nama_kategori_apr ?></td>
                                            <td><?= $skala_nilai->nilai ?></td>
                                            <td><?= $skala_nilai->bobot ?>%</td>
                                            <td><?= $skala_nilai->keterangan ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $skala_nilai->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $skala_nilai->id ?>" type="button">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori APR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="kategori_apr_id" class="col-form-label">Nama Kategori :</label>
                        <select name="kategori_apr_id" id="kategori_apr_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($kategori_apr as $kategori) : ?>
                                <option value="<?= $kategori->id ?> ?>"><?= $kategori->nama_kategori_apr ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-kategori">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="col-form-label">Nilai :</label>
                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="cth. 1">
                        <div class="invalid-feedback error-nilai">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="col-form-label">Bobot :</label>
                        <input type="text" class="form-control" id="bobot" name="bobot" placeholder="cth. 10">
                        <div class="invalid-feedback error-bobot">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder=".....">
                        <div class="invalid-feedback error-keterangan">
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
                <h5 class="modal-title"> Form <small>Edit Kategori APR</small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <label for="kategori_apr_id_edit" class="col-form-label">Nama Kategori :</label>
                        <select name="kategori_apr_id" id="kategori_apr_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-kategori-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_edit" class="col-form-label">Nilai :</label>
                        <input type="text" class="form-control" id="nilai_edit" name="nilai" placeholder="cth. 1">
                        <div class="invalid-feedback error-nilai-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bobot_edit" class="col-form-label">Bobot :</label>
                        <input type="text" class="form-control" id="bobot_edit" name="bobot" placeholder="cth. 10">
                        <div class="invalid-feedback error-bobot-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan_edit" class="col-form-label">Keterangan :</label>
                        <input type="text" class="form-control" id="keterangan_edit" name="keterangan" placeholder=".....">
                        <div class="invalid-feedback error-keterangan-edit">
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
                <h5 class="modal-title">Form <small> Hapus Hari Belajar </small></h5>
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

        $('#kategori_apr_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let kategori_apr_id = $("#kategori_apr_id").val();
            let nilai = $("#nilai").val();
            let bobot = $("#bobot").val();
            let keterangan = $("#keterangan").val();

            $.ajax({
                url: '/admin/skala_nilai_apr/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    kategori_apr_id: kategori_apr_id,
                    nilai: nilai,
                    bobot: bobot,
                    keterangan: keterangan,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.kategori_apr_id) {
                            $("#kategori_apr_id").addClass('is-invalid');
                            $(".error-kategori").html(response.error.kategori_apr_id);
                        } else {
                            $("#kategori_apr_id").removeClass('is-invalid');
                            $(".error-kategori").html('');
                        }

                        if (response.error.bobot) {
                            $("#bobot").addClass('is-invalid');
                            $(".error-bobot").html(response.error.bobot);
                        } else {
                            $("#bobot").removeClass('is-invalid');
                            $(".error-bobot").html('');
                        }

                        if (response.error.nilai) {
                            $("#nilai").addClass('is-invalid');
                            $(".error-nilai").html(response.error.nilai);
                        } else {
                            $("#nilai").removeClass('is-invalid');
                            $(".error-nilai").html('');
                        }
                        if (response.error.keterangan) {
                            $("#keterangan").addClass('is-invalid');
                            $(".error-keterangan").html(response.error.keterangan);
                        } else {
                            $("#keterangan").removeClass('is-invalid');
                            $(".error-keterangan").html('');
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
            url: '/admin/skala_nilai_apr/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                // console.log(response);
                $("#id_edit").val(response.skala_nilai.id);
                $("#bobot_edit").val(response.skala_nilai.bobot);
                $("#nilai_edit").val(response.skala_nilai.nilai);
                $("#keterangan_edit").val(response.skala_nilai.keterangan);

                let kategori = `<option value="">--Silahkan Pilih--</option>`;

                response.kategori_apr.forEach(function(e) {
                    kategori
                        += `<option value="${e.id}"> ${e.nama_kategori_apr} </option>`
                });

                $("#kategori_apr_id_edit").html(kategori);

                $("#kategori_apr_id_edit").val(response.skala_nilai.kategori_apr_id).trigger('change');

            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let kategori_apr_id = $("#kategori_apr_id_edit").val();
        let nilai = $("#nilai_edit").val();
        let bobot = $("#bobot_edit").val();
        let keterangan = $("#keterangan_edit").val();

        $.ajax({
            url: '/admin/skala_nilai_apr/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                kategori_apr_id: kategori_apr_id,
                nilai: nilai,
                bobot: bobot,
                keterangan: keterangan,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.kategori_apr_id) {
                        $("#kategori_apr_id_edit").addClass('is-invalid');
                        $(".error-kategori-edit").html(response.error.kategori_apr_id);
                    } else {
                        $("#kategori_apr_id_edit").removeClass('is-invalid');
                        $(".error-kategori-edit").html('');
                    }

                    if (response.error.bobot) {
                        $("#bobot_edit").addClass('is-invalid');
                        $(".error-bobot-edit").html(response.error.bobot);
                    } else {
                        $("#bobot_edit").removeClass('is-invalid');
                        $(".error-bobot-edit").html('');
                    }

                    if (response.error.nilai) {
                        $("#nilai_edit").addClass('is-invalid');
                        $(".error-nilai-edit").html(response.error.nilai);
                    } else {
                        $("#nilai_edit").removeClass('is-invalid');
                        $(".error-nilai-edit").html('');
                    }
                    if (response.error.keterangan) {
                        $("#keterangan_edit").addClass('is-invalid');
                        $(".error-keterangan-edit").html(response.error.keterangan);
                    } else {
                        $("#keterangan_edit").removeClass('is-invalid');
                        $(".error-keterangan-edit").html('');
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
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
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
            url: '/admin/skala_nilai_apr/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.skala_nilai.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/skala_nilai_apr/delete',
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