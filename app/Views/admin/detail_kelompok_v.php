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

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="/foto_profil/<?= $kelompok->foto ?>" alt="Profile" class="rounded" height="120px"><br>
                    <h5 class="text-capitalize"><?= $kelompok->nama_lengkap ?></h5>
                    <span class="badge bg-success"><?= $kelompok->status_pengajar ?></span>
                </div>
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"> <i class="bi bi-users"></i> Peserta Didik</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="card-body">
                            <table class="table table-bordered datatable text-capitalize">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Peserta Didik</th>
                                        <th scope="col">Status Murid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($kelompok_belajar as $kelompok_belajar) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++; ?>.</a></th>
                                            <td><a href="/admin/data_murid/view/<?= $kelompok_belajar->peserta_didik_id ?>"><?= $kelompok_belajar->nama_lengkap_anak ?></a> </td>
                                            <td><span class="badge bg-success"><?= $kelompok_belajar->status_murid ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>