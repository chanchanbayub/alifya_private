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
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Profil</th>
                                        <th scope="col">Status Pengajar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_pengajar as $pengajar) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td>
                                                <span class="text-capitalize"><?= $pengajar->nama_lengkap ?></span>
                                            </td>
                                            <td><?= $pengajar->email ?></td>
                                            <td> <a href="/mitra_pengajar/data_pengajar/view/<?= $pengajar->email ?>" target="_blank" class="btn btn-sm btn-outline-primary" data-id="<?= $pengajar->id ?>">
                                                    <i class="bi bi-eye"> Lihat Data</i>
                                                </a> </td>
                                            <td><span class='<?= ($pengajar->status_id == 1) ? "badge bg-success" : "badge bg-warning" ?>'><?= $pengajar->status_pengajar ?></span> </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>