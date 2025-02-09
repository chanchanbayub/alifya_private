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

                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Cek Kontrak Mitra</h5>
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" id="cek_kontrak_mitra">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan Berdasarkan Masa Akhir Kontrak :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control" required>
                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary btn-block search" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cari</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div>
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
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Awal Bergabung</th>
                                        <th scope="col">Akhir Kontrak</th>
                                        <th scope="col">Masa Kerja</th>
                                        <th scope="col">Masa Berlaku Kontrak</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_kontrak_mitra as $kontrak_mitra) : ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $kontrak_mitra["nama_lengkap"] ?></td>
                                            <td><?= bulan(date('n', strtotime($kontrak_mitra["awal_bergabung"]))) ?> <?= $kontrak_mitra["tahun_bergabung"] ?> </td>
                                            <td><?= bulan(date('n', strtotime($kontrak_mitra["akhir_kontrak"]))) ?> <?= $kontrak_mitra["tahun_akhir_kontrak"] ?></td>
                                            <td> <span class="badge text-bg-primary"><?= $kontrak_mitra["masa_kerja"] ?></span> </td>
                                            <td> <span class="badge text-bg-warning"><?= $kontrak_mitra["masa_berlaku_kontrak"] ?></span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $kontrak_mitra["id"] ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $kontrak_mitra["id"] ?>" type="button">
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
                        <label for="mitra_pengajar_id" class="col-form-label">Pilih Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($mitra_pengajar as $mitra) : ?>
                                <option value="<?= $mitra->id ?>"><?= $mitra->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="awal_bergabung" class="col-form-label">Awal Bergabung :</label>
                        <input type="date" name="awal_bergabung" id="awal_bergabung" class="form-control">
                        <div class="invalid-feedback error-awal">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="akhir_kontrak" class="col-form-label">Akhir Kontrak :</label>
                        <input type="date" name="akhir_kontrak" id="akhir_kontrak" class="form-control">
                        <div class="invalid-feedback error-akhir">
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
                    <div class="form_group">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id_edit" name="id">
                            <label for="mitra_pengajar_id_edit" class="col-form-label">Mitra Pengajar :</label>
                            <select name="mitra_pengajar_id" id="mitra_pengajar_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>

                            </select>
                            <div class="invalid-feedback error-mitra-pengajar-edit">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="awal_bergabung_edit" class="col-form-label">Awal Bergabung :</label>
                        <input type="date" name="awal_bergabung" id="awal_bergabung_edit" class="form-control">
                        <div class="invalid-feedback error-awal-bergabung-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="akhir_kontrak_edit" class="col-form-label">Akhir Kontrak:</label>
                        <input type="date" name="akhir_kontrak" id="akhir_kontrak_edit" class="form-control">
                        <div class="invalid-feedback error-akhir-kontrak-edit">
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

