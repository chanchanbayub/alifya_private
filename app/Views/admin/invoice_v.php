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
                <div class="col-md-6">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Filter <?= $title ?></h5>
                            <!-- Browser Default Validation -->
                            <!-- <form class="row g-3 text-capitalize" action="export_excel" method="get"> -->
                            <form class="row g-3 text-capitalize" id="cek_data">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control">
                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-success" id="search" type="submit"> <i class="bi bi-search"></i> Search</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Export <?= $title ?></h5>
                            <!-- Browser Default Validation -->
                            <!-- <form class="row g-3 text-capitalize" action="export_excel" method="get"> -->
                            <form class="row g-3 text-capitalize" id="export_excel" action="/export_excel">
                                <?= csrf_field(); ?>
                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control" required>
                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary" id="export" type="submit"> <i class="bi bi-download"></i> Export</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div>
                <!-- End Recent Sales -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <h5 class="card-title">Rekap Peserta Didik Bulan Tersebut <span>| Table </span></h5>
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
                        <tbody id="table_invoice_peserta">

                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: center;">Jumlah :</th>
                                <th class="total_presensi_perbulan" style="text-align: center;">0</th>
                                <th colspan="6" id="total_pemasukan" style="text-align: center;">Rp. 0 </th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Left side columns -->
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
        });

        $('#harga').select2({
            theme: 'bootstrap-5',
        });

        $("#cek_data").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();
            $.ajax({
                url: '/admin/invoice/cek_invoice',
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

                    } else {
                        let no = 1;
                        let table_invoice_data = ``;
                        if (response.data_presensi.length >= 1) {
                            response.data_presensi.forEach(function(e) {
                                table_invoice_data += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap}</td>
                                <td>${e.nama_lengkap_anak}</td>
                                <td align="center">${e.total_presensi_perbulan}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.harga)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.jumlah_upah)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.media_belajar)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.lain_lain)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.total_akhir)}</td>
                                <td align="center"><a href="/admin/cetak_invoice/pdf/${e.mitra_pengajar_id}/${e.id}/${e.bulan}" data-id="${e.mitra_pengajar_id}" target="_blank" class="btn btn-sm btn-outline-primary invoice"> Cetak Invoice </a></td >
                                    </tr>`;
                            });
                            $("#table_invoice_peserta").html(table_invoice_data);
                            $("#total_pemasukan").html(`Rp. ${new Intl.NumberFormat().format(response.total_pemasukan)}`);
                            $(".total_presensi_perbulan").html(`${response.total_presensi_perbulan}`);


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
</script>

<?= $this->endSection(); ?>