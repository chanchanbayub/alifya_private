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
                            <h5 class="card-title">Cek Upah Mitra AHL</h5>
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" id="cek_harga_perbulan">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
                                    <label for="bulan_table" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan_table" id="bulan_table" class="form-control">
                                    <div class="invalid-feedback error-bulan-table">
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

                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Bulan Tersebut </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col"><?= $title ?></th>
                                        <th scope="col">Status Murid</th>
                                    </tr>
                                </thead>
                                <tbody id="harga_table_data">
                                    <tr>
                                        <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div><!-- End Recent Sales -->

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
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateHargaModal"><i class="bi bi-plus"></i> Update Harga Bulan Ini</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Upah Mitra AHL</th>
                                        <th scope="col">Lain-Lain</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
                <!-- End Recent Sales -->





            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="updateHargaModal" tabindex="-1" aria-labelledby="updateHargaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateHargaModalLabel">Update Upah Peserta Didik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update_harga_form">
                    <div class="mb-3">
                        <label for="bulan_data" class="col-form-label">Silahkan Pilih Bulan Sebelumnya :</label>
                        <input type="month" name="bulan" id="bulan_data" class="form-control">
                        <div class="invalid-feedback error-bulan-data">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_data_update" class="col-form-label">Silahkan Pilih Bulan Sekarang :</label>
                        <input type="month" name="bulan_update" id="bulan_data_update" class="form-control">
                        <div class="invalid-feedback error-bulan-data-update">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success update"> <i class="bi bi-arrow-right"></i> Update Upah Peserta</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
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
                        <label for="mitra_ahl_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_ahl_id" id="mitra_ahl_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>

                            <?php foreach ($mitra_pengajar_ahl as $mitra_pengajar_ahl) : ?>
                                <option value="<?= $mitra_pengajar_ahl->mitra_id ?>"><?= $mitra_pengajar_ahl->nama_lengkap ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback error-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan :</label>
                        <input type="month" name="bulan" id="bulan" class="form-control">
                        <div class="invalid-feedback error-bulan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="upah_mitra" class="col-form-label">Upah Mitra :</label>
                        <input type="number" class="form-control" id="upah_mitra" name="upah_mitra" placeholder="50000">
                        <div class="invalid-feedback error-upah-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lain_lain" class="col-form-label">Lain Lain :</label>
                        <input type="number" class="form-control" id="lain_lain" name="lain_lain" placeholder="50000">
                        <div class="invalid-feedback error-lain-lain">
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
                            <label for="mitra_ahl_id_edit" class="col-form-label">Mitra Pengajar :</label>
                            <select name="mitra_ahl_id" id="mitra_ahl_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>


                            </select>
                            <div class="invalid-feedback error-mitra-edit">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_edit" class="form-label">Pilih Bulan :</label>
                        <input type="date" name="bulan" id="bulan_edit" class="form-control">
                        <div class="invalid-feedback error-bulan-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="upah_mitra_edit" class="col-form-label">Upah Mitra :</label>
                        <input type="number" class="form-control" id="upah_mitra_edit" name="upah_mitra" placeholder="50000">
                        <div class="invalid-feedback error-upah-mitra-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lain_lain_edit" class="col-form-label">Lain Lain :</label>
                        <input type="number" class="form-control" id="lain_lain_edit" name="lain_lain" placeholder="50000">
                        <div class="invalid-feedback error-lain-lain-edit">
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

