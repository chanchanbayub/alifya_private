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

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Aksi</h6>
                                </li>
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah <?= $title ?></a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Profil</th>
                                        <th scope="col">Status Pengajar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_pengajar as $pengajar) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td>
                                                <span class="text-capitalize"><?= $pengajar->nama_lengkap ?></span>
                                            </td>
                                            <td><?= $pengajar->email ?></td>
                                            <td> <a href="/admin/data_pengajar/view/<?= $pengajar->email ?>" target="_blank" class="btn btn-sm btn-outline-primary" data-id="<?= $pengajar->id ?>">
                                                    <i class="bi bi-eye"> Lihat Data</i>
                                                </a> </td>
                                            <td><span class='<?= ($pengajar->status_id == 1) ? "badge bg-success" : "badge bg-warning" ?>'><?= $pengajar->status_pengajar ?></span> </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $pengajar->id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $pengajar->id ?>" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<!-- modal save-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah <?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="col-form-label">Nama Lengkap dengan Gelar :</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama lengkap">
                        <div class="invalid-feedback error-nama">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_whatsapp" class="col-form-label">Nomor Whatsapp :</label>
                        <input type="number" class="form-control" id="nomor_whatsapp" name="nomor_whatsapp" placeholder="62">
                        <div class="invalid-feedback error-nomor">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email :</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="abc@gmail.com">
                        <div class="invalid-feedback error-email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="usia" class="col-form-label">Usia :</label>
                        <input type="number" class="form-control" id="usia" name="usia" placeholder="26">
                        <div class="invalid-feedback error-usia">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_domisili" class="col-form-label">Alamat Domisili :</label>
                        <textarea name="alamat_domisili" id="alamat_domisili" class="form-control"></textarea>
                        <div class="invalid-feedback error-alamat">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_terakhir" class="col-form-label">Pendidikan Terakhir :</label>
                        <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="S-1">
                        <div class="invalid-feedback error-pendidikan">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="col-form-label">Jurusan :</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="PG - PAUD">
                        <div class="invalid-feedback error-jurusan">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status_perkawinan" class="col-form-label">Status Perkawinan :</label>
                        <select name="status_perkawinan" id="status_perkawinan" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>
                            <option value="1">Lajang</option>
                            <option value="2">Menikah (sedang hamil)</option>
                            <option value="3">Menikah (tidak sedang hamil)</option>
                        </select>
                        <div class="invalid-feedback error-status-perkawinan">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username_instagram" class="col-form-label">Username Instagram :</label>
                        <input type="text" class="form-control" id="username_instagram" name="username_instagram" placeholder="@abcd">
                        <div class="invalid-feedback error-username">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan">Pekerjaan / Kesibukan Saat ini :</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="contoh : guru" />
                        <div class="invalid-feedback error-pekerjaan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kontrak">Apakah anda siap untuk di kontrak 1 Tahun (tidak berencana mengikuti kuliah, ppg, tidak berencana pindah domisili, tidak dalam persiapan menikah) :</label>
                        <select name="kontrak" id="kontrak" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya, Siap dikontrak 1 Tahun</option>
                            <option value="2">Tidak, Karena sudah ada rencana lain dalam waktu dekat</option>
                        </select>
                        <div class="invalid-feedback error-kontrak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pernyataan">Apakah anda siap jika ditempatkan mengajar ke rumah anak, dengan jarak mak. 30 menit dari domisili anda (12 - 15km) :</label>
                        <select name="pernyataan" id="pernyataan" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya, Siap</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback error-pernyataan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kendaraan_pribadi">Memiliki Kendaraan Pribadi :</label>
                        <select name="kendaraan_pribadi" id="kendaraan_pribadi" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback error-kendaraan-pribadi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="media_belajar">Seberapa siapkah anda dalam menyediakan media belajar bagi anak usia 2 - 6 tahun yang kreatif, silahkan jelaskan :</label>
                        <input type="text" class="form-control" id="media_belajar" name="media_belajar" />
                        <div class="invalid-feedback error-media-belajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alasan_bergabung">Alasan ingin bergabung mengajar di Alifya Private :</label>
                        <input type="text" class="form-control" id="alasan_bergabung" name="alasan_bergabung" />
                        <div class="invalid-feedback error-alasan-bergabung">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kelebihan">Apa yang bisa anda tawarkan kepada kami supaya Alifya Private bisa memilih anda sebagai calon mitra pengajar dan mengikuti tahap selanjutnya yaitu interview :</label>
                        <input type="text" class="form-control" id="kelebihan" name="kelebihan" />
                        <div class="invalid-feedback error-kelebihan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="info_loker">Tahu info loker alifya Private dari (Sebutkan nama / platform) :</label>
                        <input type="text" class="form-control" id="info_loker" name="info_loker" />
                        <div class="invalid-feedback error-info-loker">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="col-form-label">Foto Terbaru :</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="invalid-feedback error-foto">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cv" class="col-form-label">CV Terbaru :</label>
                        <input type="file" class="form-control" id="cv" name="cv">
                        <div class="invalid-feedback error-cv">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ijazah">Upload Ijazah (pdf) :</label>
                        <input type="file" class="form-control" id="ijazah" name="ijazah" />
                        <div class="invalid-feedback error-ijazah">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_id" class="col-form-label">Status Pengajar :</label>
                        <select name="status_id" id="status_id" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>
                            <?php foreach ($status_pengajar as $status_pengajar) : ?>
                                <option value="<?= $status_pengajar->id ?>"> <?= $status_pengajar->status_pengajar ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success save"> <i class="bi bi-arrow-right"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Save -->

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Form <small>Edit <?= $title ?></small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <input type="hidden" class="form-control" id="fotoLama" name="foto">
                        <input type="hidden" class="form-control" id="cvLama" name="cv">
                        <input type="text" class="form-control" id="ijazahLama" name="ijazah">
                        <label for="nama_lengkap_edit" class="col-form-label">Nama Lengkap :</label>
                        <input type="text" class="form-control" id="nama_lengkap_edit" name="nama_lengkap" placeholder="masukan nama lengkap">
                        <div class="invalid-feedback error-nama-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_whatsapp_edit" class="col-form-label">Nomor Whatsapp :</label>
                        <input type="number" class="form-control" id="nomor_whatsapp_edit" name="nomor_whatsapp" placeholder="62">
                        <div class="invalid-feedback error-nomor-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email_edit" class="col-form-label">Email :</label>
                        <input type="email" class="form-control" id="email_edit" name="email" placeholder="abc@gmail.com">
                        <div class="invalid-feedback error-email-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="usia_edit" class="col-form-label">Usia :</label>
                        <input type="number" class="form-control" id="usia_edit" name="usia" placeholder="26">
                        <div class="invalid-feedback error-usia-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_domisili_edit" class="col-form-label">Alamat Domisili :</label>
                        <textarea name="alamat_domisili" id="alamat_domisili_edit" class="form-control"></textarea>
                        <div class="invalid-feedback error-alamat-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_terakhir_edit" class="col-form-label">Pendidikan Terakhir :</label>
                        <input type="text" class="form-control" id="pendidikan_terakhir_edit" name="pendidikan_terakhir" placeholder="S-1">
                        <div class="invalid-feedback error-pendidikan-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan_edit" class="col-form-label">Jurusan :</label>
                        <input type="text" class="form-control" id="jurusan_edit" name="jurusan" placeholder="PG - PAUD">
                        <div class="invalid-feedback error-jurusan-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status_perkawinan_edit" class="col-form-label">Status Perkawinan :</label>
                        <select name="status_perkawinan" id="status_perkawinan_edit" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>
                            <option value="1">Lajang</option>
                            <option value="2">Menikah (sedang hamil)</option>
                            <option value="3">Menikah (tidak sedang hamil)</option>
                        </select>
                        <div class="invalid-feedback error-status-perkawinan-edit">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username_instagram_edit" class="col-form-label">Username Instagram :</label>
                        <input type="text" class="form-control" id="username_instagram_edit" name="username_instagram" placeholder="@abcd">
                        <div class="invalid-feedback error-username-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan_edit">Pekerjaan / Kesibukan Saat ini :</label>
                        <input type="text" class="form-control" id="pekerjaan_edit" name="pekerjaan" placeholder="contoh : guru" />
                        <div class="invalid-feedback error-pekerjaan-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kontrak_edit">Apakah anda siap untuk di kontrak 1 Tahun (tidak berencana mengikuti kuliah, ppg, tidak berencana pindah domisili, tidak dalam persiapan menikah) :</label>
                        <select name="kontrak" id="kontrak_edit" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya, Siap dikontrak 1 Tahun</option>
                            <option value="2">Tidak, Karena sudah ada rencana lain dalam waktu dekat</option>
                        </select>
                        <div class="invalid-feedback error-kontrak-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pernyataan_edit">Apakah anda siap jika ditempatkan mengajar ke rumah anak, dengan jarak mak. 30 menit dari domisili anda (12 - 15km) :</label>
                        <select name="pernyataan" id="pernyataan_edit" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya, Siap</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback error-pernyataan-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kendaraan_pribadi_edit">Memiliki Kendaraan Pribadi :</label>
                        <select name="kendaraan_pribadi" id="kendaraan_pribadi_edit" class="form-control">
                            <option value="">Silahkan Pilih </option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback error-kendaraan-pribadi-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="media_belajar_edit">Seberapa siapkah anda dalam menyediakan media belajar bagi anak usia 2 - 6 tahun yang kreatif, silahkan jelaskan :</label>
                        <input type="text" class="form-control" id="media_belajar_edit" name="media_belajar" />
                        <div class="invalid-feedback error-media-belajar-edi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alasan_bergabung_edit">Alasan ingin bergabung mengajar di Alifya Private :</label>
                        <input type="text" class="form-control" id="alasan_bergabung_edit" name="alasan_bergabung" />
                        <div class="invalid-feedback error-alasan-bergabung-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kelebihan_edit">Apa yang bisa anda tawarkan kepada kami supaya Alifya Private bisa memilih anda sebagai calon mitra pengajar dan mengikuti tahap selanjutnya yaitu interview :</label>
                        <input type="text" class="form-control" id="kelebihan_edit" name="kelebihan" />
                        <div class="invalid-feedback error-kelebihan-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="info_loker_edit">Tahu info loker alifya Private dari (Sebutkan nama / platform) :</label>
                        <input type="text" class="form-control" id="info_loker_edit" name="info_loker" />
                        <div class="invalid-feedback error-info-loker-edit">
                        </div>
                    </div>



                    <div class="mb-3">
                        <label for="foto_edit" class="col-form-label">Foto Terbaru:</label>
                        <input type="file" class="form-control" id="foto_edit" name="foto">
                        <label for="">format : png/jpg/jpeg</label>
                        <div class="invalid-feedback error-foto-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cv_edit" class="col-form-label">CV Terbaru:</label>
                        <input type="file" class="form-control" id="cv_edit" name="cv">
                        <label for="">format : pdf</label>
                        <div class="invalid-feedback error-cv-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ijazah_edit">Upload Ijazah :</label>
                        <input type="file" class="form-control" id="ijazah_edit" name="ijazah" />
                        <label for="">format : pdf</label>
                        <div class="invalid-feedback error-ijazah-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_id_edit" class="col-form-label">Status Pengajar :</label>
                        <select name="status_id" id="status_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>

                        </select>
                        <div class="invalid-feedback error-status-edit">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success update"> <i class="bi bi-arrow-right"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Modal-->

