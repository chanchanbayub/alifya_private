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
                            <h5 class="card-title"><?= $title ?></h5>
                            <?php if (session()->getFlashdata('error')) : ?>
                                <h5 class="text-danger">Data Tidak Ditemukan</h5>
                            <?php endif; ?>
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" id="cek_penilaian">
                                <!-- action="penilaian_mitra/pdf" -->
                                <?= csrf_field(); ?>

                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan Sekarang:</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control">
                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary search" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cek Penilaian</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div><!-- End Recent Sales -->

                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Rekap Penilaian APR Bulan Tersebut <span>| Table </span></h5>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Ranking</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Mitra Pengajar</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Murid (10%)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Administrasi (15%)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Kreativitas (20%)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">kehadiran (25%)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Progress Anak (30%)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Final Score</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Predikat</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table_penilaian">
                                    <tr>
                                        <td colspan="10" style="text-transform: capitalize; text-align:center">Tidak Ada Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Left side columns -->

<!-- Modal -->
<div class="modal fade" id="rincian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Rincian Penilaian APR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Indikatior Performa</th>
                            <th>Data Aktual</th>
                            <th>Penilaian / Status</th>
                            <th>Konversi Skala</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody id="rincian_table">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- </div> -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $("#cek_penilaian").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();

            $.ajax({
                url: '/admin/rekap_performance/cek_penilaian',
                method: 'post',
                dataType: 'JSON',
                data: {
                    bulan: bulan,
                },
                beforeSend: function() {
                    $('.search').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.search').prop('disabled', true);
                },
                success: function(response) {
                    $('.search').html('<i class="bi bi-search"></i> Cek Invoice');
                    $('.search').prop('disabled', false);
                    if (response.error) {
                        if (response.error.bulan) {
                            $("#bulan").addClass('is-invalid');
                            $(".error-bulan").html(response.error.bulan);
                        } else {
                            $("#bulan").removeClass('is-invalid');
                            $(".error-bulan").html('');
                        }
                        if (response.error.bulan_sebelumnya) {
                            $("#bulan_sebelumnya").addClass('is-invalid');
                            $(".error-bulan-sebelumnya").html(response.error.bulan_sebelumnya);
                        } else {
                            $("#bulan_sebelumnya").removeClass('is-invalid');
                            $(".error-bulan-sebelumnya").html('');
                        }

                    } else {
                        let no = 1;
                        let table_kuisioner = ``;
                        if (response.data_kuisioner.length >= 1) {
                            response.data_kuisioner.forEach(function(e) {
                                table_kuisioner += `<tr>
                                    <td align="center" style="text-transform:uppercase">${no++}</td>
                                    <td align="left"   style="text-transform:uppercase">${e.nama_lengkap}</td>
                                    <td align="center" style="text-transform:uppercase">${e.jumlah_murid_aktif}%</td>
                                    <td align="center" style="text-transform:uppercase">${e.administrasi}%</td>
                                    <td align="center" style="text-transform:uppercase">${e.kreativitas}%</td>
                                    <td align="center" style="text-transform:uppercase">${e.kehadiran}%</td>
                                    <td align="center" style="text-transform:uppercase">${e.progres_anak}%</td>
                                    <td align="center" style="text-transform:uppercase;font-weight: bold;">${e.final_score}%</td>
                                    <td align="center" style="text-transform:uppercase;font-weight: bold;">${e.nilai_data}</td>
                                    <td align="center"><button type="button" id="button_rincian" class="btn btn-outline-secondary btn-sm" data-id="${e.id}" data-bulan="${response.inputan_bulan}" data-tahun="${response.inputan_tahun}" data-bs-toggle="modal" data-bs-target="#rincian">rincian</button></td>
                                </tr>`;
                            });
                            $(".table_penilaian").html(table_kuisioner);
                        }
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.search').html('<i class="bi bi-search"></i> Cek Invoice');
                    $('.search').prop('disabled', false);
                }
            });
        })
    });

    $(document).on('click', "#button_rincian", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let bulan = $(this).attr('data-bulan');
        let tahun = $(this).attr('data-tahun');

        $.ajax({
            url: '/admin/rekap_performance/rincian',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
                bulan: bulan,
                tahun: tahun,
            },
            success: function(response) {
                console.log(response);

                let no = 1;
                let rincian_table = ``;
                rincian_table +=
                    `<tr>
                        <td align="left" style="text-transform:capitalize">Jumlah Murid</td>
                        <td align="left" style="text-transform:capitalize">${response.jumlah_murid_aktif} Murid</td>
                        <td align="left" style="text-transform:capitalize">Database Anak Aktif</td>
                        <td align="left" style="text-transform:capitalize">Skala ${response.skala_nilai_jumlah_murid}</td>
                        <td align="left" style="text-transform:capitalize">${response.bobot_jumlah_anak}% </td>
                    </tr>
                    <tr>
                        <td align="left" style="text-transform:capitalize">Administrasi</td>
                        <td align="left" style="text-transform:capitalize">${response.administrasi}</td>
                        <td align="left" style="text-transform:capitalize">Penilaian Ms. Pembimbing</td>
                        <td align="left" style="text-transform:capitalize">Skala ${response.skala_nilai_administrasi}</td>
                        <td align="left" style="text-transform:capitalize">${response.skala_nilai_administrasi_bobot}% </td>
                    </tr>
                
                    <tr>
                        <td align="left" style="text-transform:capitalize">Kreativitas</td>
                        <td align="left" style="text-transform:capitalize">${response.kreativitas}</td>
                        <td align="left" style="text-transform:capitalize">Penilaian Evaluasi Dokumentasi</td>
                        <td align="left" style="text-transform:capitalize">Skala ${response.skala_nilai_kreativitas} </td>
                        <td align="left" style="text-transform:capitalize">${response.skala_nilai_kreativitas_bobot}% </td>
                    </tr>
                    <tr>
                        <td align="left" style="text-transform:capitalize">Kehadiran</td>
                        <td align="left" style="text-transform:capitalize">${response.kehadiran}%</td>
                        <td align="left" style="text-transform:capitalize">Presensi Sistem</td>
                        <td align="left" style="text-transform:capitalize">Skala ${response.skala_nilai_kehadiran}</td>
                       <td align="left" style="text-transform:capitalize">${response.skala_nilai_kehadiran_bobot}% </td>
                    </tr>
                    <tr>
                        <td align="left" style="text-transform:capitalize">Progress Anak</td>
                        <td align="left" style="text-transform:capitalize">${response.progres_anak}</td>
                        <td align="left" style="text-transform:capitalize">Capaian Kurikulum</td>
                        <td align="left" style="text-transform:capitalize">Skala ${response.skala_nilai_progress} </td>
                       <td align="left" style="text-transform:capitalize">${response.skala_nilai_progress_bobot}% </td>
                    </tr>`

                $("#rincian_table").html(rincian_table);
            }
        });
    });
</script>

<?= $this->endSection(); ?>