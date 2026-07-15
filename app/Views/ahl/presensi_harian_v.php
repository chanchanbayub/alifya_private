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
    <!-- Left side columns -->
    <div class="col-md-12">
        <div class="row">

            <!-- Recent Sales -->
            <div class="col-md-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <h5 class="card-title"><?= $title ?> <span>| <?= tanggal_indonesia(date('Y-m-d')) ?>, <?= date_indo(date('Y-m-d')); ?> Table </span></h5>
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Jenis Pekerjaan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Lain-Lain</th>
                                    <th scope="col">Status Presensi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Dokumentasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($presensi_ahl as $presensi_ahl) : ?>
                                    <tr>
                                        <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                        <td><?= $presensi_ahl->nama_lengkap ?></td>
                                        <td><?= $presensi_ahl->jenis_pekerjaan ?></td>
                                        <td><?= tanggal_indonesia(date('Y-m-d', strtotime($presensi_ahl->tanggal))) ?>, <?= date_indo(date('Y-m-d', strtotime($presensi_ahl->tanggal))) ?></td>
                                        <td><?= date('H:i', strtotime($presensi_ahl->jam))  ?></td>
                                        <td><?= $presensi_ahl->lokasi ?></td>
                                        <td><?= $presensi_ahl->lain_lain ?></td>
                                        <td><?= $presensi_ahl->status_presensi ?></td>
                                        <td><?= date('H:i', strtotime($presensi_ahl->keterangan))  ?></td>
                                        <td> <a href="../dokumentasi_ahl/<?= $presensi_ahl->dokumentasi ?>" target="_blank" class="btn btn-outline-primary btn-sm">Lihat</a> </td>
                                    </tr>

                                <?php endforeach; ?>
                                <!-- EndForeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Recent Sales -->
        </div>
    </div><!-- End Left side columns -->

</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>