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
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Nama Peserta Didik</th>
                                        <th scope="col">Dokumentasi Ke Orang Tua</th>
                                        <th scope="col">Dokumentasi Ke Grup</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($presensi as $presensi) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $presensi->nama_lengkap  ?></td>
                                            <td><?= date('d-m-Y', strtotime($presensi->tanggal_masuk)) ?></td>
                                            <td> <?= date('H:i', strtotime($presensi->jam_masuk)) ?> </td>
                                            <td><?= $presensi->nama_lengkap_anak ?> </td>
                                            <td><a class="btn btn-sm tn btn-link" href="../dokumentasi/<?= $presensi->dokumentasi ?>" target="_blank">Lihat</a> </td>
                                            <?php if ($presensi->dokumentasi_orang_tua == null): ?>
                                                <td><button class="btn btn-sm tn btn-link" target="_blank" disabled>Lihat</button> </td>
                                            <?php else : ?>
                                                <td><a class="btn btn-link btn-sm" href="../dokumentasi_orang_tua/<?= $presensi->dokumentasi_orang_tua ?>" target="_blank">Lihat</a> </td>
                                            <?php endif; ?>
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
                                <option value="<?= $mitra_pengajar->mitra_pengajar_id ?>"><?= $mitra_pengajar->nama_lengkap ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-mitra-pengajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_masuk" class="col-form-label">Tanggal Masuk :</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
                        <div class=" invalid-feedback error-tanggal-masuk">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jam_masuk" class="col-form-label">Jam Masuk :</label>
                        <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" value="<?= date('H:i') ?>">
                        <div class="invalid-feedback error-jam-masuk">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="peserta_didik_id" class="col-form-label">Peserta Didik :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id" class="form-select" disabled>
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-peserta-didik">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dokumentasi" class="col-form-label">Dokumentasi Orang Tua :</label>
                        <input type="file" name="dokumentasi" id="dokumentasi" class="form-control">
                        <div class=" invalid-feedback error-dokumentasi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dokumentasi_orang_tua" class="col-form-label">Dokumentasi Grup :</label>
                        <input type="file" name="dokumentasi_orang_tua" id="dokumentasi_orang_tua" class="form-control">
                        <div class=" invalid-feedback error-dokumentasi-orang-tua">
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


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });


        $('#mitra_pengajar_id').change(function(e) {
            e.preventDefault();
            let mitra_pengajar_id = $(this).val();

            $.ajax({
                url: '/mitra_pengajar/presensi/getPesertaDidik',
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

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let tanggal_masuk = $("#tanggal_masuk").val();
            let jam_masuk = $("#jam_masuk").val();
            let peserta_didik_id = $("#peserta_didik_id").val();
            let dokumentasi = $("#dokumentasi").val();
            let dokumentasi_orang_tua = $("#dokumentasi_orang_tua").val();

            let formData = new FormData(this);

            formData.append('mitra_pengajar_id', mitra_pengajar_id);
            formData.append('tanggal_masuk', tanggal_masuk);
            formData.append('jam_masuk', jam_masuk);
            formData.append('peserta_didik_id', peserta_didik_id);
            formData.append('dokumentasi', dokumentasi);
            formData.append('dokumentasi_orang_tua', dokumentasi_orang_tua);

            $.ajax({
                url: '/mitra_pengajar/presensi/insert',
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
                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra-pengajar").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra-pengajar").html('');
                        }
                        if (response.error.tanggal_masuk) {
                            $("#tanggal_masuk").addClass('is-invalid');
                            $(".error-tanggal-masuk").html(response.error.tanggal_masuk);
                        } else {
                            $("#tanggal_masuk").removeClass('is-invalid');
                            $(".error-tanggal-masuk").html('');
                        }

                        if (response.error.jam_masuk) {
                            $("#jam_masuk").addClass('is-invalid');
                            $(".error-jam-masuk").html(response.error.jam_masuk);
                        } else {
                            $("#jam_masuk").removeClass('is-invalid');
                            $(".error-jam-masuk").html('');
                        }

                        if (response.error.peserta_didik_id) {
                            $("#peserta_didik_id").addClass('is-invalid');
                            $(".error-peserta-didik").html(response.error.peserta_didik_id);
                        } else {
                            $("#peserta_didik_id").removeClass('is-invalid');
                            $(".error-peserta-didik").html('');
                        }

                        if (response.error.dokumentasi_orang_tua) {
                            $("#dokumentasi_orang_tua").addClass('is-invalid');
                            $(".error-dokumentasi-orang-tua").html(response.error.dokumentasi_orang_tua);
                        } else {
                            $("#dokumentasi_orang_tua").removeClass('is-invalid');
                            $(".error-dokumentasi-orang-tua").html('');
                        }

                        if (response.error.dokumentasi) {
                            $("#dokumentasi").addClass('is-invalid');
                            $(".error-dokumentasi").html(response.error.dokumentasi);
                        } else {
                            $("#dokumentasi").removeClass('is-invalid');
                            $(".error-dokumentasi").html('');
                        }

                        if (response.error.duplicate) {
                            Swal.fire({
                                icon: 'error',
                                title: `${response.error.duplicate}`,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 3000)
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
                        title: `${response.error}`,
                    });
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });
</script>

<?= $this->endSection(); ?>