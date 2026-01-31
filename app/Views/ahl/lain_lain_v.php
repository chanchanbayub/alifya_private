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
                            <h5 class="card-title">Cek Lain Lain Perbulan (dalam pengembangan) </h5>
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
                                    <button class="btn btn-outline-primary btn-block save" id="cek_data" type="submit" disabled> <i class="bi bi-search"></i> Cari</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Bulan Tersebut (dalam pengembangan) </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Peserta Didik </th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Lain-Lain</th>
                                    </tr>
                                </thead>
                                <tbody id="lain_lain_table_data">
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Tidak Ada Data</td>
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
                                <!-- <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah <?= $title ?></a></li> -->
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateLainLainModal"><i class="bi bi-plus"></i> Update Lain-Lain Bulan Ini</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Peserta Didik </th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Lain-Lain</th>
                                        <th scope="col">Action</th>
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
<div class="modal fade" id="updateLainLainModal" tabindex="-1" aria-labelledby="updateHargaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateHargaModalLabel">Update Lain Lain Peserta Ahl</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update_lain_lain_form">
                    <div class="mb-3">
                        <label for="bulan_update" class="col-form-label">Silahkan Pilih Bulan:</label>
                        <input type="month" name="bulan" id="bulan_update" class="form-control">
                        <div class="invalid-feedback error-bulan-update">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success update"> <i class="bi bi-arrow-right"></i> Update Lain Lain Peserta Ahl</button>
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
                        <label for="peserta_didik_ahl_id" class="col-form-label">Peserta Didik AHL :</label>
                        <select name="peserta_didik_ahl_id" id="peserta_didik_ahl_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($peserta_didik_ahl as $peserta_didik_ahl) : ?>
                                <option value="<?= $peserta_didik_ahl->id ?>"><?= $peserta_didik_ahl->nama_lengkap_anak ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-peserta-didik">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan :</label>
                        <input type="month" name="bulan" id="bulan" class="form-control">
                        <div class="invalid-feedback error-bulan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lain_lain" class="col-form-label">lain_lain :</label>
                        <input type="number" class="form-control" id="lain_lain" name="lain_lain" placeholder="50000">
                        <div class="invalid-feedback error-lain-lain">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success simpan"> <i class="bi bi-arrow-right"></i> Kirim</button>
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
                            <input type="hidden" class="form-control" id="tahun_edit" name="tahun">
                            <label for="peserta_didik_ahl_id_edit" class="col-form-label">Peserta Didik AHL :</label>
                            <select name="peserta_didik_ahl_id" id="peserta_didik_ahl_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>

                            </select>
                            <div class="invalid-feedback error-peserta-didik-ahl-edit">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_data_edit" class="form-label">Pilih Bulan :</label>
                        <select name="bulan" id="bulan_data_edit" class="form-control">
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
                        <div class="invalid-feedback error-bulan-edit">
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="lain_lain_edit" class="col-form-label">Lain-Lain:</label>
                        <input type="number" class="form-control" id="lain_lain_edit" name="lain_lain">
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
                <p class="text-body-secondary" style="text-align: justify;">Sebelum melakukan update lain-lain, diharapkan melakukan pengecekan terlebih dahulu pada halaman ini, dengan menggunakan fitur filter !!</p>
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
                url: '/admin/lain_lain_peserta_ahl/getLainLain',
                method: 'POST'
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: true
                },
                {
                    data: 'nama_lengkap_anak',
                },
                {
                    data: 'bulan',
                },
                {
                    data: 'tahun',
                },
                {
                    data: 'lain_lain',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },

                {
                    data: 'action',
                    orderable: false
                },

            ],
        });

        $('#peserta_didik_ahl_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#peserta_didik_ahl_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#bulan_data').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#updateLainLainModal')
        });

        $('#bulan_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        // $("#notifModal").modal('show');

    });

    $(document).ready(function(e) {


    });

    $("#add_form").submit(function(e) {
        e.preventDefault();

        let peserta_didik_ahl_id = $("#peserta_didik_ahl_id").val();
        let bulan = $("#bulan").val();
        let lain_lain = $("#lain_lain").val();


        $.ajax({
            url: '/admin/lain_lain_peserta_ahl/insert',
            method: 'post',
            dataType: 'JSON',
            data: {
                peserta_didik_ahl_id: peserta_didik_ahl_id,
                bulan: bulan,
                lain_lain: lain_lain,

            },
            beforeSend: function() {
                $('.simpan').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                $('.simpan').prop('disabled', true);
            },
            success: function(response) {
                $('.simpan').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.simpan').prop('disabled', false);
                if (response.error) {
                    if (response.error.peserta_didik_ahl_id) {
                        $("#peserta_didik_ahl_id").addClass('is-invalid');
                        $(".error-peserta-didik").html(response.error.peserta_didik_ahl_id);
                    } else {
                        $("#peserta_didik_ahl_id").removeClass('is-invalid');
                        $(".error-peserta-didik").html('');
                    }

                    if (response.error.bulan) {
                        $("#bulan").addClass('is-invalid');
                        $(".error-bulan").html(response.error.bulan);
                    } else {
                        $("#bulan").removeClass('is-invalid');
                        $(".error-bulan").html('');
                    }

                    if (response.error.lain_lain) {
                        $("#lain_lain").addClass('is-invalid');
                        $(".error-lain-lain").html(response.error.lain_lain);
                    } else {
                        $("#lain_lain").removeClass('is-invalid');
                        $(".error-lain-lain").html('');
                    }

                } else if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: `${response.data}`,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: `Data Gagal Disimpan`,
                });
                $('.simpan').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.simpan').prop('disabled', false);
            }
        });
    })

    // Aksi Edit 
    $(document).on('click', "#edit", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/lain_lain_peserta_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.lain_lain.id);
                $("#lain_lain_edit").val(response.lain_lain.lain_lain);
                $("#bulan_data_edit").val(response.lain_lain.bulan).trigger('change');
                $("#tahun_edit").val(response.lain_lain.tahun);

                let peserta_didik_data = `<option value="">--Silahkan Pilih--</option>`;

                response.peserta_didik.forEach(function(e) {
                    peserta_didik_data += `<option value="${e.id}"> ${e.nama_lengkap_anak} </option>`
                });

                $("#peserta_didik_ahl_id_edit").html(peserta_didik_data);

                $("#peserta_didik_ahl_id_edit").val(response.lain_lain.peserta_didik_ahl_id).trigger('change');


            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_edit").val();
        let peserta_didik_ahl_id = $("#peserta_didik_ahl_id_edit").val();
        let bulan = $("#bulan_data_edit").val();
        let lain_lain = $("#lain_lain_edit").val();
        let tahun = $("#tahun_edit").val();

        $.ajax({
            url: '/admin/lain_lain_peserta_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                peserta_didik_ahl_id: peserta_didik_ahl_id,
                bulan: bulan,
                lain_lain: lain_lain,
                tahun: tahun
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.peserta_didik_ahl_id) {
                        $("#peserta_didik_ahl_id_edit").addClass('is-invalid');
                        $(".error-peserta-didik-edit").html(response.error.peserta_didik_ahl_id);
                    } else {
                        $("#peserta_didik_ahl_id_edit").removeClass('is-invalid');
                        $(".error-peserta-didik-edit").html('');
                    }
                    if (response.error.bulan) {
                        $("#bulan_data_edit").addClass('is-invalid');
                        $(".error-bulan-edit").html(response.error.bulan);
                    } else {
                        $("#bulan_data_edit").removeClass('is-invalid');
                        $(".error-bulan-edit").html('');
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
            url: '/admin/lain_lain_peserta_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.lain_lain.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/lain_lain_peserta_ahl/delete',
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

    $("#update_lain_lain_form").submit(function(e) {
        e.preventDefault();
        let bulan = $("#bulan_update").val();

        $.ajax({
            url: '/admin/lain_lain_peserta_ahl/update_lain_lain',
            method: 'post',
            dataType: 'JSON',
            data: {
                bulan: bulan,
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
                        $("#bulan_update").addClass('is-invalid');
                        $(".error-bulan-update").html(response.error.bulan);
                    } else {
                        $("#bulan_update").removeClass('is-invalid');
                        $(".error-bulan-update").html('');
                    }

                    if (response.error.duplicate) {
                        Swal.fire({
                            icon: 'error',
                            title: `${response.error.duplicate}`,
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

    // $(document).ready(function(e) {
    //     $("#cek_harga_perbulan").submit(function(e) {
    //         e.preventDefault();
    //         let bulan = $("#bulan_table").val();
    //         $.ajax({
    //             url: '/admin/klaim_lain_lain/lain_lain_perbulan',
    //             data: {
    //                 bulan: bulan
    //             },
    //             dataType: 'json',
    //             type: 'POST',
    //             beforeSend: function() {
    //                 $('.search').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
    //                 $('.search').prop('disabled', true);
    //             },
    //             success: function(response) {
    //                 let no = 1;
    //                 let table_data = ``;
    //                 $('.search').html('<i class="bi bi-search"></i> Search');
    //                 $('.search').prop('disabled', false);
    //                 if (response.lain_lain.length >= 1) {
    //                     response.lain_lain.forEach(function(e) {
    //                         table_data += `<tr>
    //                             <td>${no++}</td>
    //                             <td>${e.nama_lengkap}</td>
    //                             <td>${e.bulan}</td>
    //                             <td>${e.tahun}</td>
    //                             <td>Rp. ${new Intl.NumberFormat().format(e.lain_lain)} </td>
    //                             <td>Rp. ${new Intl.NumberFormat().format(e.booster_media_mitra)} </td>
    //                             <td>${e.status_pengajar} </td>
    //                         </tr>`;
    //                     });
    //                     $("#lain_lain_table_data").html(table_data);
    //                 } else {
    //                     table_data += `<tr>
    //                             <td colspan="7" style="text-align:center">Data Tidak ditemukan</td>
    //                         </tr>`;
    //                     $("#lain_lain_table_data").html(table_data);
    //                 }

    //             },
    //             error: function() {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: `Data Belum Tersimpan!`,
    //                 });
    //                 $('.search').html('<i class="bi bi-search"></i> Search');
    //                 $('.search').prop('disabled', false);
    //             }
    //         });
    //     })
    // });
</script>

<?= $this->endSection(); ?>