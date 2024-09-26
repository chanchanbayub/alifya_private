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

                    <img src="/foto_profil/<?= $mitra_pengajar->foto ?>" alt="Profile" class="rounded" height="120px">
                    <h2><?= $mitra_pengajar->nama_lengkap ?></h2>
                    <h3>Mitra Pengajar</h3>
                    <div class="social-links mt-2">
                        <a href="mailto:<?= $mitra_pengajar->email ?>" target="_blank" class="email"><i class="bi bi-envelope"></i></a>
                        <a href="https://wa.me/+<?= $mitra_pengajar->nomor_whatsapp  ?>" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.instagram.com/<?= $mitra_pengajar->username_instagram ?>/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="/cv_file/<?= $mitra_pengajar->cv ?>" target="_blank" class="cv"><i class="bi bi-download"></i></a>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"> <i class="bi bi-users"></i> Profil</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profil Lengkap</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Register ID</div>
                                <div class="col-lg-9 col-md-8">REG - <?= $mitra_pengajar->uid ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->nama_lengkap ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Usia</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->usia ?> Tahun</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->email ?> </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nomor Whatsapp</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->nomor_whatsapp ?> </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Pendidikan Terakhir</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->pendidikan_terakhir ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jurusan </div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->jurusan ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat Domisili</div>
                                <div class="col-lg-9 col-md-8"><?= $mitra_pengajar->alamat_domisili ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status Perkawinan</div>
                                <?php if ($mitra_pengajar->status_perkawinan == 1) : ?>
                                    <div class="col-lg-9 col-md-8">Lajang</div>
                                <?php elseif ($mitra_pengajar->status_perkawinan == 2) : ?>
                                    <div class="col-lg-9 col-md-8">Menikah (Sedang Hamil)</div>
                                <?php elseif ($mitra_pengajar->status_perkawinan == 3) : ?>
                                    <div class="col-lg-9 col-md-8">Menikah (Tidak Sedang Hamil)</div>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status</div>

                                <div class="col-lg-9 col-md-8"><span class="<?= ($mitra_pengajar->status_id == 1) ? 'badge bg-success' : 'badge bg-warning' ?>"><?= $mitra_pengajar->status_pengajar ?></span> </div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>