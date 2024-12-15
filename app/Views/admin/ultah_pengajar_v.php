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
        <div class="col-md-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Cek Ultah Mitra Pengajar</h5>
                    <!-- Browser Default Validation -->
                    <form class="row g-3 text-capitalize" id="cek_ultah">
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
                            <button class="btn btn-outline-primary btn-block save" id="cek_data" type="submit"> <i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                    <!-- End Browser Default Validation -->
                </div>
            </div>
        </div>
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Tanggal Lahir </th>
                                        <th scope="col">Status Pengajar </th>
                                        <th scope="col">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_pengajar_ultah as $pengajar) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td>
                                                <span class="text-capitalize"><?= $pengajar->nama_lengkap ?></span>
                                            </td>
                                            <td><?= ($pengajar->tanggal_lahir_mitra == null) ? "-" : date('d-M-Y', strtotime($pengajar->tanggal_lahir_mitra))  ?></td>

                                            <td><span class='<?= ($pengajar->status_id == 1) ? "badge bg-success" : "badge bg-warning" ?>'><?= $pengajar->status_pengajar ?></span></td>
                                            <?php if ($pengajar->tanggal_lahir_mitra == null) : ?>
                                                <td><a aria-disabled="true">Tambah Google Calendar</a></td>
                                            <?php else : ?>
                                                <td><a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Example+Google+Calendar+Event&details=More+help+see:+https://support.google.com/calendar/thread/81344786&dates=<?= $tahun ?><?= date('md', strtotime($pengajar->tanggal_lahir_mitra)) ?>/<?= $tahun ?><?= date('md', strtotime($pengajar->tanggal_lahir_mitra)) ?>UNTIL%3D<?= $tahun ?>0603&ctz=Asia/Jakarta" target="_blank">Tambah Google Calendar</a></td>
                                            <?php endif; ?>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <br>
                            <iframe src=" https://calendar.google.com/calendar/embed?src=69b50ef13cc072fbcdc37060abdd7e5ad98b54fdc2eac4124da7b2bd4e9f3aef%40group.calendar.google.com&ctz=Asia%2FJakarta" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<!-- modal save-->
<div class="modal fade" id="ultahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Umur Sekarang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table_data">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Save -->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {
        $('#bulan').select2({
            theme: 'bootstrap-5',
        });


    });

    $(document).ready(function(e) {
        $("#cek_ultah").submit(function(e) {
            e.preventDefault();
            let bulan = $("#bulan").val();
            $.ajax({
                url: '/admin/data_pengajar/data_ulang_tahun_mitra',
                data: {
                    bulan: bulan
                },
                dataType: 'json',
                type: 'POST',
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    console.log(response.tahun);
                    let no = 1;
                    let table_data = ``;
                    $('.save').html('<i class="bi bi-search"></i> Search');
                    $('.save').prop('disabled', false);
                    if (response.data_ultah.length >= 1) {
                        $("#ultahModal").modal('show');
                        response.data_ultah.forEach(function(e) {
                            table_data += `<tr>
                                <td>${no++}</td>
                                <td>${e.nama_lengkap}</td>
                                <td>${e.tanggal_lahir_mitra}</td>
                                <td>${new Date().getFullYear() - new Date(e.tanggal_lahir_mitra).getFullYear() } Tahun </td>
                                <td><a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Example+Google+Calendar+Event&details=More+help+see:+https://support.google.com/calendar/thread/81344786&dates=${new Date().getFullYear()}${new Date(e.tanggal_lahir_mitra).getMonth()}${new Date(e.tanggal_lahir_mitra).getDate()}/${new Date().getFullYear()}${new Date(e.tanggal_lahir_mitra).getMonth()}${new Date(e.tanggal_lahir_mitra).getDate()}UNTIL%3D${new Date().getFullYear()}0603&ctz=Asia/Jakarta" target="_blank">Tambah Google Calendars</a></td>
                            </tr>`;
                        });
                        $(".table_data").html(table_data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Data Tidak Ditemukan`,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-search"></i> Search');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });
</script>

<?= $this->endSection(); ?>