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
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Keterangan</th>
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
                        <label for="date" class="col-form-label">Tanggal :</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <div class="invalid-feedback error-tanggal">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                                <option value="<?= $mitra_pengajar->mitra_id ?>"><?= $mitra_pengajar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra-pengajar">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan" class="form-control">jelaskan alasannya</textarea>
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
                <h5 class="modal-title"> Form <small>Edit <?= $title ?></small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>

                    <div class="form_group">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id_edit" name="id">
                            <div class="mb-3">
                                <label for="date" class="col-form-label">Tanggal :</label>
                                <input type="date" class="form-control" id="tanggal_edit" name="tanggal">
                                <div class="invalid-feedback error-tanggal-edit">
                                </div>
                            </div>
                            <label for="mitra_pengajar_id_edit" class="col-form-label">Mitra Pengajar :</label>
                            <select name="mitra_pengajar_id" id="mitra_pengajar_id_edit" class="form-select">
                                <option value="">--Silahkan Pilih--</option>

                            </select>
                            <div class="invalid-feedback error-mitra-pengajar-edit">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_edit" class="col-form-label">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan_edit" class="form-control"></textarea>
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

<!-- View Modal -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lihat Data Absen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td scope="col">Tanggal</td>
                            <td scope="col">:</td>
                            <td id="tanggal_data"></td>
                        </tr>
                        <tr>
                            <td scope="col">Mitra Pengajar</td>
                            <td scope="col">:</td>
                            <td id="mitra_pengajar_data"></td>
                        </tr>
                        <tr>
                            <td scope="col">Peserta Didik</td>
                            <td scope="col">:</td>
                            <td id="peserta_didik_data"></td>
                        </tr>
                        <tr>
                            <td scope="col">Absen</td>
                            <td scope="col">:</td>
                            <td id="absen_data"></td>
                        </tr>
                        <tr>
                            <td scope="col">Keterangan</td>
                            <td scope="col">:</td>
                            <td id="keterangan_data"></td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(e) {
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/absensi_ahl/getAbsensiMitraAhl'
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: true
                },
                {
                    data: 'tanggal',
                },
                {
                    data: 'nama_lengkap',
                },
                {
                    data: 'keterangan',
                },

                {
                    data: 'action',
                    orderable: false
                },

            ],
        });
    })

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

            let tanggal = $("#tanggal").val();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();

            let keterangan = $("#keterangan").val();

            $.ajax({
                url: '/admin/absensi_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    tanggal: tanggal,
                    mitra_pengajar_id: mitra_pengajar_id,
                    keterangan: keterangan,

                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.tanggal) {
                            $("#tanggal").addClass('is-invalid');
                            $(".error-tanggal").html(response.error.tanggal);
                        } else {
                            $("#tanggal").removeClass('is-invalid');
                            $(".error-tanggal").html('');
                        }
                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra-pengajar").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra-pengajar").html('');
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
            url: '/admin/absensi_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.absensi.id);
                $("#tanggal_edit").val(response.absensi.tanggal);
                $("#keterangan_edit").val(response.absensi.keterangan);

                let mitra_pengajar_data = `<option value="">--Silahkan Pilih--</option>`;

                response.mitra_pengajar.forEach(function(e) {
                    mitra_pengajar_data += `<option value="${e.mitra_id}"> ${e.nama_lengkap} </option>`
                });

                $("#mitra_pengajar_id_edit").html(mitra_pengajar_data);

                $("#mitra_pengajar_id_edit").val(response.absensi.mitra_pengajar_id).trigger('change');

            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let tanggal = $('#tanggal_edit').val();
        let mitra_pengajar_id = $('#mitra_pengajar_id_edit').val();
        let keterangan = $('#keterangan_edit').val();

        $.ajax({
            url: '/admin/absensi_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                tanggal: tanggal,
                mitra_pengajar_id: mitra_pengajar_id,
                keterangan: keterangan,

            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Ubah');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.tanggal) {
                        $("#tanggal_edit").addClass('is-invalid');
                        $(".error-tanggal-edit").html(response.error.tanggal);
                    } else {
                        $("#tanggal_edit").removeClass('is-invalid');
                        $(".error-tanggal-edit").html('');
                    }
                    if (response.error.mitra_pengajar_id) {
                        $("#mitra_pengajar_id_edit").addClass('is-invalid');
                        $(".error-mitra-pengajar-edit").html(response.error.mitra_pengajar_id);
                    } else {
                        $("#mitra_pengajar_id_edit").removeClass('is-invalid');
                        $(".error-mitra-pengajar-edit").html('');
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
            url: '/admin/absensi_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.absensi.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/absensi_ahl/delete',
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
            url: '/mitra_pengajar/absensi/getPesertaDidik',
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