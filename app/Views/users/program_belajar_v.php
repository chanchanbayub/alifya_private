<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
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
                        <img class="card-img-top mb-2" src="/banner/<?= $program->banner ?>" alt="" />
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

<script>
    $(document).ready(function(e) {
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

<?= $this->endSection(); ?>