<!-- modal save-->
<div class="modal fade" id="kontrakModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Awal Bergabung</th>
                                <th scope="col">Akhir Kontrak</th>
                                <th scope="col">Masa Kerja</th>
                            </tr>
                        </thead>
                        <tbody class="kontrak_table">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Save -->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(e) {

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_pengajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let awal_bergabung = $("#awal_bergabung").val();

            // console.log(awal_bergabung);
            let akhir_kontrak = $("#akhir_kontrak").val();

            $.ajax({
                url: '/admin/kontrak_mitra/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    mitra_pengajar_id: mitra_pengajar_id,
                    awal_bergabung: awal_bergabung,
                    akhir_kontrak: akhir_kontrak,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra").html('');
                        }

                        if (response.error.awal) {
                            $("#awal_bergabung").addClass('is-invalid');
                            $(".error-awal").html(response.error.awal_bergabung);
                        } else {
                            $("#awal_bergabung").removeClass('is-invalid');
                            $(".error-awal").html('');
                        }

                        if (response.error.akhir_kontrak) {
                            $("#akhir_kontrak").addClass('is-invalid');
                            $(".error-akhir").html(response.error.akhir_kontrak);
                        } else {
                            $("#akhir_kontrak").removeClass('is-invalid');
                            $(".error-akhir").html('');
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
            url: '/admin/kontrak_mitra/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,

            },
            success: function(response) {
                // console.log(response);
                $("#id_edit").val(response.kontrak_mitra.id);
                $("#awal_bergabung_edit").val(response.kontrak_mitra.awal_bergabung);
                $("#akhir_kontrak_edit").val(response.kontrak_mitra.akhir_kontrak);


                let mitra_pengajar_data = `<option value="">--Silahkan Pilih--</option>`;

                response.mitra_pengajar.forEach(function(e) {
                    mitra_pengajar_data
                        += `<option value="${e.id}"> ${e.nama_lengkap} </option>`
                });

                $("#mitra_pengajar_id_edit").html(mitra_pengajar_data);

                $("#mitra_pengajar_id_edit").val(response.kontrak_mitra.mitra_pengajar_id).trigger('change');


            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_edit").val();
        let mitra_pengajar_id = $("#mitra_pengajar_id_edit").val();
        let awal_bergabung = $("#awal_bergabung_edit").val();
        let akhir_kontrak = $("#akhir_kontrak_edit").val();

        $.ajax({
            url: '/admin/kontrak_mitra/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                mitra_pengajar_id: mitra_pengajar_id,
                awal_bergabung: awal_bergabung,
                akhir_kontrak: akhir_kontrak,

            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.mitra_pengajar_id) {
                        $("#mitra_pengajar_id_edit").addClass('is-invalid');
                        $(".error-mitra-pengajar-edit").html(response.error.mitra_pengajar_id);
                    } else {
                        $("#mitra_pengajar_id_edit").removeClass('is-invalid');
                        $(".error-mitra-pengajar-edit").html('');
                    }
                    if (response.error.awal_bergabung) {
                        $("#awal_bergabung_edit").addClass('is-invalid');
                        $(".error-awal-bergabung-edit").html(response.error.awal_bergabung);
                    } else {
                        $("#awal_bergabung_edit").removeClass('is-invalid');
                        $(".error-awal-bergabung-edit").html('');
                    }

                    if (response.error.akhir_kontrak) {
                        $("#akhir_kontrak_edit").addClass('is-invalid');
                        $(".error-akhir-kontrak-edit").html(response.error.akhir_kontrak);
                    } else {
                        $("#akhir_kontrak_edit").removeClass('is-invalid');
                        $(".error-akhir-kontrak-edit").html('');
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
            url: '/admin/kontrak_mitra/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.kontrak_mitra.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/kontrak_mitra/delete',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
            },
            beforeSend: function() {
                $('.button_delete').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
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



    $(document).ready(function(e) {
        $("#cek_kontrak_mitra").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();
            $.ajax({
                url: '/admin/kontrak_mitra/kontrak_perbulan',
                data: {
                    bulan: bulan
                },
                dataType: 'json',
                type: 'POST',
                beforeSend: function() {
                    $('.search').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.search').prop('disabled', true);
                },
                success: function(response) {
                    let no = 1;
                    let table_data = ``;
                    $('.search').html('<i class="bi bi-search"></i> Search');
                    $('.search').prop('disabled', false);
                    if (response.kontrak_mitra_data.length >= 1) {
                        $("#kontrakModal").modal('show');
                        response.kontrak_mitra_data.forEach(function(e) {
                            table_data += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap}</td>
                                <td>${e.awal_bergabung}</td>
                                <td>${e.akhir_kontrak}</td>
                                <td> <span class="badge text-bg-primary">${e.masa_kerja}</span></td>
                            </tr>`;
                        });
                        $(".kontrak_table").html(table_data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Data Tidak di Temukan`,
                        });
                    }

                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.search').html('<i class="bi bi-search"></i> Search');
                    $('.search').prop('disabled', false);
                }
            });
        })
    });
</script>

<?= $this->endSection(); ?>