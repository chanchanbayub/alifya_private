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
                        <h5 class="card-title">Presensi Ideal Bulan <span class="bulan_text"><?= bulan(date('n', strtotime(date('Y-m-d'))))  ?></h5>
                        <!-- Browser Default Validation -->
                        <form class="row g-3 text-capitalize" id="cek_presensi_ideal">
                            <?= csrf_field(); ?>
                            <div class="col-md-12">
                                <label for="tahun" class="form-label">Pilih Bulan :</label>
                                <input type="month" name="tahun" id="tahun" class="form-control" required>
                                <div class="invalid-feedback error-tahun">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-outline-primary btn-block" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cari</button>
                            </div>
                        </form>
                        <!-- End Browser Default Validation -->
                    </div>
                </div>
            </div>
        </div><!-- End Left side columns -->

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title"> Presensi Ideal <span>| Bulan <span class="bulan_text"><?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Jumlah Anak Aktif</th>
                                        <th scope="col">Jumlah Presensi</th>
                                        <th scope="col">Target Presensi</th>
                                        <th scope="col">Presensi Ideal</th>
                                    </tr>
                                </thead>
                                <tbody class="presensi_ideal">
                                    <tr>
                                        <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
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

        $("#cek_presensi_ideal").submit(function(e) {
            e.preventDefault();
            let tahun = $("#tahun").val();

            $.ajax({
                url: '/admin/presensi/getPresensiIdealPerbulan',
                method: 'get',
                dataType: 'JSON',
                data: {
                    tahun: tahun,
                },
                success: function(response) {
                    console.log(response);
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
                    let jadwalData = ``;
                    let presensiData = ``;
                    let absensiData = ``;

                    if (response.presensi_ideal_mitra.length >= 1) {
                        response.presensi_ideal_mitra.forEach(function(e) {
                            tableData += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap}</td>
                                <td>${e.jumlah_anak}</td>
                                <td>${e.total_presensi}</td>
                                <td>${(e.target_presensi) == null ? "0" : e.target_presensi}</td>
                                <td>${e.presensi_ideal_data}%</td>
                                
                            </tr>`;
                        });
                        $(".presensi_ideal").html(tableData);


                    } else {
                        tableData += `<tr>
                                <td colspan="3"  align="center">data tidak ditemukan</td>
                            </tr>`;
                        $(".presensi_ideal").html(tableData);
                    }

                }
            });
        })
    })
</script>
<?= $this->endSection(); ?>