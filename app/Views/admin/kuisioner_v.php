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
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Isi Kuisioner</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable text-capitalize">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Pembimbing</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Bulan - Tahun</th>
                                        <th scope="col" align="center">Jumlah Anak Aktif <br> (nilai yang di dapat x 10%)</th>
                                        <th scope="col" align="center">Administrasi <br>(nilai yang di dapat x 15%)</th>
                                        <th scope="col" align="center">Kreativitas <br> (nilai yang di dapat x 20%)</th>
                                        <th scope="col" align="center">Kehadiran <br> (nilai yang di dapat x 25%)</th>
                                        <th scope="col" align="center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($kuisioner as $kuisioner) : ?>
                                        <tr>
                                            <td scope="col"><?= $no++ ?> </td>
                                            <td scope="col"><?= $kuisioner["pembimbing_data"] ?> </td>
                                            <td scope="col"><?= $kuisioner["nama_lengkap"] ?> </td>
                                            <td scope="col"><?= $kuisioner["bulan"] ?> <?= $kuisioner["tahun"] ?> </td>
                                            <td scope="col"><?= $kuisioner["jumlah_murid_aktif"] ?> %</td>
                                            <td scope="col"><?= $kuisioner["administrasi"] ?> %</td>
                                            <td scope="col"><?= $kuisioner["kreativitas"] ?> %</td>
                                            <td scope="col"><?= $kuisioner["kehadiran"] ?> %</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $kuisioner["id"] ?>" type="button">
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kuisioner</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="pembimbing_id" class="col-form-label">Pembimbing :</label>
                        <select name="pembimbing_id" id="pembimbing_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($pembimbing as $pembimbing) : ?>
                                <option value="<?= $pembimbing->id ?>"><?= $pembimbing->nama_lengkap ?> </option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback error-pembimbing">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($mitra as $mitra) : ?>
                                <option value="<?= $mitra->id ?>"><?= $mitra->nama_lengkap ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan" class="col-form-label">Bulan :</label>
                        <input type="month" class="form-control" id="bulan" name="bulan">
                        <div class="invalid-feedback error-bulan">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="card">
                            <div class="card-header">
                                <h5>ADMINISTRASI</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="administrasi" class="col-form-label">Mohon pilih satu kondisi yang paling menggambarkan performa administrasi Mitra Pengajar tersebut selama bulan ini:</label>
                                    <select name="administrasi" id="administrasi" class="form-select">
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php foreach ($administrasi as $administrasi) : ?>
                                            <option value="<?= $administrasi->id ?>"><?= $administrasi->nilai ?> (<?= $administrasi->bobot ?>%) - <?= $administrasi->keterangan  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback error-administrasi">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="card">
                            <div class="card-header">
                                <h5>KREATIVITAS</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="kreativitas" class="col-form-label">Mohon pilih satu kondisi yang paling menggambarkan kreativitas mengajar Mitra Pengajar berdasarkan bukti dokumentasi berkala bulan ini:</label>
                                    <select name="kreativitas" id="kreativitas" class="form-select">
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php foreach ($kreativitas as $kreativitas) : ?>
                                            <option value="<?= $kreativitas->id ?>"><?= $kreativitas->nilai ?> (<?= $kreativitas->bobot ?>%) - <?= $kreativitas->keterangan  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback error-kreativitas">
                                    </div>
                                </div>
                            </div>
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

<!-- Modal hapus  -->
<div class="modal fade" id="deleteModal" tabindex="0">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form <small> Hapus Kuisioner </small></h5>
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
        $('#pembimbing_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });
        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let pembimbing_id = $("#pembimbing_id").val();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let bulan = $("#bulan").val();
            let administrasi = $("#administrasi").val();
            let kreativitas = $("#kreativitas").val();

            $.ajax({
                url: '/admin/kuisioner_rangking/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    pembimbing_id: pembimbing_id,
                    mitra_pengajar_id: mitra_pengajar_id,
                    bulan: bulan,
                    administrasi: administrasi,
                    kreativitas: kreativitas,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.pembimbing_id) {
                            $("#pembimbing_id").addClass('is-invalid');
                            $(".error-pembimbing").html(response.error.pembimbing_id);
                        } else {
                            $("#pembimbing_id").removeClass('is-invalid');
                            $(".error-pembimbing").html('');
                        }

                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra").html('');
                        }

                        if (response.error.bulan) {
                            $("#bulan").addClass('is-invalid');
                            $(".error-bulan").html(response.error.bulan);
                        } else {
                            $("#bulan").removeClass('is-invalid');
                            $(".error-bulan").html('');
                        }
                        if (response.error.administrasi) {
                            $("#administrasi").addClass('is-invalid');
                            $(".error-administrasi").html(response.error.administrasi);
                        } else {
                            $("#administrasi").removeClass('is-invalid');
                            $(".error-administrasi").html('');
                        }
                        if (response.error.kreativitas) {
                            $("#kreativitas").addClass('is-invalid');
                            $(".error-kreativitas").html(response.error.kreativitas);
                        } else {
                            $("#kreativitas").removeClass('is-invalid');
                            $(".error-kreativitas").html('');
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
                            title: `${response.duplikat}`,
                        });
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

    $(document).on('click', "#delete", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/kuisioner_rangking/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.kuisioner_rangking.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/kuisioner_rangking/delete',
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
</script>

<?= $this->endSection(); ?>