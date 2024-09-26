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

                    <img src="/foto_profil_anak/<?= $profil->foto_anak ?>" alt="Profile" class="rounded" height="120px">
                    <h4><?= $profil->nama_lengkap_anak ?></h4>
                    <span>Peserta Didik</span>

                    <div class="social-links mt-2">
                        <a href="https://wa.me/+<?= $profil->nomor_whatsapp_wali ?>" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.instagram.com/<?= $profil->username_instagram_wali ?>/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
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
                                <div class="col-lg-6 col-md-4 label ">Register ID</div>
                                <div class="col-lg-6 col-md-8">REG - <?= $profil->uid_murid ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label ">Nama</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_lengkap_anak ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label ">Tanggal Lahir</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->tanggal_lahir_anak ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Usia</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->usia_anak ?> Tahun</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Alamat Domisili</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->alamat_domisili_anak ?> </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Sekolah Anak</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->sekolah_anak ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Ayah</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_ayah ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Pekerjaan Ayah</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->pekerjaan_ayah ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Ibu</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_ibu ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Pekerjaan Ibu</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->pekerjaan_ibu ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nomor Whatsapp Wali</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nomor_whatsapp_wali ?> </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Tahu Alifya dari (Boleh Sebut Nama) </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->info_les ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Username Instagram Wali </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->username_instagram_wali ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Paket Belajar </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_paket ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Program Belajar </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_program ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Materi Belajar </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->level ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Hari Belajar </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->hari_belajar ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Waktu Belajar </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->waktu_belajar ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Saya Sudah Mengetahui Program dan Biaya Paket Belajar melalui Brosur / Internet </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->brosur ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Saya Sudah Mengisi data diatas dengan benar, jujur, dan dapat dipertanggung jawabkan </div>
                                <div class="col-lg-6 col-md-8"><?= $profil->data ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Status</div>
                                <div class="col-lg-6 col-md-8"><span class="<?= ($profil->status_murid_id == 1) ? 'badge bg-success' : 'badge bg-warning' ?>"><?= $profil->status_murid ?></span> </div>
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