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

                <div class="col-md-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">Rekap Invoice Mitra Bulan Tersebut <span>| Table </span></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Mitra Pengajar</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Anak Aktif</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Presensi</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Harga Presensi</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Harga Booster</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Media Belajar (Opsional)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Lain-Lain (Opsional)</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Total Akhir</th>
                                        <th scope="col" style="text-transform: capitalize; text-align:center">Link</th>
                                    </tr>
                                </thead>
                                <tbody class="table_invoice">

                                <tfoot>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">JUMLAH :</th>
                                        <th colspan="1" class="total_anak" style="text-align: center;">0</th>
                                        <th colspan="6" style="text-align: center;">TOTAL PEMASUKAN :</th>
                                        <th colspan="2" id="total_pemasukan" style="text-align: left;">Rp. 0 </th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Left side columns
</section>

<!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="invoice_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice Mitra Pengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mitra Pengajar</th>
                            <th scope="col">Jumlah Pertemuan</th>
                            <th scope="col">Lain-Lain</th>
                            <th scope="col">Cetak Invoice</th>
                        </tr>
                    </thead>
                    <tbody id="data">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div> -->

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

            $("#cek_invoice").submit(function(e) {
                e.preventDefault();
                let bulan = $("#bulan").val();

                $.ajax({
                    url: 'invoice_mitra/cek_invoice',
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
                            if (response.data_presensi.length >= 1) {
                                response.data_presensi.forEach(function(e) {
                                    table_invoice_data += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap}</td>
                                <td align="center">${e.jumlah_anak}</td>
                                <td align="center">${e.total_presensi}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.harga_mitra)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.booster_media)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.total_media_belajar)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.total_lain_lain)}</td>
                                <td align="center">Rp. ${new Intl.NumberFormat().format(e.total_akhir)}</td>
                                <td align="center">Link </td>
                            </tr>`;
                                });
                                $(".table_invoice").html(table_invoice_data);
                                $("#total_pemasukan").html('oke');
                                $(".total_anak").html(response.total_anak_aktif);
                            } else {
                                let no = 1;
                                let table_invoice_data = ``;
                                table_invoice_data += `<tr>
                                <td colspan="10"> Tidak Ada Data </td>
                            </tr>`;

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