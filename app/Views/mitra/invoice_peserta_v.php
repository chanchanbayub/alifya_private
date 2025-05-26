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
                                <!-- <th scope="col" style="text-transform: capitalize; text-align:center">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody id="table_invoice_peserta">

                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: center;">Jumlah :</th>
                                <th colspan="2" class="total_presensi_perbulan" style="text-align: center;">0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End Left side columns -->
</section>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Form <small> <?= $title ?></small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <label for="mitra_pengajar_id" class="col-form-label">Pilih Mitra Pengajar Id :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-mitra-pengajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="peserta_didik_id" class="col-form-label">Pilih Peserta Didik :</label>
                        <select name="peserta_didik_id" id="peserta_didik_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback error-peserta-didik">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_invoice" class="col-form-label">Pilih Bulan :</label>
                        <input type="month" name="bulan_invoice" id="bulan_invoice" class="form-control">
                        <div class="invalid-feedback error-bulan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_kehadiran" class="col-form-label">Jumlah Kehadiran :</label>
                        <input type="text" name="jumlah_kehadiran" id="jumlah_kehadiran" class="form-control">
                        <div class="invalid-feedback error-jumlah-kehadiran">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success update"> <i class="bi bi-arrow-right"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $("#cek_data").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();
            $.ajax({
                url: '/mitra_pengajar/invoice/cek_invoice',
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
                                <td>${e.nama_lengkap_anak}</td>
                                <td align="center">${e.total_presensi}</td>;`;
                                // <td align="center"><button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${e.mitra_pengajar_id} ${e.peserta_didik_id} ${e.total_presensi}" type="button">
                                //                     <i class="bi bi-pencil-square"></i>
                                //                 </button></td>`;
                            });
                            $("#table_invoice_peserta").html(table_invoice_data);
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