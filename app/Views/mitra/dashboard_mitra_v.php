<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <h5 class="card-title"><span>| Mitra Pengajar</span></h5>
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title"><span>| Peserta Didik </span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-bounding-box"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $peserta_didik ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sales Card -->

                <!-- End Sales Card -->

                <!-- Sales Card -->
            </div>
        </div><!-- End Left side columns -->
    </div>
</section>

<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 badge text-bg-danger" id="exampleModalLabel">Perhatian !! </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-body-secondary" style="text-align: justify;">Bagi yang belum melengkapi Tanggal Lahir di halaman Profil Peserta Didik maupun Mitra Pengajar, dan Jadwal Tetap, mohon segera mengisi data tersebut, terima kasih!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Ok, mengerti</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(e) {
        $("#notifModal").modal('show');
    })
</script>

<?= $this->endSection(); ?>