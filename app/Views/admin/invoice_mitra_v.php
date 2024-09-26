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
                                <div class="col-md-4">
                                    <label for="mitra_pengajar_id" class="form-label">Pilih Mitra Pengajar :</label>
                                    <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                                            <option value="<?= $mitra_pengajar->mitra_pengajar_id ?>"> <?= $mitra_pengajar->nama_lengkap ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback error-mitra-pengajar">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="bulan" class="form-label">Pilih Bulan :</label>
                                    <select name="bulan" id="bulan" class="form-control">
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

                                <div class="col-md-4">
                                    <label for="harga_media" class="form-label">Total Media Belajar :</label>
                                    <input type="number" name="harga_media" id="harga_media" class="form-control">
                                    <div class="invalid-feedback error-harga-media">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline-primary" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cek Invoice</button>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->
                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </div>
    </div><!-- End Left side columns -->
</section>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="invoice_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <th scope="col">Total Media</th>
                            <th scope="col">Cetak Invoice</th>
                        </tr>
                    </thead>
                    <tbody id="data">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

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

        $('#bulan').select2({
            theme: 'bootstrap-5',
        });

        $('#harga').select2({
            theme: 'bootstrap-5',
        });

        $("#cek_invoice").submit(function(e) {
            e.preventDefault();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let bulan = $("#bulan").val();
            let harga_media = $("#harga_media").val();

            $.ajax({
                url: 'invoice_mitra/cek_invoice',
                method: 'post',
                dataType: 'JSON',
                data: {
                    mitra_pengajar_id: mitra_pengajar_id,
                    bulan: bulan,
                    harga_media: harga_media
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {

                    // console.log(response);
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra-pengajar").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra-pengajar").html('');
                        }
                        if (response.error.bulan) {
                            $("#bulan").addClass('is-invalid');
                            $(".error-bulan").html(response.error.bulan);
                        } else {
                            $("#bulan").removeClass('is-invalid');
                            $(".error-bulan").html('');
                        }
                        if (response.error.harga_media) {
                            $("#harga_media").addClass('is-invalid');
                            $(".error-harga-media").html(response.error.harga_media);
                        } else {
                            $("#harga_media").removeClass('is-invalid');
                            $(".error-harga-media").html('');
                        }
                    } else {
                        $("#invoice_modal").modal('show');
                        let table_data = `<tr>
                        <td>1. </td>
                        <td>${response.media_belajar.nama_lengkap} </td>
                        <td>${response.jumlah_pertemuan} Kali </td>
                        <td>${rupiah(response.media_belajar.harga_media)} </td>
                        <td> <a href="invoice_mitra/pdf/${response.media_belajar.mitra_pengajar_id}/${response.media_belajar.bulan_media}" class="btn btn-primary btn-sm" target="_blank" id="cetak">Cetak Invoice</a> </td>
                        </tr>`;

                        $("#data").html(table_data);

                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });
</script>

<?= $this->endSection(); ?>