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
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah Price List</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Program Belajar</th>
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col">Jumlah Pertemuan</th>
                                        <th scope="col">Harga Paket</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

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
                        <label for="program_belajar_ahl_id" class="col-form-label">Program Belajar:</label>
                        <select name="program_belajar_ahl_id" id="program_belajar_ahl_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($program_ahl as $program_ahl) : ?>
                                <option value="<?= $program_ahl->id ?>"><?= $program_ahl->nama_program ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-program-belajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_paket" class="col-form-label">Nama Paket :</label>
                        <input type="text" name="nama_paket" id="nama_paket" class="form-control">
                        <div class=" invalid-feedback error-nama-paket">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_pertemuan" class="col-form-label">Jumlah Pertemuan :</label>
                        <input type="number" name="jumlah_pertemuan" id="jumlah_pertemuan" class="form-control">
                        <div class=" invalid-feedback error-jumlah-pertemuan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="harga_paket" class="col-form-label">Harga Paket :</label>
                        <input type="text" name="harga_paket" id="harga_paket" class="form-control">
                        <div class=" invalid-feedback error-harga-paket">
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
                        <label for="program_belajar_ahl_id_edit" class="col-form-label">Program Belajar:</label>
                        <select name="program_belajar_ahl_id" id="program_belajar_ahl_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-program-belajar-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_paket_edit" class="col-form-label">Nama Paket :</label>
                        <input type="text" name="nama_paket" id="nama_paket_edit" class="form-control">
                        <div class=" invalid-feedback error-nama-paket-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_pertemuan_edit" class="col-form-label">Jumlah Pertemuan :</label>
                        <input type="text" name="jumlah_pertemuan" id="jumlah_pertemuan_edit" class="form-control">
                        <div class=" invalid-feedback error-jumlah-pertemuan-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="harga_paket_edit" class="col-form-label">Harga Paket :</label>
                        <input type="text" name="harga_paket" id="harga_paket_edit" class="form-control">
                        <div class=" invalid-feedback error-harga-paket-edit">
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
            ajax: {
                url: '/admin/price_list_ahl/getPriceList',
                method: 'POST'
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: true
                },
                {
                    data: 'nama_program',
                },
                {
                    data: 'nama_paket',
                },
                {
                    data: "jumlah_pertemuan",
                },
                {
                    data: 'harga_paket',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },


                {
                    data: 'action',
                    orderable: false
                },

            ],
        });
    });

    $(document).ready(function(e) {


        $("#add_form").submit(function(e) {
            e.preventDefault();

            let program_belajar_ahl_id = $("#program_belajar_ahl_id").val();
            let nama_paket = $("#nama_paket").val();
            let jumlah_pertemuan = $("#jumlah_pertemuan").val();
            let harga_paket = $("#harga_paket").val();
            $.ajax({
                url: '/admin/price_list_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    program_belajar_ahl_id: program_belajar_ahl_id,
                    nama_paket: nama_paket,
                    jumlah_pertemuan: jumlah_pertemuan,
                    harga_paket: harga_paket,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {

                        if (response.error.program_belajar_ahl_id) {
                            $("#program_belajar_ahl_id").addClass('is-invalid');
                            $(".error-program_belajar").html(response.error.program_belajar_ahl_id);
                        } else {
                            $("#program_belajar_ahl_id").removeClass('is-invalid');
                            $(".error-program_belajar").html('');
                        }
                        if (response.error.nama_paket) {
                            $("#nama_paket").addClass('is-invalid');
                            $(".error-nama-paket").html(response.error.nama_paket);
                        } else {
                            $("#nama_paket").removeClass('is-invalid');
                            $(".error-nama-paket").html('');
                        }
                        if (response.error.jumlah_pertemuan) {
                            $("#jumlah_pertemuan").addClass('is-invalid');
                            $(".error-jumlah-pertemuan").html(response.error.jumlah_pertemuan);
                        } else {
                            $("#jumlah_pertemuan").removeClass('is-invalid');
                            $(".error-jumlah-pertemuan").html('');
                        }
                        if (response.error.harga_paket) {
                            $("#harga_paket").addClass('is-invalid');
                            $(".error-harga-paket").html(response.error.harga_paket);
                        } else {
                            $("#harga_paket").removeClass('is-invalid');
                            $(".error-harga-paket").html('');
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
            url: '/admin/price_list_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_edit").val(response.price_list.id);
                $("#nama_paket_edit").val(response.price_list.nama_paket);
                $("#harga_paket_edit").val(response.price_list.harga_paket);
                $("#jumlah_pertemuan_edit").val(response.price_list.jumlah_pertemuan);

                let program_ahl_data = `<option value="">--Silahkan Pilih--</option>`;

                response.program_ahl.forEach(function(e) {
                    program_ahl_data += `<option value="${e.id}"> ${e.nama_program} </option>`
                });

                $("#program_belajar_ahl_id_edit").html(program_ahl_data);

                $("#program_belajar_ahl_id_edit").val(response.price_list.program_belajar_ahl_id).trigger('change');

            }
        });
    });


    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let program_belajar_ahl_id = $("#program_belajar_ahl_id_edit").val();
        let nama_paket = $("#nama_paket_edit").val();
        let jumlah_pertemuan = $("#jumlah_pertemuan_edit").val();
        let harga_paket = $("#harga_paket_edit").val();

        $.ajax({
            url: '/admin/price_list_ahl/update',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
                program_belajar_ahl_id: program_belajar_ahl_id,
                nama_paket: nama_paket,
                jumlah_pertemuan: jumlah_pertemuan,
                harga_paket: harga_paket,
            },
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {

                    if (response.error.program_belajar_ahl_id) {
                        $("#program_belajar_ahl_id_edit").addClass('is-invalid');
                        $(".error-program-belajar-edit").html(response.error.program_belajar_ahl_id);
                    } else {
                        $("#program_belajar_ahl_id_edit").removeClass('is-invalid');
                        $(".error-program-belajar-edit").html('');
                    }
                    if (response.error.nama_paket) {
                        $("#nama_paket_edit").addClass('is-invalid');
                        $(".error-nama-paket-edit").html(response.error.nama_paket);
                    } else {
                        $("#nama_paket_edit").removeClass('is-invalid');
                        $(".error-nama-paket-edit").html('');
                    }
                    if (response.error.jumlah_pertemuan) {
                        $("#jumlah_pertemuan_edit").addClass('is-invalid');
                        $(".error-jumlah-pertemuan-edit").html(response.error.jumlah_pertemuan);
                    } else {
                        $("#jumlah_pertemuan_edit").removeClass('is-invalid');
                        $(".error-jumlah-pertemuan-edit").html('');
                    }
                    if (response.error.harga_paket) {
                        $("#harga_paket_edit").addClass('is-invalid');
                        $(".error-harga-paket-edit").html(response.error.harga_paket);
                    } else {
                        $("#harga_paket_edit").removeClass('is-invalid');
                        $(".error-harga-paket-edit").html('');
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
            url: '/admin/price_list_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.price_list.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/price_list_ahl/delete',
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