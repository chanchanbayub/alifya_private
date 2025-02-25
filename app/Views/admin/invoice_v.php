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
                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Export <?= $title ?></h5>
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" action="export_excel" method="get">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary" id="cek_data" type="submit"> <i class="bi bi-file-excel"></i> Export Excel</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <h5 class="card-title">Rekap Peserta Didik Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> <span>| Table </span></h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Mitra Pengajar</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Nama Anak</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Presensi</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Upah Per Anak</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Upah</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Media Belajar</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Lain-Lain</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Total Akhir</th>
                                <th scope="col" style="text-transform: capitalize; text-align:center">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_presensi as $peserta_didik) : ?>
                                <tr>
                                    <td scope="col"><?= $no++ ?></td>
                                    <td scope="col" style="text-transform: capitalize;"><?= $peserta_didik["nama_lengkap"] ?></td>
                                    <td scope="col" style="text-transform: capitalize;"><?= $peserta_didik["nama_lengkap_anak"] ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center"><?= $peserta_didik["total_presensi_perbulan"] ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= ($peserta_didik["harga"] == null ? "0" : number_format($peserta_didik["harga"])) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= ($peserta_didik["jumlah_upah"] == null ? "0" : number_format($peserta_didik["jumlah_upah"])) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= ($peserta_didik["media_belajar"] == null ? "0" : number_format($peserta_didik["media_belajar"])) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= ($peserta_didik["lain_lain"] == null ? "0" : number_format($peserta_didik["lain_lain"])) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= ($peserta_didik["total_akhir"] == null ? "0" : number_format($peserta_didik["total_akhir"])) ?></td>
                                    <?php if ($peserta_didik["mitra_pengajar_id"] == null) : ?>
                                        <td scope="col" style="text-transform: capitalize; text-align:center">
                                            <button target="_blank" class="btn btn-sm btn-outline-primary" disabled> Cetak Invoice</button>
                                        </td>
                                    <?php else : ?>
                                        <td scope="col" style="text-transform: capitalize; text-align:center">
                                            <a href="/admin/cetak_invoice/pdf/<?= $peserta_didik["mitra_pengajar_id"] ?>/<?= $peserta_didik["id"] ?>/<?= $peserta_didik["bulan"] ?>" target="_blank" class="btn btn-sm btn-outline-primary"> Cetak Invoice</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                        </tbody>
                    <?php endforeach; ?>
                    <tfoot>
                        <tr>
                            <th colspan="8" style="text-align: center;">TOTAL PEMASUKAN :</th>
                            <th colspan="2" style="text-align: left;">Rp. <?= number_format($total_pemasukan) ?> </th>

                        </tr>
                    </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Left side columns -->
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>