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
                            <table class="table table-bordered datatable text-capitalize">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Pembimbing</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Jumlah Murid</th>
                                        <th scope="col">Administrasi</th>
                                        <th scope="col">Kreativitas</th>
                                        <th scope="col">Kehadiran</th>
                                        <th scope="col">Progres Peserta Didik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>

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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori APR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="pembimbing_id" class="col-form-label">Pembimbing :</label>
                        <select name="pembimbing_id" id="pembimbing_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-pembimbing">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>

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
                                <h5>JUMLAH SISWA</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="administrasi" class="col-form-label">Jumlah Siswa yang ditampilkan diisi oleh Sistem Secara Otomatis dan Terintegrasi</label>
                                    <input type="number" class="form-control" id="jumlah_murid" name="jumlah_murid" placeholder="diisi otomatis oleh sistem" disabled>
                                    <div class="invalid-feedback error-jumlah">
                                    </div>
                                </div>
                            </div>
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
                                    <label for="administrasi" class="col-form-label">Mohon pilih satu kondisi yang paling menggambarkan kreativitas mengajar Mitra Pengajar berdasarkan bukti dokumentasi berkala bulan ini:</label>
                                    <select name="administrasi" id="administrasi" class="form-select">
                                        <option value="">--Silahkan Pilih--</option>
                                    </select>
                                    <div class="invalid-feedback error-administrasi">
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
    });
</script>

<?= $this->endSection(); ?>