<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- Team Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Mitra Pengajar</span>
            </p>
            <h1 class="mb-4">Mitra Pengajar</h1>
        </div>
        <div class="row">
            <?php foreach ($mitra_pengajar as $mitra_pengajar) : ?>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                        <img class="img-fluid w-100" style="height: 280px; " src="/foto_profil/<?= $mitra_pengajar->foto ?>" alt="" />
                        <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                        </div>
                    </div>
                    <h4 class="text-uppercase"><?= $mitra_pengajar->nama_lengkap ?></h4>
                    <i>Mitra Pengajar</i>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Team End -->

<?= $this->endSection(); ?>