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

                        <!-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Aksi</h6>
                                </li>
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah <?= $title ?></a></li>
                            </ul>
                        </div> -->

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Jenis Media</th>
                                        <th scope="col">Harga Media</th>
                                        <th scope="col">Cek Faktur</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

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
                        <label for="peserta_didik_id" class="col-form-label">Peserta Didik :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($peserta_didik as $peserta_didik) : ?>
                                <option value="<?= $peserta_didik->peserta_didik_id ?>"><?= $peserta_didik->nama_lengkap_anak ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-peserta-didik">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan :</label>
                        <select name="bulan" id="bulan" class="form-control">
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

                    <div class="mb-3">
                        <label for="jenis_media_id" class="form-label">Jenis Media :</label>
                        <select name="jenis_media_id" id="jenis_media_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($jenis_media as $media) : ?>
                                <option value="<?= $media->id ?>"><?= $media->nama_media ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-jenis-media">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="harga_media" class="col-form-label">Harga Media :</label>
                        <input type="number" class="form-control" id="harga_media" name="harga_media" placeholder="50000">
                        <div class="invalid-feedback error-harga-media">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="faktur" class="col-form-label">Faktur :</label>
                        <input type="file" class="form-control" id="faktur" name="faktur">
                        <div class="invalid-feedback error-faktur">
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
                <h5 class="modal-title"> Form <small>Edit Media Belajar</small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>

                    <div class="form_group">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id_edit" name="id">
                            <input type="hidden" class="form-control" id="tahun_edit" name="tahun">
                            <input type="hidden" class="form-control" id="faktur_lama" name="faktur_lama">
                            <label for="peserta_didik_id_edit" class="col-form-label">Peserta Didik :</label>
                            <select name="peserta_didik_id" id="peserta_didik_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>

                            </select>
                            <div class="invalid-feedback error-peserta-didik-edit">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_edit" class="form-label">Pilih Bulan :</label>
                        <select name="bulan" id="bulan_edit" class="form-control">
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

                    <div class="mb-3">
                        <label for="jenis_media_id_edit" class="form-label">Jenis Media :</label>
                        <select name="jenis_media_id" id="jenis_media_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-jenis-media-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga_media_edit" class="col-form-label">Harga Media :</label>
                        <input type="number" class="form-control" id="harga_media_edit" name="harga_media">
                        <div class="invalid-feedback error-harga-media-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="faktur_edit" class="col-form-label">Faktur (kosongkan jika tidak ada) :</label>
                        <input type="file" class="form-control" id="faktur_edit" name="faktur">
                        <div class="invalid-feedback error-faktur-edit">
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
    $(document).ready(function() {
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '/mitra_pengajar/media_belajar/getDataHargaMedia',
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
                    data: 'nama_media',
                },

                {
                    data: 'harga_media',
                    render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                },

                {
                    data: 'faktur',
                    orderable: false
                },

                {
                    data: 'action',
                    orderable: false
                },


            ],
        });
    });

    $(document).ready(function(e) {

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#peserta_didik_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#bulan').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#jenis_media_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });
        $('#jenis_media_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $('#bulan_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });


        $("#add_form").submit(function(e) {
            e.preventDefault();

            let peserta_didik_id = $("#peserta_didik_id").val();
            let bulan = $("#bulan").val();
            let jenis_media_id = $("#jenis_media_id").val();
            let harga_media = $("#harga_media").val();
            let faktur = $("#faktur").val();


            let formData = new FormData(this);

            formData.append('peserta_didik_id', peserta_didik_id);
            formData.append('bulan', bulan);
            formData.append('jenis_media_id', jenis_media_id);
            formData.append('harga_media', harga_media);
            formData.append('faktur', faktur);

            $.ajax({
                url: '/mitra_pengajar/media_belajar/insert',
                data: formData,
                dataType: 'json',
                enctype: 'multipart/form-data',
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.peserta_didik_id) {
                            $("#peserta_didik_id").addClass('is-invalid');
                            $(".error-peserta-didik").html(response.error.peserta_didik_id);
                        } else {
                            $("#peserta_didik_id").removeClass('is-invalid');
                            $(".error-peserta-didik").html('');
                        }

                        if (response.error.bulan) {
                            $("#bulan").addClass('is-invalid');
                            $(".error-bulan").html(response.error.bulan);
                        } else {
                            $("#bulan").removeClass('is-invalid');
                            $(".error-bulan").html('');
                        }

                        if (response.error.jenis_media_id) {
                            $("#jenis_media_id").addClass('is-invalid');
                            $(".error-jenis-media").html(response.error.jenis_media);
                        } else {
                            $("#jenis_media_id").removeClass('is-invalid');
                            $(".error-jenis-media").html('');
                        }

                        if (response.error.harga_media) {
                            $("#harga_media").addClass('is-invalid');
                            $(".error-harga-media").html(response.error.harga_media);
                        } else {
                            $("#harga_media").removeClass('is-invalid');
                            $(".error-harga-media").html('');
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
            url: '/admin/klaim_media_belajar/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,

            },
            success: function(response) {
                // console.log(response);
                $("#id_edit").val(response.klaim_media.id);
                $("#harga_media_edit").val(response.klaim_media.harga_media);
                $("#bulan_edit").val(response.klaim_media.bulan).trigger('change');
                $("#tahun_edit").val(response.klaim_media.tahun);
                $("#lain_lain_edit").val(response.klaim_media.lain_lain);
                $("#faktur_lama").val(response.klaim_media.faktur);


                let peserta_didik_data = `<option value="">--Silahkan Pilih--</option>`;

                response.peserta_didik.forEach(function(e) {
                    peserta_didik_data += `<option value="${e.id}"> ${e.nama_lengkap_anak} </option>`
                });

                $("#peserta_didik_id_edit").html(peserta_didik_data);

                $("#peserta_didik_id_edit").val(response.klaim_media.peserta_didik_id).trigger('change');

                let jenis_media_data = `<option value="">--Silahkan Pilih--</option>`;

                response.jenis_media.forEach(function(e) {
                    jenis_media_data += `<option value="${e.id}"> ${e.nama_media} </option>`
                });

                $("#jenis_media_id_edit").html(jenis_media_data);

                $("#jenis_media_id_edit").val(response.klaim_media.jenis_media_id).trigger('change');


            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_edit").val();
        let faktur_lama = $("#faktur_lama").val();
        let peserta_didik_id = $("#peserta_didik_id_edit").val();
        let bulan = $("#bulan_edit").val();
        let tahun = $("#tahun_edit").val();
        let jenis_media_id = $("#jenis_media_id_edit").val();
        let harga_media = $("#harga_media_edit").val();
        let lain_lain = $("#lain_lain_edit").val();
        let faktur = $("#faktur_edit").val();

        let formData = new FormData(this);

        formData.append('id', id);
        formData.append('faktur_lama', faktur_lama);
        formData.append('tahun', tahun);
        formData.append('peserta_didik_id', peserta_didik_id);
        formData.append('bulan', bulan);
        formData.append('jenis_media_id', jenis_media_id);
        formData.append('harga_media', harga_media);
        formData.append('lain_lain', lain_lain);
        formData.append('faktur', faktur);

        $.ajax({
            url: '/admin/klaim_media_belajar/update',
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
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.peserta_didik_id) {
                        $("#peserta_didik_id_edit").addClass('is-invalid');
                        $(".error-peserta-didik-edit").html(response.error.peserta_didik_id);
                    } else {
                        $("#peserta_didik_id_edit").removeClass('is-invalid');
                        $(".error-peserta-didik-edit").html('');
                    }
                    if (response.error.bulan) {
                        $("#bulan_edit").addClass('is-invalid');
                        $(".error-bulan-edit").html(response.error.bulan);
                    } else {
                        $("#bulan_edit").removeClass('is-invalid');
                        $(".error-bulan-edit").html('');
                    }
                    if (response.error.jenis_media_id) {
                        $("#jenis_media_id_edit").addClass('is-invalid');
                        $(".error-jenis-media-edit").html(response.error.jenis_media_id);
                    } else {
                        $("#jenis_media_id_edit").removeClass('is-invalid');
                        $(".error-jenis-media-edit").html('');
                    }

                    if (response.error.harga_media) {
                        $("#harga_media_edit").addClass('is-invalid');
                        $(".error-harga-media-edit").html(response.error.harga_media);
                    } else {
                        $("#harga_media_edit").removeClass('is-invalid');
                        $(".error-harga-media-edit").html('');
                    }

                    if (response.error.lain_lain) {
                        $("#lain_lain_edit").addClass('is-invalid');
                        $(".error-lain-lain-edit").html(response.error.lain_lain);
                    } else {
                        $("#lain_lain_edit").removeClass('is-invalid');
                        $(".error-lain-lain-edit").html('');
                    }

                    if (response.error.faktur) {
                        $("#faktur_edit").addClass('is-invalid');
                        $(".error-faktur-edit").html(response.error.faktur);
                    } else {
                        $("#faktur_edit").removeClass('is-invalid');
                        $(".error-faktur-edit").html('');
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
            url: '/admin/klaim_media_belajar/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.klaim_media.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/klaim_media_belajar/delete',
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
</script>

<?= $this->endSection(); ?>