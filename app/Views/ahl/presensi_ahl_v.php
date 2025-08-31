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
                                        <th scope="col">Jenis Pekerjaan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Lain-Lain</th>
                                        <th scope="col">Status Presensi</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Dokumentasi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($presensi_ahl as $presensi_ahl) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $presensi_ahl->nama_lengkap ?></td>
                                            <td><?= $presensi_ahl->jenis_pekerjaan ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d', strtotime($presensi_ahl->tanggal))) ?>, <?= date_indo('Y-m-d', strtotime($presensi_ahl->tanggal)) ?></td>
                                            <td><?= date('H:i', strtotime($presensi_ahl->jam))  ?></td>
                                            <td><?= $presensi_ahl->lokasi ?></td>
                                            <td><?= $presensi_ahl->lain_lain ?></td>
                                            <td><?= $presensi_ahl->status_presensi ?></td>
                                            <td><?= date('H:i', strtotime($presensi_ahl->keterangan))  ?></td>
                                            <td> <a href="../dokumentasi_ahl/<?= $presensi_ahl->dokumentasi ?>" target="_blank" class="btn btn-outline-primary btn-sm">Lihat</a> </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $presensi_ahl->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $presensi_ahl->id ?>" type="button">
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
                        <label for="mitra_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_id" id="mitra_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($mitra_pengajar_ahl as $mitra_ahl) : ?>
                                <option value="<?= $mitra_ahl->mitra_id ?>"><?= $mitra_ahl->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_pekerjaan_id" class="col-form-label">Jenis Pekerjaan :</label>
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
                        <label for="tanggal" class="col-form-label">Tanggal :</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                        <div class="invalid-feedback error-tanggal">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam" class="col-form-label">Jam :</label>
                        <input type="time" name="jam" id="jam" class="form-control" value="<?= date('H:i') ?>">
                        <div class="invalid-feedback error-jam">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_id" class="col-form-label">Lokasi :</label>
                        <select name="lokasi_id" id="lokasi_id" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($lokasi as $lokasi) : ?>
                                <option value="<?= $lokasi->id ?>"><?= $lokasi->lokasi ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-lokasi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lain_lain" class="col-form-label">Lain-Lain :</label>
                        <input type="text" name="lain_lain" id="lain_lain" class="form-control" value="-">
                        <span class="text-danger font-weight-bold">hanya diisi saat lokasi bukan perum casablanca</span>
                        <div class="invalid-feedback error-lain-lain">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_presensi_id" class="col-form-label">Status Presensi :</label>
                        <select name="status_presensi_id" id="status_presensi_id" class="form-select">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($status_presensi as $status_presensi) : ?>
                                <option value="<?= $status_presensi->id ?>"><?= $status_presensi->status_presensi ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-status">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dokumentasi" class="col-form-label">Dokumentasi :</label>
                        <input type="file" name="dokumentasi" id="dokumentasi" class="form-control">
                        <div class="invalid-feedback error-dokumentasi">
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

        $('#jenis_pekerjaan_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#lokasi_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });



        $('#mitra_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });



        $("#add_form").submit(function(e) {
            e.preventDefault();

            let mitra_id = $("#mitra_id").val();
            let jenis_pekerjaan_id = $("#jenis_pekerjaan_id").val();
            let tanggal = $("#tanggal").val();
            let jam = $("#jam").val();
            let lain_lain = $("#lain_lain").val();
            let lokasi_id = $("#lokasi_id").val();
            let status_presensi_id = $("#status_presensi_id").val();
            let dokumentasi = $("#dokumentasi").val();

            let formData = new FormData(this);

            formData.append('mitra_id', mitra_id);
            formData.append('jenis_pekerjaan_id', jenis_pekerjaan_id);
            formData.append('tanggal', tanggal);
            formData.append('jam', jam);
            formData.append('lain_lain', lain_lain);
            formData.append('lokasi_id', lokasi_id);
            formData.append('status_presensi_id', status_presensi_id);
            formData.append('dokumentasi', dokumentasi);

            $.ajax({
                url: '/admin/presensi_ahl/insert',
                data: formData,
                dataType: 'json',
                enctype: 'multipart/form-data',
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false,
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
                            $(".error-mitra").html(response.error.mitra_id);
                        } else {
                            $("#mitra_id").removeClass('is-invalid');
                            $(".error-mitra").html('');
                        }

                        if (response.error.jenis_pekerjaan_id) {
                            $("#jenis_pekerjaan_id").addClass('is-invalid');
                            $(".error-jenis-pekerjaan").html(response.error.jenis_pekerjaan_id);
                        } else {
                            $("#jenis_pekerjaan_id").removeClass('is-invalid');
                            $(".error-jenis-pekerjaan").html('');
                        }

                        if (response.error.tanggal) {
                            $("#tanggal").addClass('is-invalid');
                            $(".error-tanggal").html(response.error.tanggal);
                        } else {
                            $("#tanggal").removeClass('is-invalid');
                            $(".error-tanggal").html('');
                        }

                        if (response.error.jam) {
                            $("#jam").addClass('is-invalid');
                            $(".error-jam").html(response.error.jam);
                        } else {
                            $("#jam").removeClass('is-invalid');
                            $(".error-jam").html('');
                        }

                        if (response.error.lain_lain) {
                            $("#lain_lain").addClass('is-invalid');
                            $(".error-lain-lain").html(response.error.lain_lain);
                        } else {
                            $("#lain_lain").removeClass('is-invalid');
                            $(".error-lain-lain").html('');
                        }
                        if (response.error.lokasi_id) {
                            $("#lokasi_id").addClass('is-invalid');
                            $(".error-lokasi").html(response.error.lokasi_id);
                        } else {
                            $("#lokasi_id").removeClass('is-invalid');
                            $(".error-lokasi").html('');
                        }
                        if (response.error.status_presensi_id) {
                            $("#status_presensi_id").addClass('is-invalid');
                            $(".error-status").html(response.error.status_presensi_id);
                        } else {
                            $("#status_presensi_id").removeClass('is-invalid');
                            $(".error-status").html('');
                        }

                        if (response.error.dokumentasi) {
                            $("#dokumentasi").addClass('is-invalid');
                            $(".error-dokumentasi").html(response.error.dokumentasi);
                        } else {
                            $("#dokumentasi").removeClass('is-invalid');
                            $(".error-dokumentasi").html('');
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
            url: '/admin/presensi_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {


                // $("#id_edit").val(response.mitra_ahl.id);

                // let jenis_layanan_data = `<option value="">--Silahkan Pilih--</option>`;

                // response.layanan.forEach(function(e) {
                //     jenis_layanan_data += `<option value="${e.id}"> ${e.nama_layanan} </option>`
                // });

                // $("#jenis_layanan_id_edit").html(jenis_layanan_data);

                // $("#jenis_layanan_id_edit").val(response.mitra_ahl.jenis_layanan_id).trigger('change');

                // let data_pengajar = `<option value="">--Silahkan Pilih--</option>`;

                // response.pengajar.forEach(function(e) {
                //     data_pengajar += `<option value="${e.id}"> ${e.nama_lengkap} </option>`
                // });

                // $("#mitra_id_edit").html(data_pengajar);

                // $("#mitra_id_edit").val(response.mitra_ahl.mitra_id).trigger('change');

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
            url: '/admin/presensi_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.presensi_ahl.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/presensi_ahl/delete',
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