<!-- Notification Modal -->
<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 badge text-bg-danger" id="exampleModalLabel">Perhatian !! </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-body-secondary" style="text-align: justify;">Sebelum melakukan update harga, diharapkan melakukan pengecekan terlebih dahulu pada halaman ini, dengan menggunakan fitur filter !!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Ok, mengerti</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/upah_mitra_ahl/getUpahAhl',
                method: 'POST'
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: true
                },
                {
                    data: 'nama_lengkap',
                },
                {
                    data: 'bulan',
                },

                {
                    data: 'upah_mitra',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'lain_lain',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },

                {
                    data: 'action',
                    orderable: false
                },

            ],
        });

        $("#notifModal").modal('show');

    });

    $(document).ready(function(e) {

        $('#mitra_ahl_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_ahl_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });



        $("#add_form").submit(function(e) {
            e.preventDefault();

            let mitra_ahl_id = $("#mitra_ahl_id").val();
            let bulan = $("#bulan").val();
            let upah_mitra = $("#upah_mitra").val();
            let lain_lain = $("#lain_lain").val();

            $.ajax({
                url: '/admin/upah_mitra_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    mitra_ahl_id: mitra_ahl_id,
                    bulan: bulan,
                    upah_mitra: upah_mitra,
                    lain_lain: lain_lain,

                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.mitra_ahl_id) {
                            $("#mitra_ahl_id").addClass('is-invalid');
                            $(".error-mitra").html(response.error.mitra_ahl_id);
                        } else {
                            $("#mitra_ahl_id").removeClass('is-invalid');
                            $(".error-mitra").html('');
                        }

                        if (response.error.bulan) {
                            $("#bulan").addClass('is-invalid');
                            $(".error-bulan").html(response.error.bulan);
                        } else {
                            $("#bulan").removeClass('is-invalid');
                            $(".error-bulan").html('');
                        }

                        if (response.error.upah_mitra) {
                            $("#upah_mitra").addClass('is-invalid');
                            $(".error-upah-mitra").html(response.error.upah_mitra);
                        } else {
                            $("#upah_mitra").removeClass('is-invalid');
                            $(".error-upah-mitra").html('');
                        }
                        if (response.error.lain_lain) {
                            $("#lain_lain").addClass('is-invalid');
                            $(".error-lain-lain").html(response.error.lain_lain);
                        } else {
                            $("#lain_lain").removeClass('is-invalid');
                            $(".error-lain-lain").html('');
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
            url: '/admin/upah_mitra_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,

            },
            success: function(response) {
                // console.log(response);
                $("#id_edit").val(response.upah_mitra.id);
                $("#bulan_edit").val(response.upah_mitra.bulan);
                $("#upah_mitra_edit").val(response.upah_mitra.upah_mitra);
                $("#lain_lain_edit").val(response.upah_mitra.lain_lain);


                let mitra_ahl_data = `<option value="">--Silahkan Pilih--</option>`;

                response.mitra_ahl.forEach(function(e) {
                    mitra_ahl_data += `<option value="${e.mitra_id}"> ${e.nama_lengkap} </option>`
                });

                $("#mitra_ahl_id_edit").html(mitra_ahl_data);

                $("#mitra_ahl_id_edit").val(response.upah_mitra.mitra_ahl_id).trigger('change');


            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_edit").val();
        let mitra_ahl_id = $("#mitra_ahl_id_edit").val();
        let bulan = $("#bulan_edit").val();
        let upah_mitra = $("#upah_mitra_edit").val();
        let lain_lain = $("#lain_lain_edit").val();

        $.ajax({
            url: '/admin/upah_mitra_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                mitra_ahl_id: mitra_ahl_id,
                bulan: bulan,
                upah_mitra: upah_mitra,
                lain_lain: lain_lain,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.mitra_ahl_id) {
                        $("#mitra_ahl_id_edit").addClass('is-invalid');
                        $(".error-mitra-edit").html(response.error.mitra_ahl_id);
                    } else {
                        $("#mitra_ahl_id_edit").removeClass('is-invalid');
                        $(".error-mitra-edit").html('');
                    }

                    if (response.error.bulan) {
                        $("#bulan_edit").addClass('is-invalid');
                        $(".error-bulan-edit").html(response.error.bulan);
                    } else {
                        $("#bulan_edit").removeClass('is-invalid');
                        $(".error-bulan-edit").html('');
                    }

                    if (response.error.upah_mitra) {
                        $("#upah_mitra_edit").addClass('is-invalid');
                        $(".error-upah-mitra-edit").html(response.error.upah_mitra);
                    } else {
                        $("#upah_mitra_edit").removeClass('is-invalid');
                        $(".error-upah-mitra-edit").html('');
                    }
                    if (response.error.lain_lain) {
                        $("#lain_lain_edit").addClass('is-invalid');
                        $(".error-lain-lain-edit").html(response.error.lain_lain);
                    } else {
                        $("#lain_lain_edit").removeClass('is-invalid');
                        $(".error-lain-lain-edit").html('');
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
            url: '/admin/upah_mitra_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.upah_mitra.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/upah_mitra_ahl/delete',
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

    $("#update_harga_form").submit(function(e) {
        e.preventDefault();
        let bulan = $("#bulan_data").val();
        let bulan_update = $("#bulan_data_update").val();

        $.ajax({
            url: '/admin/harga/update_harga',
            method: 'post',
            dataType: 'JSON',
            data: {
                bulan: bulan,
                bulan_update: bulan_update,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Update Upah Peserta');
                $('.update').prop('disabled', false);
                if (response.error) {

                    if (response.error.bulan) {
                        $("#bulan_data").addClass('is-invalid');
                        $(".error-bulan-data").html(response.error.bulan);
                    } else {
                        $("#bulan_data").removeClass('is-invalid');
                        $(".error-bulan-data").html('');
                    }
                    if (response.error.bulan_update) {
                        $("#bulan_data_update").addClass('is-invalid');
                        $(".error-bulan-data-update").html(response.error.bulan_update);
                    } else {
                        $("#bulan_data_update").removeClass('is-invalid');
                        $(".error-bulan-data-update").html('');
                    }

                    if (response.error.data) {
                        Swal.fire({
                            icon: 'error',
                            title: `${response.error.data}`,
                        });
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
    })

    $(document).ready(function(e) {
        $("#cek_harga_perbulan").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan_table").val();
            $.ajax({
                url: '/admin/harga/harga_perbulan',
                data: {
                    bulan: bulan
                },
                dataType: 'json',
                type: 'POST',
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    let no = 1;
                    let table_data = ``;
                    $('.save').html('<i class="bi bi-search"></i> Search');
                    $('.save').prop('disabled', false);
                    if (response.harga.length >= 1) {
                        response.harga.forEach(function(e) {
                            table_data += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap_anak}</td>
                                <td>${e.bulan}</td>
                                <td>${e.tahun}</td>
                                <td>Rp. ${new Intl.NumberFormat().format(e.harga)} </td>
                                <td>${e.status_murid} </td>
                            </tr>`;
                        });
                        $("#harga_table_data").html(table_data);
                    } else {
                        table_data += `<tr>
                                <td colspan="6" style="text-align:center">Data Tidak ditemukan</td>
                            </tr>`;
                        $("#harga_table_data").html(table_data);
                    }

                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-search"></i> Search');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });
</script>

<?= $this->endSection(); ?>