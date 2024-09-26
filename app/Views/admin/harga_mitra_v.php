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
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col"><?= $title ?></th>

                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($harga_perjam as $harga_perjam) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?>.</a></th>
                                            <td> <?= $harga_perjam->nama_lengkap ?></td>
                                            <td><?= $harga_perjam->bulan_mitra ?></td>
                                            <td><?= $harga_perjam->nama_lengkap_anak ?></td>
                                            <td>Rp. <?= number_format($harga_perjam->harga_mitra) ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $harga_perjam->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $harga_perjam->id ?>" type="button">
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
                        <label for="mitra_pengajar_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                                <option value="<?= $mitra_pengajar->id ?>"><?= $mitra_pengajar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra-pengajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="peserta_didik_id" class="form-label">Pilih Peserta Didik :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id" class="form-select" disabled>
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-peserta-didik">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_mitra" class="col-form-label">Bulan :</label>
                        <select name="bulan_mitra" id="bulan_mitra" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <div class="invalid-feedback error-bulan-mitra">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga_mitra" class="col-form-label">Upah Perjam :</label>
                        <input type="number" class="form-control" id="harga_mitra" name="harga_mitra" placeholder="50000">
                        <div class="invalid-feedback error-harga-mitra">
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
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="peserta_didik_id_edit" class="form-label">Pilih Peserta Didik :</label>
                            <select name="peserta_didik_id" id="peserta_didik_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>

                            </select>
                            <div class="invalid-feedback error-peserta-didik-edit">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_mitra_edit" class="col-form-label">Bulan :</label>
                        <select name="bulan_mitra" id="bulan_mitra_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <div class="invalid-feedback error-bulan-mitra-edit">
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="harga_mitra_edit" class="col-form-label"><?= $title ?> :</label>
                        <input type="number" class="form-control" id="harga_mitra_edit" name="harga_mitra">
                        <div class="invalid-feedback error-harga-mitra-edit">

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

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        // $('#peserta_didik_id').select2({
        //     theme: 'bootstrap-5',
        //     dropdownParent: $('#exampleModal')
        // });

        $('#mitra_pengajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#peserta_didik_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#bulan_mitra').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#bulan_mitra_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });



        $("#add_form").submit(function(e) {
            e.preventDefault();

            let harga_mitra = $("#harga_mitra").val();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let peserta_didik_id = $("#peserta_didik_id").val();
            let bulan_mitra = $("#bulan_mitra").val();

            $.ajax({
                url: '/admin/harga_mitra/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    harga_mitra: harga_mitra,
                    mitra_pengajar_id: mitra_pengajar_id,
                    peserta_didik_id: peserta_didik_id,
                    bulan_mitra: bulan_mitra,

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
                            $(".error-mitra-pengajar").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra-pengajar").html('');
                        }
                        if (response.error.peserta_didik_id) {
                            $("#peserta_didik_id").addClass('is-invalid');
                            $(".error-peserta-didik").html(response.error.peserta_didik_id);
                        } else {
                            $("#peserta_didik_id").removeClass('is-invalid');
                            $(".error-peserta-didik").html('');
                        }
                        if (response.error.bulan_mitra) {
                            $("#bulan_mitra").addClass('is-invalid');
                            $(".error-bulan-mitra").html(response.error.bulan_mitra);
                        } else {
                            $("#bulan_mitra").removeClass('is-invalid');
                            $(".error-bulan-mitra").html('');
                        }
                        if (response.error.harga_mitra) {
                            $("#harga_mitra").addClass('is-invalid');
                            $(".error-harga-mitra").html(response.error.harga_mitra);
                        } else {
                            $("#harga_mitra").removeClass('is-invalid');
                            $(".error-harga-mitra").html('');
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
            url: '/admin/harga_mitra/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                console.log(response.harga_mitra);

                $("#id_edit").val(response.harga_mitra.id);
                $("#harga_mitra_edit").val(response.harga_mitra.harga_mitra);

                $("#bulan_mitra_edit").val(response.harga_mitra.bulan_mitra).trigger('change');

                let mitra_pengajar_data = `<option value="">--Silahkan Pilih--</option>`;

                response.mitra_pengajar.forEach(function(e) {
                    mitra_pengajar_data += `<option value="${e.id}"> ${e.nama_lengkap} </option>`
                });

                $("#mitra_pengajar_id_edit").html(mitra_pengajar_data);

                $("#mitra_pengajar_id_edit").val(response.harga_mitra.mitra_pengajar_id).trigger('change');


                let peserta_didik_data = `<option value="">--Silahkan Pilih--</option>`;

                response.murid.forEach(function(e) {
                    peserta_didik_data += `<option value="${e.peserta_didik_id}">${e.nama_lengkap_anak}</option>`;
                });

                $("#peserta_didik_id_edit").html(peserta_didik_data);

                $("#peserta_didik_id_edit").val(response.harga_mitra.peserta_didik_id).trigger('change');

            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let mitra_pengajar_id = $('#mitra_pengajar_id_edit').val();
        let peserta_didik_id = $('#peserta_didik_id_edit').val();
        let bulan_mitra = $('#bulan_mitra_edit').val();
        let harga = $('#harga_mitra_edit').val();

        $.ajax({
            url: '/admin/harga_mitra/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                mitra_pengajar_id: mitra_pengajar_id,
                peserta_didik_id: peserta_didik_id,
                bulan_mitra: bulan_mitra,
                harga_mitra: harga,

            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
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
                    if (response.error.peserta_didik_id) {
                        $("#peserta_didik_id_edit").addClass('is-invalid');
                        $(".error-peserta-didik-edit").html(response.error.peserta_didik_id);
                    } else {
                        $("#peserta_didik_id_edit").removeClass('is-invalid');
                        $(".error-peserta-didik-edit").html('');
                    }
                    if (response.error.bulan_mitra) {
                        $("#bulan_mitra_edit").addClass('is-invalid');
                        $(".error-bulan_mitra-edit").html(response.error.bulan_mitra);
                    } else {
                        $("#bulan_mitra_edit").removeClass('is-invalid');
                        $(".error-bulan_mitra-edit").html('');
                    }

                    if (response.error.harga_mitra) {
                        $("#harga_mitra_edit").addClass('is-invalid');
                        $(".error-harga-mitra-edit").html(response.error.harga_mitra);
                    } else {
                        $("#harga_mitra_edit").removeClass('is-invalid');
                        $(".error-harga-mitra-edit").html('');
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
            url: '/admin/harga_mitra/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.harga_mitra.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/harga_mitra/delete',
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

    $('#mitra_pengajar_id').change(function(e) {
        e.preventDefault();
        let mitra_pengajar_id = $(this).val();

        $.ajax({
            url: '/admin/harga_mitra/getPesertaDidik',
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
</script>

</script>

<?= $this->endSection(); ?>