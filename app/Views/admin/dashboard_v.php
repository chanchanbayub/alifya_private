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

<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h5 class="card-title"> <u>Mitra Pengajar Alifya Private</u> </h5>
            </div>
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-3 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total <span>| Mitra Pengajar </span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $mitra_pengajar ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total <span>| Mitra Pengajar(Aktif) </span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $mitra_pengajar_aktif ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total <span>| Mitra Pengajar (Pendaftaran) </span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $mitra_pengajar_pendaftaran ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total <span>| Mitra Pengajar (Tidak Aktif) </span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $mitra_pengajar_off ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h5 class="card-title"> <u>Peserta Didik Alifya Private</u> </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
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
            <div class="col-lg-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Aktif) </span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_aktif ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Waiting List)</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_waiting ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Pendaftaran)</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_pendaftaran ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (OFF)</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_off ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<hr>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h5 class="card-title"> <u>Mitra Pengajar Alifya Home Learning</u> </h5>
            </div>
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total <span>| Mitra Pengajar </span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $mitra_pengajar_ahl ?></h6>
                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle">
                <h5 class="card-title"> <u>Peserta Didik Alifya Home Learning</u> </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik </span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_ahl ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Aktif) </span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_ahl_aktif ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Waiting List)</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_ahl_waiting ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (Pendaftaran)</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_ahl_pendaftaran ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-12">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><span>| Peserta Didik (OFF)</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $peserta_didik_ahl_off ?></h6>
                                <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>