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
                            <form class="row g-3 text-capitalize" action="/admin/invoice_pesdik_ahl/pdf/" method="get" target="_blank">
                                <!-- action="invoice_mitra/pdf" -->
                                <?= csrf_field(); ?>

                                <div class="col-md-4">
                                    <label for="peserta_didik_id" class="form-label">Peserta Didik AHL :</label>
                                    <select name="peserta_didik_id" id="peserta_didik_id" class="form-select" require>
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php foreach ($peserta_didik as $peserta_didik) : ?>
                                            <option value="<?= $peserta_didik->id ?>"><?= $peserta_didik->nama_lengkap_anak ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <div class="invalid-feedback error-peserta">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control" require>

                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="lain_lain" class="form-label">Lain-Lain :</label>
                                    <input type="number" name="lain_lain" id="lain_lain" class="form-control" require>

                                    <div class="invalid-feedback error-bulan">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary search" type="submit" target="_blank"> <i class="bi bi-files"></i> Cetak Invoice</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
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
                url: '/admin/invoice_mitra_ahl/cek_invoice',
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
                                    <td align="center">${e.jumlah_presensi_masuk}</td>
                                    <td align="center">${e.jumlah_presensi_pulang}</td>
                                    <td align="center">${e.jumlah_presensi_dinas_luar}</td>
                                    <td align="center">${e.jumlah_presensi_perbulan}</td>
                                    <td align="center">Rp. ${new Intl.NumberFormat().format(e.upah_mitra)}</td>
                                    <td align="center">Rp. ${new Intl.NumberFormat().format(e.lain_lain)}</td>
                                    <td align="center">Rp. ${new Intl.NumberFormat().format(e.total_akhir)}</td>
                                    <td align="center"><a href="/admin/invoice_mitra_ahl/pdf/${e.mitra_id}/${response.bulan}/${response.tahun}" target="_blank" class="btn btn-sm btn-outline-primary invoice"> Cetak Invoice </a></td> </td>
                                </tr>`;
                            });
                            $(".table_invoice").html(table_invoice_data);
                            $(".jumlah_presensi").html(response.total_presensi_perbulan);
                            $(".jumlah_presensi_masuk").html(response.total_presensi_perbulan_masuk);
                            $(".jumlah_presensi_pulang").html(response.total_presensi_perbulan_pulang);
                            // $("#total_pemasukan").html('Rp. ' + new Intl.NumberFormat().format(response.total_pemasukan));
                            // $(".total_anak").html(response.total_anak_aktif);
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