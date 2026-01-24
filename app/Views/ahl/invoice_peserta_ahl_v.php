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
                            <h5 class="card-title"><?= $title ?></h5>
                            <?php if (session()->getFlashdata('error')) : ?>
                                <h5 class="text-danger">Data Tidak Ditemukan</h5>
                            <?php endif; ?>
                            <!-- Browser Default Validation -->
                            <form class="row g-3 text-capitalize" id="cek_invoice">
                                <!-- action="invoice_mitra/pdf" -->
                                <?= csrf_field(); ?>

                                <div class="col-md-12">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control">

                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary search" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cek Invoice</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div><!-- End Recent Sales -->


                <div class="col-md-6">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Export <?= $title ?> (Dalam Pengembangan)</h5>
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
                                    <button class="btn btn-outline-primary" id="export" type="submit" disabled> <i class="bi bi-download"></i> Export</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Rekap Invoice Peserta Didik Alifya Home Learning <span>| Table </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Peserta Didik</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Kelas</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Harga</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Klaim Media</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Total Akhir</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Download</th>
                                    </tr>
                                </thead>
                                <tbody class="table_invoice">

                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: center;">JUMLAH :</th>
                                        <th colspan="1" class="total_harga_paket" style="text-align: center;">0</th>
                                        <th colspan="1" class="jumlah_presensi_pulang" style="text-align: center;">0</th>
                                        <th colspan="1" class="jumlah_presensi_dinas_luar" style="text-align: center;">0</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Left side columns -->


<!-- </div> -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        $('#peserta_didik_id').select2({
            theme: 'bootstrap-5',
        });

        $("#cek_invoice").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();

            $.ajax({
                url: '/admin/invoice_peserta_ahl/cek_invoice',
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
                    console.log(response);
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
                        if (response.peserta_didik_ahl.length >= 1) {
                            response.peserta_didik_ahl.forEach(function(e) {
                                table_invoice_data += `<tr>
                                    <td align="center">${no++}</td>
                                    <td>${e.nama_lengkap_anak}</td>
                                    <td>${e.nama_program}</td>
                                    <td align="center"> Rp. ${new Intl.NumberFormat().format(e.harga_paket)}</td>
                                    <td align="center">0</td>
                                    <td align="center">Rp. ${new Intl.NumberFormat().format(e.harga_paket) + 1 }</td>
                                    <td align="center"><a href="/admin/invoice_peserta_ahl/pdf/${e.id}/${response.bulan}/${response.tahun}" target="_blank" class="btn btn-sm btn-outline-primary invoice"> Download Invoice </a></td> </td>
                                </tr>`;
                            });

                            $(".total_harga_paket").html(`Rp. ${new Intl.NumberFormat().format(response.total.total_harga_paket)}`)
                            $(".table_invoice").html(table_invoice_data);
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