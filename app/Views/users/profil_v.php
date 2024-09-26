<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- About Start -->
<div class="container-fluid">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid rounded mb-5 mb-lg-0" src="/users/img/1.jpg" alt="" />
            </div>
            <div class="col-lg-7">
                <p class="section-title pr-5">
                    <span class="pr-2">Tentang Kami</span>
                </p>
                <h1 class="mb-4">Les Private Terbaik Untuk Anak Anda</h1>
                <p style="text-align: justify;">
                    Alifya Private merupakan lembaga pendidikan nonformal yang dibangun untuk membantu dan bersinergi bersama orang tua dalam memfasilitasi kebutuhan pendampingan belajar anak dengan metode learning by playing.
                </p>
                <div class="row pt-2">
                    <div class="col-6 col-md-4">
                        <img class="img-fluid rounded" src="/users/img/2.jpg" alt="" />
                    </div>
                    <div class="col-6 col-md-8">
                        <ul class="list-inline m-0">
                            <li class="py-2 border-top border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Guru Datang Kerumah
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Media pembelajaran yang diguakan sesuai dengan kebutuhan dan kesukaan anak, dengan menggunakan metode learning by playing
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Durasi Belajar 90 Menit
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Laporan Kegiatan Pembelajaran Tiap Pertemuan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <!-- <h1 class="mb-4">Les Private Terbaik Untuk Anak Anda</h1> -->
            <h3 class="section-title pr-5" style="text-align: center;">
                <span class="pr-2">Visi</span>
            </h3>
            <!-- <h1 class="mb-4">Les Private Terbaik Untuk Anak Anda</h1> -->
            <p style="text-align: justify;">
                Mewujudkan Alifya Private sebagai pusat pendidikan yang berorientasi pada karakteristik anak dalam menghasilkan generasi pembelajar sejak dini.
            </p>
            <h3 class="section-title pr-5" style="text-align: center;">
                <span class="pr-2">Misi</span>
            </h3>
            <p style="text-align: justify;">
                Mendirikan lembaga pendidikan anak dengan memfasilitasi pembelajaran iqro dan calistung sesuai dengan tahap kemampuan dan kesukaan anak
                Mengenalkan dan mengamalkan nilai-nilai keagamaan dalam kehidupan sehari-hari
                Menciptakan metode pembelajaran yang aktif, kreatif, inovatif melalui learning by playing.
            </p>

        </div>
    </div>
</div>

<!-- Team Start -->
<div class="container">
    <div class="text-center pb-2">
        <p class="section-title px-5">
            <span class="px-2">Galeri Kami</span>
        </p>
    </div>
    <div class="row">
        <div class="col-md-4 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid w-100 rounded" src="/users/img/1.jpg" alt="" />
            </div>
        </div>
        <div class="col-md-4 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid w-100 rounded" src="/users/img/2.jpg" alt="" />
            </div>
        </div>
        <div class="col-md-4 text-center team mb-5">
            <div class="position-relative overflow-hidden mb-4">
                <img class="img-fluid w-100 rounded" src="/users/img/3.jpg" alt="" />
            </div>
        </div>



    </div>
</div>
<!-- Team End -->

<?= $this->endSection(); ?>