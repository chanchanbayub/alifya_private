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
                        <h5 class="card-title">Rekap Presensi Bulan <span class="bulan_text"> | <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> <?= date('Y') ?></h5>
                        <!-- Browser Default Validation -->
                        <form class="row g-3 text-capitalize" id="cek_presensi">
                            <?= csrf_field(); ?>
                            <div class="col-md-6">
                                <label for="mitra_pengajar_id" class="form-label">Pilih Mitra Pengajar :</label>
                                <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-control" required>
                                    <option value="">--Silahkan Pilih--</option>
                                    <?php foreach ($mitra_pengajar_ahl as $mitra) : ?>
                                        <option value="<?= $mitra->mitra_id  ?>"><?= $mitra->nama_lengkap ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <div class="invalid-feedback error-mitra-pengajar">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="tahun" class="form-label">Pilih Bulan :</label>
                                <input type="month" name="tahun" id="tahun" class="form-control" required>
                                <div class="invalid-feedback error-tahun">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button class="btn btn-outline-primary btn-block" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cari</button>
                            </div>
                        </form>
                        <!-- End Browser Default Validation -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total <span>|Presensi Masuk </span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="masuk"></h6>
                                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total <span>|Presensi Pulang </span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="pulang"></h6>
                                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total <span>|Presensi Dinas Luar </span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="dl"></h6>
                                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card recent-sales overflow-auto">


                <div class="card-body">
                    <h5 class="card-title"><?= $title ?> <span>| <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> <?= date('Y') ?> </span></h5>
                    <table class="table table-bordered">
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
                        <tbody class="data_presensi">
                            <tr>
                                <td colspan="10" style="text-align: center;">Tidak Ada Data</td>
                            </tr>
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

<script>
    $(document).ready(function() {
        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            // dropdownParent: $('#exampleModal')
        });
    });

    $("#cek_presensi").submit(function(e) {
        e.preventDefault();
        let mitra_pengajar_id = $("#mitra_pengajar_id").val();
        let tahun = $("#tahun").val();

        $.ajax({
            url: '/admin/presensi_ahl/getPresensiPerbulan',
            method: 'get',
            dataType: 'JSON',
            data: {
                mitra_pengajar_id: mitra_pengajar_id,
                tahun: tahun,
            },
            success: function(response) {

                $("#masuk").html(response.jumlah_masuk);
                $("#pulang").html(response.jumlah_pulang);
                $("#dl").html(response.jumlah_dl);
                // console.log(response.presensi);
                let no = 1;
                let tableData = ``;

                if (response.presensi.length >= 1) {
                    response.presensi.forEach(function(e) {
                        tableData += `<tr>
                                    <td>${no++}</td>
                                    <td>${e.nama_lengkap}</td>
                                    <td>${e.jenis_pekerjaan}</td>
                                    <td>${e.tanggal}</td>
                                    <td>${e.jam}</td>
                                    <td>${e.lokasi}</td>
                                    <td>${e.lain_lain}</td>
                                    <td>${e.status_presensi}</td>
                                    <td>${e.keterangan}</td>
                                    <td><a href="/../dokumentasi_ahl/${e.dokumentasi}" target="_blank">Lihat</a></td>
                                </tr>`;
                    });
                    $(".data_presensi").html(tableData);
                } else {
                    tableData += `<tr>
                                    <td colspan="10"  align="center">data tidak ditemukan</td>
                                </tr>`;
                    $(".data_presensi").html(tableData);
                }

            }
        });
    })
</script>


<?= $this->endSection(); ?>