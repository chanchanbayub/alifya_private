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
                    <h4 class="text-center"><?= $profil->nama_lengkap_anak ?></h4>
                    <span>Peserta Didik</span>

                    <div class="social-links mt-2">
                        <a href="https://wa.me/+<?= $profil->nomor_whatsapp_wali ?>" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.instagram.com/<?= $profil->username_instagram_wali ?>/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="/bukti_tf_private/<?= $profil->bukti_tf ?>" target="_blank" class="instagram"><i class="bi bi-file"></i></a>
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

                        <h5 class="card-title">Komitmen Awal Orang Tua Orang Tua</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-4 label ">Apakah Mom/Pap bersedia untuk Ananda ikut berproses bersama Alifya?
                            </div>
                            <div class="col-lg-6 col-md-8"> <?= $profil->ketersediaan ?></div>
                        </div>

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profil Orang Tua</h5>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Ayah</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_ayah ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Pekerjaan Ayah</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->pekerjaan_ayah ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Ibu</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nama_ibu ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nama Pekerjaan Ibu</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->pekerjaan_ibu ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Nomor Whatsapp Orang Tua</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->nomor_whatsapp_wali ?> </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Alamat Domisili</div>
                                <div class="col-lg-6 col-md-8"><?= $profil->alamat_domisili_anak ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 label">Username Instagram Orang Tua</div>
                                <div class="col-lg-6 col-md-8"> <a href="https://www.instagram.com/<?= $profil->username_instagram_wali ?>/" target="_blank"><?= $profil->username_instagram_wali ?></a> </div>
                            </div>
                        </div>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profil Lengkap</h5>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Nama Lengkap Anak</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->nama_lengkap_anak ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Nama Panggilan Anak</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->nama_panggilan_anak ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Tanggal Lahir</div>
                                    <?php if ($profil->tanggal_lahir_anak == null) : ?>
                                        <div class="col-lg-6 col-md-8">-</div>
                                    <?php else : ?>
                                        <div class="col-lg-6 col-md-8"><?= date("d-m-Y", strtotime($profil->tanggal_lahir_anak))  ?> </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Usia</div>
                                    <div class="col-lg-6 col-md-8"><?= $usia->y ?> Tahun, <?= $usia->m ?> Bulan, <?= $usia->d ?> Hari
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Jenis Kelamin</div>
                                    <?php if ($profil->jenis_kelamin == "l") : ?>
                                        <div class="col-lg-6 col-md-8">Laki-laki</div>
                                    <?php elseif ($profil->jenis_kelamin == "p") : ?>
                                        <div class="col-lg-6 col-md-8">Perempuan</div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Sekolah Anak</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->sekolah_anak ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Pendidikan Formal Saat Ini</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->pendidikan ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Ukuran Baju</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->ukuran_baju ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Program Belajar</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->nama_program ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Jumlah Pertemuan</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->jumlah_pertemuan ?> x / perbulan</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Materi Belajar</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->level ?> x / perbulan</div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Hari Belajar</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->hari_belajar ?> </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Waktu Belajar</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->waktu_belajar ?> </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Dari mana Mom/Pap mengetahui Alifya Learning?</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->info_les ?> </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Catatan Untuk Mitra Pengajar</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->catatan ?> </div>
                                </div>

                                <h5 class="card-title">Pesetujuan</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Apakah Mom/Pap berkenan jika dokumentasi kegiatan belajar Ananda (foto/video) digunakan untuk kebutuhan media sosial Alifya Learning??
                                    </div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->izin_dokumentasi ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Tata Tertib
                                    </div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->tata_tertib ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Tindak Lanjut </div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->tindak_lanjut ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Prohibition/Larangan</div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->larangan ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-4 label">Saya menyatakan bahwa
                                    </div>
                                    <div class="col-lg-6 col-md-8"><?= $profil->data_1 ?> <br> <?= $profil->data_2 ?> </div>
                                </div>



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