<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- Header Start -->
<div class="container-fluid bg-primary px-0 px-md-5 mb-5">
    <div class="row align-items-center px-3">
        <div class="col-lg-6 text-center text-lg-left">
            <h4 class="text-white mb-4 mt-5 mt-lg-0">Alifya Private</h4>
            <h1 class="display-3 font-weight-bold text-white">
                Les Private Diwilayah Jawa Barat
            </h1>
            <p class="text-white mb-4">
                Alifya Private merupakan lembaga pendidikan nonformal yang dibangun untuk membantu dan bersinergi bersama orang tua dalam memfasilitasi kebutuhan pendampingan belajar anak dengan metode learning by playing.
            </p>
            <a href="/program_belajar" class="btn btn-secondary btn-sm mt-1 py-3 px-5">Program Belajar</a>
        </div>
        <div class="col-lg-6 text-center">
            <div class="row">
                <div class="container">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/users/img/slidder/2.jpg" class="img-fluid img-thumbnail w-75 mt-5 mb-5" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/users/img/slidder/3.jpeg" class="img-fluid img-thumbnail w-75 mt-5 mb-5" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="/users/img/slidder/5.jpeg" class="img-fluid img-thumbnail w-75 mt-5 mb-5" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <img class="img-fluid mt-5" src="/users/img/header.png" alt="" /> -->
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Facilities Start -->
<div class="container-fluid pt-5">
    <div class="container pb-3">
        <div class="row">
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
                    <i class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"></i>
                    <div class="pl-4">
                        <h5>Home Visit</h5>
                        <p class="m-0">
                            Orang Tua Tidak Perlu Repot Mengantar Anak Ketempat Les
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
                    <i class="flaticon-022-drum h1 font-weight-normal text-primary mb-3"></i>
                    <div class="pl-4">
                        <h5>Laporan Belajar Terupdate</h5>
                        <p class="m-0">
                            Laporan Perkembangan anak Terupdate Setiap Saat
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
                    <i class="flaticon-030-crayons h1 font-weight-normal text-primary mb-3"></i>
                    <div class="pl-4">
                        <h5>Pembayaran di Akhir</h5>
                        <p class="m-0">
                            Pembayaran dilakukan Diakhir, ya Moms
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facilities Start -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid rounded mb-5 mb-lg-0" src="/users/img/1.jpg" alt="" />
            </div>
            <div class="col-lg-7">
                <p class="section-title pr-5">
                    <span class="pr-2">Tentang Kami</span>
                </p>
                <h1 class="mb-4">Les Private Terbaik Untuk Anak Anda</h1>
                <p>
                    Alifya Private merupakan lembaga pendidikan nonformal yang dibangun untuk membantu dan bersinergi bersama orang tua dalam memfasilitasi kebutuhan pendampingan belajar anak dengan metode learning by playing.
                </p>
                <div class="row pt-2 pb-4">
                    <div class="col-6 col-md-4">
                        <img class="img-fluid rounded" src="/users/img/2.jpg" alt="" />
                        <a href="/profil" class="btn btn-secondary btn-sm mt-2 py-2 px-4">About Us</a>
                    </div>
                    <div class="col-6 col-md-8">
                        <ul class="list-inline m-0">
                            <li class="py-2 border-top border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Guru Datang Kerumah
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Media pembelajaran yang diguakan sesuai dengan kebutuhan dan kesukaan anak, dengan menggunakan metode learning by playing</em>
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
    </div>
</div>
<!-- About End -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Paket Belajar</span>
            </p>
            <h1 class="mb-4">Paket Belajar</h1>
        </div>
        <div class="row text-center">
            <?php foreach ($paket_belajar as $paket) : ?>

                <div class="col-lg-6">
                    <div class="card-body border-0 bg-light shadow-sm pb-2 text-center">
                        <div class="card-body text-center py-6 px-3">
                            <h3 class="card-title text-capitalize"><?= $paket->nama_paket ?></h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Jumlah Pertemuan</th>
                                        <th scope="col">Harga</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?= $paket->jumlah_pertemuan ?> x dalam sebulan</th>
                                        <td>Rp. <?= number_format($paket->harga) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<!-- Class Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Program Belajar</span>
            </p>
            <h1 class="mb-4">Program Belajar</h1>
        </div>
        <div class="row">
            <?php foreach ($program_belajar as $program) : ?>
                <div class="col-lg-4 mb-5">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <img class="card-img-top mb-2 img-thumbnail" style="object-fit: scale-down; height:450px" src="/banner/<?= $program->banner ?>" alt="" />
                        <div class="card-body text-center">
                            <h3 class="card-title text-capitalize"><?= $program->nama_program ?></h3>
                            <p class="card-text">

                            </p>
                        </div>
                        <div class="card-footer bg-transparent py-6 px-3">
                            <div class="row border-bottom">
                                <div class="col-12 py-1 text-center">
                                    <strong>Usia Anak</strong>
                                </div>

                                <div class="col-12 py-1 text-center"><?= $program->usia_anak ?></div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-left">
                                    <strong>Jumlah Pertemuan</strong>
                                </div>
                                <div class="col-6 py-1 text-left">Berdasarkan Paket</div>
                            </div>
                            <div class=" row border-bottom">
                                <div class="col-12 py-1 text-center">
                                    <button type="button" class="btn btn-primary btn-sm mt-2 mb-2" data-toggle="modal" data-target="#staticBackdrop" data-id="<?= $program->id ?>" id="materi">
                                        Lihat Materi Belajar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a href="/daftar_peserta_didik" class="btn btn-secondary btn-sm">Join Now</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- Class End -->
<!-- Registration End -->

<!-- Team Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Guru Alifya Private</span>
            </p>
            <h1 class="mb-4">Guru Pengajar</h1>
        </div>
        <div class="row">
            <?php foreach ($data_pengajar as $pengajar) : ?>
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4">

                        <img class="rounded-circle w-90" style="height:250px;" src="/foto_profil/<?= $pengajar->foto ?>" alt="" />
                        <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                        </div>
                    </div>
                    <h6 class="text-capitalize"><?= $pengajar->nama_lengkap ?></h6>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Team End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container p-0">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Testimonial</span>
            </p>
            <h1 class="mb-4">Apa Kata Orang Tua</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme owl-loaded">
                    <?php if (count($slidder) > 0) : ?>
                        <?php foreach ($slidder as $item) : ?>
                            <div class="card shadow">
                                <div class="card body">
                                    <a href="<?= $item->link_instagram ?>" target="_blank"> <img src="/testimoni/<?= $item->foto_1 ?>" class="img-thumbnail" style="object-fit: scale-down; height:250px " alt="Klik Gambar Untuk Link"></a>
                                    <div class="card shadow">
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id="data">An item</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function(e) {

        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                // loop: true,
                slideBy: 3,
                margin: 10,
                nav: true
            });
        });

        $(document).on('click', '#materi', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                url: '/materi_belajar',
                method: 'get',
                dataType: 'JSON',
                data: {
                    id: id,
                },
                success: function(response) {
                    console.log(response.materi_belajar)
                    $("#staticBackdropLabel").html(response.program_belajar.nama_program)
                    $("#judul_materi").html(response.program_belajar.nama_program)
                    let materi_data = '';
                    response.materi_belajar.forEach(function(e) {
                        materi_data += `<a class="list-group-item list-group-item-action" id="data" aria-current="true">
                    ${e.level}
                    </a>`;
                    });

                    $("#data").html(materi_data);

                }
            });
        })
    })
</script>

<!-- Testimonial End -->

<?= $this->endSection(); ?>