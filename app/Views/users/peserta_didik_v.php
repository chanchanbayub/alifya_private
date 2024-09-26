<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- Team Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Peserta Didik</span>
            </p>
            <h1 class="mb-4">Peserta Didik</h1>
        </div>
        <div class="row">
            <?php foreach ($peserta_didik as $peserta_didik) : ?>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                        <img class="img-fluid w-100" src="/users/img/team-1.jpg" alt="" />
                        <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                            <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light text-center px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <h4><?= $peserta_didik->nama_lengkap_anak ?></h4>
                    <i><?= $peserta_didik->status_murid ?></i>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Team End -->

<?= $this->endSection(); ?>