<!-- Modal hapus  -->
<div class="modal fade" id="deleteModal" tabindex="0">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form <small> Hapus <?= $title ?> </small></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="delete_form">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_delete" name="id">
                    <div class="modal-body">
                        <p>Apakah Anda Yakin ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"> <i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-danger button_delete"> <i class="bi bi-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End hapus Modal-->


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {
        $("#add_form").submit(function(e) {
            e.preventDefault();

            let nama_lengkap = $("#nama_lengkap").val();
            let nomor_whatsapp = $("#nomor_whatsapp").val();
            let email = $("#email").val();
            let usia = $("#usia").val();
            let alamat_domisili = $("#alamat_domisili").val();
            let pendidikan_terakhir = $("#pendidikan_terakhir").val();
            let jurusan = $("#jurusan").val();
            let status_perkawinan = $("#status_perkawinan").val();
            let username_instagram = $("#username_instagram").val();
            let pekerjaan = $("#pekerjaan").val();
            let pernyataan = $("#pernyataan").val();
            let kontrak = $("#kontrak").val();
            let kendaraan_pribadi = $("#kendaraan_pribadi").val();
            let media_belajar = $("#media_belajar").val();
            let alasan_bergabung = $("#alasan_bergabung").val();
            let kelebihan = $("#kelebihan").val();
            let info_loker = $("#info_loker").val();
            let ijazah = $("#ijazah").val();
            let foto = $("#foto").val();
            let cv = $("#cv").val();
            let status_id = $("#status_id").val();

            let formData = new FormData(this);

            formData.append('nama_lengkap', nama_lengkap);
            formData.append('nomor_whatsapp', nomor_whatsapp);
            formData.append('email', email);
            formData.append('usia', usia);
            formData.append('alamat_domisili', alamat_domisili);
            formData.append('pendidikan_terakhir', pendidikan_terakhir);
            formData.append('jurusan', jurusan);
            formData.append('status_perkawinan', status_perkawinan);
            formData.append('username_instagram', username_instagram);
            formData.append('pekerjaan', pekerjaan);
            formData.append('pernyataan', pernyataan);
            formData.append('kontrak', kontrak);
            formData.append('kendaraan_pribadi', kendaraan_pribadi);
            formData.append('media_belajar', media_belajar);
            formData.append('alasan_bergabung', alasan_bergabung);
            formData.append('kelebihan', kelebihan);
            formData.append('info_loker', info_loker);
            formData.append('ijazah', ijazah);
            formData.append('foto', foto);
            formData.append('cv', cv);

            $.ajax({
                url: '/admin/data_pengajar/insert',
                data: formData,
                dataType: 'json',
                enctype: 'multipart/form-data',
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.nama_lengkap) {
                            $("#nama_lengkap").addClass('is-invalid');
                            $(".error-nama").html(response.error.nama_lengkap);
                        } else {
                            $("#nama_lengkap").removeClass('is-invalid');
                            $(".error-nama").html('');
                        }
                        if (response.error.nomor_whatsapp) {
                            $("#nomor_whatsapp").addClass('is-invalid');
                            $(".error-nomor").html(response.error.nomor_whatsapp);
                        } else {
                            $("#nomor_whatsapp").removeClass('is-invalid');
                            $(".error-nomor").html('');
                        }
                        if (response.error.email) {
                            $("#email").addClass('is-invalid');
                            $(".error-email").html(response.error.email);
                        } else {
                            $("#email").removeClass('is-invalid');
                            $(".error-email").html('');
                        }
                        if (response.error.usia) {
                            $("#usia").addClass('is-invalid');
                            $(".error-usia").html(response.error.usia);
                        } else {
                            $("#usia").removeClass('is-invalid');
                            $(".error-usia").html('');
                        }
                        if (response.error.alamat_domisili) {
                            $("#alamat_domisili").addClass('is-invalid');
                            $(".error-alamat").html(response.error.alamat_domisili);
                        } else {
                            $("#alamat_domisili").removeClass('is-invalid');
                            $(".error-alamat").html('');
                        }
                        if (response.error.pendidikan_terakhir) {
                            $("#pendidikan_terakhir").addClass('is-invalid');
                            $(".error-pendidikan").html(response.error.pendidikan_terakhir);
                        } else {
                            $("#pendidikan_terakhir").removeClass('is-invalid');
                            $(".error-pendidikan").html('');
                        }
                        if (response.error.jurusan) {
                            $("#jurusan").addClass('is-invalid');
                            $(".error-jurusan").html(response.error.jurusan);
                        } else {
                            $("#jurusan").removeClass('is-invalid');
                            $(".error-jurusan").html('');
                        }
                        if (response.error.status_perkawinan) {
                            $("#status_perkawinan").addClass('is-invalid');
                            $(".error-status-perkawinan").html(response.error.status_perkawinan);
                        } else {
                            $("#status_perkawinan").removeClass('is-invalid');
                            $(".error-status-perkawinan").html('');
                        }
                        if (response.error.username_instagram) {
                            $("#username_instagram").addClass('is-invalid');
                            $(".error-username").html(response.error.username_instagram);
                        } else {
                            $("#username_instagram").removeClass('is-invalid');
                            $(".error-username").html('');
                        }
                        if (response.error.pekerjaan) {
                            $("#pekerjaan").addClass('is-invalid');
                            $(".error-pekerjaan").html(response.error.pekerjaan);
                        } else {
                            $("#pekerjaan").removeClass('is-invalid');
                            $(".error-pekerjaan").html('');
                        }
                        if (response.error.pernyataan) {
                            $("#pernyataan").addClass('is-invalid');
                            $(".error-pernyataan").html(response.error.pernyataan);
                        } else {
                            $("#pernyataan").removeClass('is-invalid');
                            $(".error-pernyataan").html('');
                        }
                        if (response.error.kontrak) {
                            $("#kontrak").addClass('is-invalid');
                            $(".error-kontrak").html(response.error.kontrak);
                        } else {
                            $("#kontrak").removeClass('is-invalid');
                            $(".error-kontrak").html('');
                        }
                        if (response.error.kendaraan_pribadi) {
                            $("#kendaraan_pribadi").addClass('is-invalid');
                            $(".error-kendaraan-pribadi").html(response.error.kendaraan_pribadi);
                        } else {
                            $("#kendaraan_pribadi").removeClass('is-invalid');
                            $(".error-kendaraan-pribadi").html('');
                        }
                        if (response.error.media_belajar) {
                            $("#media_belajar").addClass('is-invalid');
                            $(".error-media-belajar").html(response.error.media_belajar);
                        } else {
                            $("#media_belajar").removeClass('is-invalid');
                            $(".error-media-belajar").html('');
                        }

                        if (response.error.alasan_bergabung) {
                            $("#alasan_bergabung").addClass('is-invalid');
                            $(".error-alasan-bergabung").html(response.error.alasan_bergabung);
                        } else {
                            $("#alasan_bergabung").removeClass('is-invalid');
                            $(".error-alasan-bergabung").html('');
                        }

                        if (response.error.kelebihan) {
                            $("#kelebihan").addClass('is-invalid');
                            $(".error-kelebihan").html(response.error.kelebihan);
                        } else {
                            $("#kelebihan").removeClass('is-invalid');
                            $(".error-kelebihan").html('');
                        }

                        if (response.error.info_loker) {
                            $("#info_loker").addClass('is-invalid');
                            $(".error-info-loker").html(response.error.info_loker);
                        } else {
                            $("#info_loker").removeClass('is-invalid');
                            $(".error-info-loker").html('');
                        }

                        if (response.error.ijazah) {
                            $("#ijazah").addClass('is-invalid');
                            $(".error-ijazah").html(response.error.ijazah);
                        } else {
                            $("#ijazah").removeClass('is-invalid');
                            $(".error-ijazah").html('');
                        }

                        if (response.error.foto) {
                            $("#foto").addClass('is-invalid');
                            $(".error-foto").html(response.error.foto);
                        } else {
                            $("#foto").removeClass('is-invalid');
                            $(".error-foto").html('');
                        }
                        if (response.error.cv) {
                            $("#cv").addClass('is-invalid');
                            $(".error-cv").html(response.error.cv);
                        } else {
                            $("#cv").removeClass('is-invalid');
                            $(".error-cv").html('');
                        }
                        if (response.error.status_id) {
                            $("#status_id").addClass('is-invalid');
                            $(".error-status").html(response.error.status_id);
                        } else {
                            $("#status_id").removeClass('is-invalid');
                            $(".error-status").html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: `${response.success}`,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });

    // Aksi Edit 
    $(document).on('click', "#edit", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/data_pengajar/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.pengajar.id);
                $("#fotoLama").val(response.pengajar.foto);
                $("#cvLama").val(response.pengajar.cv);
                $("#ijazahLama").val(response.pengajar.ijazah);
                $("#nama_lengkap_edit").val(response.pengajar.nama_lengkap);
                $("#email_edit").val(response.pengajar.email);
                $("#usia_edit").val(response.pengajar.usia);
                $("#alamat_domisili_edit").val(response.pengajar.alamat_domisili);
                $("#pendidikan_terakhir_edit").val(response.pengajar.pendidikan_terakhir);
                $("#jurusan_edit").val(response.pengajar.jurusan);
                $("#status_perkawinan_edit").val(response.pengajar.status_perkawinan);
                $("#nomor_whatsapp_edit").val(response.pengajar.nomor_whatsapp);
                $("#username_instagram_edit").val(response.pengajar.username_instagram);
                $("#pekerjaan_edit").val(response.pengajar.pekerjaan);
                $("#pernyataan_edit").val(response.pengajar.pernyataan).trigger('change');
                $("#kontrak_edit").val(response.pengajar.kontrak).trigger('change');
                $("#kendaraan_pribadi_edit").val(response.pengajar.kendaraan_pribadi).trigger('change');
                $("#media_belajar_edit").val(response.pengajar.media_belajar);
                $("#alasan_bergabung_edit").val(response.pengajar.alasan_bergabung);
                $("#kelebihan_edit").val(response.pengajar.kelebihan);
                $("#info_loker_edit").val(response.pengajar.info_loker);

                let status_id = `<option value="">--Silahkan Pilih-- </option>`;

                response.status_pengajar.forEach(function(e) {
                    status_id += `<option value="${e.id}"> ${e.status_pengajar} </option>`;
                })

                $("#status_id_edit").html(status_id);

                $("#status_id_edit").val(response.pengajar.status_id).trigger('change');


            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit').val();
        let fotoLama = $('#fotoLama').val();
        let cvLama = $('#cvLama').val();
        let ijazahLama = $('#ijazahLama').val();
        let nama_lengkap = $("#nama_lengkap_edit").val();
        let nomor_whatsapp = $("#nomor_whatsapp_edit").val();
        let email = $("#email_edit").val();
        let usia = $("#usia_edit").val();
        let alamat_domisili = $("#alamat_domisili_edit").val();
        let pendidikan_terakhir = $("#pendidikan_terakhir_edit").val();
        let jurusan = $("#jurusan_edit").val();
        let status_perkawinan = $("#status_perkawinan_edit").val();
        let username_instagram = $("#username_instagram_edit").val();

        let pekerjaan = $("#pekerjaan_edit").val();
        let pernyataan = $("#pernyataan_edit").val();
        let kontrak = $("#kontrak_edit").val();
        let kendaraan_pribadi = $("#kendaraan_pribadi_edit").val();
        let media_belajar = $("#media_belajar_edit").val();
        let alasan_bergabung = $("#alasan_bergabung_edit").val();
        let kelebihan = $("#kelebihan_edit").val();
        let info_loker = $("#info_loker_edit").val();
        let ijazah = $("#ijazah_edit").val();

        let foto = $("#foto_edit").val();
        let cv = $("#cv_edit").val();
        let status_id = $("#status_id_edit").val();

        let formData = new FormData(this);

        formData.append('id', id);
        formData.append('fotoLama', fotoLama);
        formData.append('cvLama', cvLama);
        formData.append('ijazahLama', ijazahLama);
        formData.append('nama_lengkap', nama_lengkap);
        formData.append('nomor_whatsapp', nomor_whatsapp);
        formData.append('email', email);
        formData.append('usia', usia);
        formData.append('alamat_domisili', alamat_domisili);
        formData.append('pendidikan_terakhir', pendidikan_terakhir);
        formData.append('jurusan', jurusan);
        formData.append('status_perkawinan', status_perkawinan);
        formData.append('username_instagram', username_instagram);
        formData.append('pekerjaan', pekerjaan);
        formData.append('pernyataan', pernyataan);
        formData.append('kontrak', kontrak);
        formData.append('kendaraan_pribadi', kendaraan_pribadi);
        formData.append('media_belajar', media_belajar);
        formData.append('alasan_bergabung', alasan_bergabung);
        formData.append('kelebihan', kelebihan);
        formData.append('info_loker', info_loker);
        formData.append('ijazah', ijazah);
        formData.append('foto', foto);
        formData.append('cv', cv);
        formData.append('status_id', status_id);

        $.ajax({
            url: '/admin/data_pengajar/update',
            data: formData,
            dataType: 'json',
            enctype: 'multipart/form-data',
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.update').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.update').prop('disabled', true);
            },
            success: function(response) {
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
                if (response.error) {
                    if (response.error.nama_lengkap) {
                        $("#nama_lengkap_edit").addClass('is-invalid');
                        $(".error-nama-edit").html(response.error.nama_lengkap);
                    } else {
                        $("#nama_lengkap_edi").removeClass('is-invalid');
                        $(".error-nama").html('');
                    }
                    if (response.error.nomor_whatsapp) {
                        $("#nomor_whatsapp_edit").addClass('is-invalid');
                        $(".error-nomor-edit").html(response.error.nomor_whatsapp);
                    } else {
                        $("#nomor_whatsapp_edit").removeClass('is-invalid');
                        $(".error-nomor-edit").html('');
                    }
                    if (response.error.email) {
                        $("#email_edit").addClass('is-invalid');
                        $(".error-email-edit").html(response.error.email);
                    } else {
                        $("#email_edit").removeClass('is-invalid');
                        $(".error-email-edit").html('');
                    }
                    if (response.error.usia) {
                        $("#usia_edit").addClass('is-invalid');
                        $(".error-usia-edit").html(response.error.usia);
                    } else {
                        $("#usia_edit").removeClass('is-invalid');
                        $(".error-usia-edit").html('');
                    }
                    if (response.error.alamat_domisili) {
                        $("#alamat_domisili_edit").addClass('is-invalid');
                        $(".error-alamat-edit").html(response.error.alamat_domisili);
                    } else {
                        $("#alamat_domisili_edit").removeClass('is-invalid');
                        $(".error-alamat-edit").html('');
                    }
                    if (response.error.pendidikan_terakhir) {
                        $("#pendidikan_terakhir_edit").addClass('is-invalid');
                        $(".error-pendidikan-edit").html(response.error.pendidikan_terakhir);
                    } else {
                        $("#pendidikan_terakhir_edit").removeClass('is-invalid');
                        $(".error-pendidikan-edit").html('');
                    }
                    if (response.error.jurusan) {
                        $("#jurusan_edit").addClass('is-invalid');
                        $(".error-jurusan-edit").html(response.error.jurusan);
                    } else {
                        $("#jurusan_edit").removeClass('is-invalid');
                        $(".error-jurusan-edit").html('');
                    }
                    if (response.error.status_perkawinan) {
                        $("#status_perkawinan_edit").addClass('is-invalid');
                        $(".error-status-perkawinan-edit").html(response.error.status_perkawinan);
                    } else {
                        $("#status_perkawinan_edit").removeClass('is-invalid');
                        $(".error-status-perkawinan-edit").html('');
                    }
                    if (response.error.username_instagram) {
                        $("#username_instagram_edit").addClass('is-invalid');
                        $(".error-username-edit").html(response.error.username_instagram);
                    } else {
                        $("#username_instagram_edit").removeClass('is-invalid');
                        $(".error-username-edit").html('');
                    }

                    if (response.error.pekerjaan) {
                        $("#pekerjaan_edit").addClass('is-invalid');
                        $(".error-pekerjaan-edit").html(response.error.pekerjaan);
                    } else {
                        $("#pekerjaan_edit").removeClass('is-invalid');
                        $(".error-pekerjaan-edit").html('');
                    }
                    if (response.error.pernyataan) {
                        $("#pernyataan_edit").addClass('is-invalid');
                        $(".error-pernyataan-edit").html(response.error.pernyataan);
                    } else {
                        $("#pernyataan_edit").removeClass('is-invalid');
                        $(".error-pernyataan-edit").html('');
                    }
                    if (response.error.kontrak) {
                        $("#kontrak_edit").addClass('is-invalid');
                        $(".error-kontrak-edit").html(response.error.kontrak);
                    } else {
                        $("#kontrak_edit").removeClass('is-invalid');
                        $(".error-kontrak-edit").html('');
                    }
                    if (response.error.kendaraan_pribadi) {
                        $("#kendaraan_pribadi_edit").addClass('is-invalid');
                        $(".error-kendaraan-pribadi-edit").html(response.error.kendaraan_pribadi);
                    } else {
                        $("#kendaraan_pribadi_edit").removeClass('is-invalid');
                        $(".error-kendaraan-pribadi-edit").html('');
                    }
                    if (response.error.media_belajar) {
                        $("#media_belajar_edit").addClass('is-invalid');
                        $(".error-media-belajar-edit").html(response.error.media_belajar);
                    } else {
                        $("#media_belajar_edit").removeClass('is-invalid');
                        $(".error-media-belajar-edit").html('');
                    }

                    if (response.error.alasan_bergabung) {
                        $("#alasan_bergabung_edit").addClass('is-invalid');
                        $(".error-alasan-bergabung-edit").html(response.error.alasan_bergabung);
                    } else {
                        $("#alasan_bergabung_edit").removeClass('is-invalid');
                        $(".error-alasan-bergabung-edit").html('');
                    }

                    if (response.error.kelebihan) {
                        $("#kelebihan_edit").addClass('is-invalid');
                        $(".error-kelebihan-edit").html(response.error.kelebihan);
                    } else {
                        $("#kelebihan_edit").removeClass('is-invalid');
                        $(".error-kelebihan-edit").html('');
                    }

                    if (response.error.info_loker) {
                        $("#info_loker_edit").addClass('is-invalid');
                        $(".error-info-loker-edit").html(response.error.info_loker);
                    } else {
                        $("#info_loker_edit").removeClass('is-invalid');
                        $(".error-info-loker-edit").html('');
                    }

                    if (response.error.ijazah) {
                        $("#ijazah_edit").addClass('is-invalid');
                        $(".error-ijazah-edit").html(response.error.ijazah);
                    } else {
                        $("#ijazah_edit").removeClass('is-invalid');
                        $(".error-ijazah-edit").html('');
                    }

                    if (response.error.foto) {
                        $("#foto_edit").addClass('is-invalid');
                        $(".error-foto-edit").html(response.error.foto);
                    } else {
                        $("#foto_edit").removeClass('is-invalid');
                        $(".error-foto-edit").html('');
                    }
                    if (response.error.cv) {
                        $("#cv_edit").addClass('is-invalid');
                        $(".error-cv-edit").html(response.error.cv);
                    } else {
                        $("#cv_edit").removeClass('is-invalid');
                        $(".error-cv").html('');
                    }
                    if (response.error.status_id) {
                        $("#status_id_edit").addClass('is-invalid');
                        $(".error-status-edit").html(response.error.status_id);
                    } else {
                        $("#status_id_edit").removeClass('is-invalid');
                        $(".error-status-edit").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: `Data Belum Tersimpan!`,
                });
                $('.update').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                $('.update').prop('disabled', false);
            }
        });
    });
    // End Aksi

    // Aksi Hapus
    $(document).on('click', "#delete", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/data_pengajar/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.pengajar.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/data_pengajar/delete',
            method: 'post',
            dataType: 'JSON',
            data: {
                id: id,
            },
            beforeSend: function() {
                $('.button_delete').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Loading...");
                $('.button_delete').prop('disabled', true);
            },
            success: function(response) {
                $('.button_delete').html('<i class="bi bi-trash"></i> Hapus');
                $('.button_delete').prop('disabled', false);

                $("#deleteModal").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                });
                setTimeout(function() {
                    location.reload();
                }, 1000)
            },
            error: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: `Data Gagal di Hapus!`,
                });
                $('.button_delete').html('<i class="bi bi-trash"></i> Hapus');
                $('.button_delete').prop('disabled', false);

            }
        });
    });
    // End Aksi Hapus
</script>

<?= $this->endSection(); ?>