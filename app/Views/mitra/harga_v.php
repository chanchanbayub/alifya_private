<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active">Harga Media Belajar</li>
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
                                        <th scope="col">Nama Peserta Didik</th>
                                        <th scope="col">Jenis Media</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Harga Media Belajar</th>
                                        <th scope="col">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($harga_perjam as $harga) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $harga->nama_lengkap_anak ?></td>
                                            <td><?= $harga->nama_media ?></td>
                                            <td><?= $harga->bulan ?></td>
                                            <td>Rp. <?= number_format($harga->media_belajar)  ?></td>
                                            <td><a href="../faktur/<?= $harga->faktur ?>" target="_blank">Lihat Faktur</a> </td>
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
                        <label for="jenis_media_id" class="col-form-label">Jenis Media :</label>
                        <select name="jenis_media_id" id="jenis_media_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($jenis_media as $jenis_media) : ?>
                                <option value="<?= $jenis_media->id ?>"><?= $jenis_media->nama_media ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-nama-media">
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
                        <div class="invalid-feedback error-bulan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="media_belajar" class="col-form-label">Media Belajar :</label>
                        <input type="number" class="form-control" id="media_belajar" name="media_belajar" placeholder="10000">
                        <div class="invalid-feedback error-media-belajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="faktur" class="col-form-label">Faktur / Kwitansi :</label>
                        <input type="file" class="form-control" id="faktur" name="faktur" placeholder="10000">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(e) {
        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#jenis_media_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#bulan').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#program_belajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });
    });

    $("#add_form").submit(function(e) {
        e.preventDefault();

        let peserta_didik_id = $("#peserta_didik_id").val();
        let jenis_media_id = $("#jenis_media_id").val();
        let bulan = $("#bulan").val();
        let media_belajar = $("#media_belajar").val();
        let faktur = $("#faktur").val();

        let formData = new FormData(this);

        formData.append('peserta_didik_id', peserta_didik_id);
        formData.append('jenis_media_id', jenis_media_id);
        formData.append('bulan', bulan);
        formData.append('media_belajar', media_belajar);
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
                $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
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
                    if (response.error.jenis_media_id) {
                        $("#jenis_media_id").addClass('is-invalid');
                        $(".error-nama-media").html(response.error.jenis_media_id);
                    } else {
                        $("#jenis_media_id").removeClass('is-invalid');
                        $(".error-nama-media").html('');
                    }
                    if (response.error.bulan) {
                        $("#bulan").addClass('is-invalid');
                        $(".error-bulan").html(response.error.bulan);
                    } else {
                        $("#bulan").removeClass('is-invalid');
                        $(".error-bulan").html('');
                    }
                    if (response.error.media_belajar) {
                        $("#media_belajar").addClass('is-invalid');
                        $(".error-media-belajar").html(response.error.media_belajar);
                    } else {
                        $("#media_belajar").removeClass('is-invalid');
                        $(".error-media-belajar").html('');
                    }
                    if (response.error.faktur) {
                        $("#faktur").addClass('is-invalid');
                        $(".error-faktur").html(response.error.faktur);
                    } else {
                        $("#faktur").removeClass('is-invalid');
                        $(".error-faktur").html('');
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
</script>

<?= $this->endSection(); ?>