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
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" id="cek_invoice" action="cetak_invoice/pdf" target="_new">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
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
                                    <button class="btn btn-outline-primary" onclick="cek_invoice();" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cek Data</button>
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

                <!-- <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Aksi</h6>
                        </li>

                    </ul>
                </div> -->

                <div class="card-body">
                    <h5 class="card-title">Rekap Peserta Didik Bulan <?= bulan(date('n', strtotime(date('Y-m-d'))))  ?> <span>| Table </span></h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
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
                                    <td scope="col" style="text-transform: capitalize;"><?= $peserta_didik->nama_lengkap_anak ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center"><?= $peserta_didik->total_presensi_perbulan ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($peserta_didik->harga)  ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($peserta_didik->harga * $peserta_didik->total_presensi_perbulan) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($peserta_didik->media_belajar) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($peserta_didik->media_belajar) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($peserta_didik->total_presensi_perbulan * $peserta_didik->harga + $peserta_didik->media_belajar + $peserta_didik->harga) ?></td>
                                    <td scope="col" style="text-transform: capitalize; text-align:center">Cetak PDF </td>

                                </tr>
                        </tbody>
                    <?php endforeach; ?>
                    </table>

                </div>

            </div>
        </div>
    </div><!-- End Left side columns -->
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
        });

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
        });

        $('#bulan').select2({
            theme: 'bootstrap-5',
        });

        $('#harga').select2({
            theme: 'bootstrap-5',
        });


        $('#mitra_pengajar_id').change(function(e) {
            e.preventDefault();
            let mitra_pengajar_id = $(this).val();

            $.ajax({
                url: '/admin/invoice/getPesertaDidik',
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

        $('#peserta_didik_id').change(function(e) {
            e.preventDefault();
            let peserta_didik_id = $(this).val();

            $.ajax({
                url: '/admin/invoice/getHargaPeserta',
                method: 'get',
                dataType: 'JSON',
                data: {
                    peserta_didik_id: peserta_didik_id,
                },
                success: function(response) {
                    if (response.media_belajar == null) {
                        $("#media_belajar").val("0");
                    } else {
                        $("#media_belajar").val(response.media_belajar);
                    }


                },
            });
        });

    });
</script>

<?= $this->endSection(); ?>