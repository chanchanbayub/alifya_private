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
            <div class="col-md-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Presensi Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?></h5>
                        <!-- Browser Default Validation -->
                        <form class="row g-3 text-capitalize" id="cek_presensi">
                            <?= csrf_field(); ?>
                            <div class="col-md-6">
                                <label for="mitra_pengajar_id" class="form-label">Pilih Mitra Pengajar :</label>
                                <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-control" required>
                                    <option value="">--Silahkan Pilih--</option>
                                    <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                                        <option value="<?= $mitra_pengajar->mitra_pengajar_id ?>"> <?= $mitra_pengajar->nama_lengkap ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback error-mitra-pengajar">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="bulan" class="form-label">Pilih Bulan :</label>
                                <select name="bulan" id="bulan" class="form-control" required>
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

                            <div class="col-md-6">
                                <button class="btn btn-outline-primary btn-block" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cari</button>
                            </div>
                        </form>
                        <!-- End Browser Default Validation -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <!-- Recent Sales -->

                    <div class="col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Presensi <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-fingerprint"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="jumlah_presensi">0 </h6>
                                        <span class="text-muted small pt-2 ps-1">Target Presensi : </span><span class="text-success small pt-1 fw-bold" id="target_presensi"> 0 </span> <span>Kehadiran</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title"> Presensi Ideal <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-fingerprint"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="presensi_ideal"> 0 %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title"> Absensi <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-fingerprint"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="total_absensi"> 0 </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?> <span>| <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?></span></h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal Masuk</th>
                                            <th scope="col">Peserta Didik</th>
                                            <th scope="col">Dokumentasi Orang Tua</th>
                                            <th scope="col">Dokumentasi Grup</th>
                                        </tr>
                                    </thead>
                                    <tbody class="data_presensi">
                                        <tr>
                                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Jadwal Tetap Anak <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Peserta Didik</th>
                                        </tr>
                                    </thead>
                                    <tbody class="jadwal_bulanan">
                                        <tr>
                                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Sales -->
                </div>
            </div>

        </div><!-- End Left side columns -->

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title"> Presensi Ideal <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Anak</th>
                                        <th scope="col">Jumlah Pertemuan</th>
                                        <th scope="col">Kehadiran Mitra</th>
                                        <th scope="col">Presensi Ideal</th>
                                    </tr>
                                </thead>
                                <tbody class="presensi_anak">
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title"> Absensi <span>| Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="absensi">
                                    <tr>
                                        <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>


<!-- End hapus Modal-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
        });

        $('#bulan').select2({
            theme: 'bootstrap-5',
        });

        $("#cek_presensi").submit(function(e) {
            e.preventDefault();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let bulan = $("#bulan").val();
            $.ajax({
                url: '/admin/presensi/getPresensiPerbulan',
                method: 'get',
                dataType: 'JSON',
                data: {
                    mitra_pengajar_id: mitra_pengajar_id,
                    bulan: bulan
                },
                success: function(response) {
                    $(".total_absensi").html(response.total_absensi);
                    $(".jumlah_presensi").html(response.jumlah_presensi);
                    $(".presensi_ideal").html(`${response.presensi_ideal} %`);
                    $("#target_presensi").html(response.jumlah_paket_belajar);

                    let no = 1;
                    let noJadwal = 1;
                    let noPresensi = 1;
                    let noAbsensi = 1;
                    let tableData = ``;
                    let jadwalData = ``;
                    let presensiData = ``;
                    let absensiData = ``;

                    if (response.presensi.length >= 1) {
                        response.presensi.forEach(function(e) {
                            tableData += `<tr>
                                <td>${no++}</td>
                                <td>${e.tanggal_masuk}</td>
                                <td>${e.nama_lengkap_anak}</td>
                                <td><a href="/../dokumentasi_orang_tua/${e.dokumentasi_orang_tua}" target="_blank">Lihat</a></td>
                                <td><a href="/../dokumentasi/${e.dokumentasi}" target="_blank">Lihat</a></td>
                            </tr>`;
                        });
                        $(".data_presensi").html(tableData);


                    } else {
                        tableData += `<tr>
                                <td colspan="4"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".data_presensi").html(tableData);
                    }

                    if (response.jadwal.length >= 1) {
                        response.jadwal.forEach(function(e) {
                            jadwalData += `<tr>
                                <td>${noJadwal++}</td>
                                <td>${e.nama_hari}</td>
                                <td>${e.nama_lengkap_anak}</td>
                               
                            </tr>`;
                        });
                        $(".jadwal_bulanan").html(jadwalData);


                    } else {
                        jadwalData += `<tr>
                                <td colspan="4"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".jadwal_bulanan").html(jadwalData);
                    }

                    if (response.data_presensi.length >= 1) {
                        response.data_presensi.forEach(function(e) {
                            presensiData += `<tr>
                                <td>${noPresensi++}</td>
                                <td>${e.nama_lengkap_anak}</td>
                                <td>${e.jumlah_pertemuan}</td>
                                <td>${e.total_presensi_perbulan}</td>
                                <th>${e.presensi_ideal_anak}%</th>
                               
                            </tr>`;
                        });
                        $(".presensi_anak").html(presensiData);


                    } else {
                        presensiData += `<tr>
                                <td colspan="5"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".presensi_anak").html(presensiData);
                    }

                    if (response.absensi_data.length >= 1) {
                        response.absensi_data.forEach(function(e) {
                            absensiData += `<tr>
                                <td>${noAbsensi++}</td>
                                <td>${e.tanggal}</td>
                                <td>${e.nama_lengkap_anak}</td>
                                <td>${e.keterangan}</td>       
                            </tr>`;
                        });
                        $(".absensi").html(absensiData);


                    } else {
                        absensiData += `<tr>
                                <td colspan="4"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".absensi").html(absensiData);
                    }


                }
            });
        })
    })
</script>
<?= $this->endSection(); ?>