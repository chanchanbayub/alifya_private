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
                        <h5 class="card-title">Presensi Bulan <span class="bulan_text"><?= bulan(date('n', strtotime(date('Y-m-d'))))  ?></h5>
                        <!-- Browser Default Validation -->
                        <form class="row g-3 text-capitalize" id="cek_presensi">
                            <?= csrf_field(); ?>

                            <div class="col-md-12">
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
            <div class="col-md-12">
                <div class="row">
                    <!-- Recent Sales -->

                    <div class="col-md-12">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Total Presensi <span>| Bulan <span class="bulan_text"><?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-fingerprint"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="jumlah_presensi">0 </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?> <span>| Bulan <span class="bulan_text"><?= bulan(date('n', strtotime(date('Y-m-d'))))  ?></span></h5>
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
                                            <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
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


</section>


<!-- End hapus Modal-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {


        $('#bulan').select2({
            theme: 'bootstrap-5',
        });

        $("#cek_presensi").submit(function(e) {
            e.preventDefault();
            let tahun = $("#tahun").val();

            $.ajax({
                url: '/mitra_pengajar/presensi/getPresensiPerbulan',
                method: 'get',
                dataType: 'JSON',
                data: {
                    tahun: tahun,
                },
                success: function(response) {
                    console.log(response);

                    $(".jumlah_presensi").html(response.jumlah_presensi);

                    if (response.bulan == 1) {
                        $(".bulan_text").html('Januari');
                    } else if (response.bulan == 2) {
                        $(".bulan_text").html('Februari');
                    } else if (response.bulan == 3) {
                        $(".bulan_text").html('Maret');
                    } else if (response.bulan == 4) {
                        $(".bulan_text").html('April');
                    } else if (response.bulan == 5) {
                        $(".bulan_text").html('Mei');
                    } else if (response.bulan == 6) {
                        $(".bulan_text").html('Juni');
                    } else if (response.bulan == 7) {
                        $(".bulan_text").html('Juli');
                    } else if (response.bulan == 8) {
                        $(".bulan_text").html('Agustus');
                    } else if (response.bulan == 9) {
                        $(".bulan_text").html('September');
                    } else if (response.bulan == 10) {
                        $(".bulan_text").html('Oktober');
                    } else if (response.bulan == 11) {
                        $(".bulan_text").html('November');
                    } else if (response.bulan == 12) {
                        $(".bulan_text").html('Desember');
                    }

                    let no = 1;

                    let tableData = ``;


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
                                <td colspan="5"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".data_presensi").html(tableData);
                    }
                }
            });
        })
    })
</script>
<?= $this->endSection(); ?>