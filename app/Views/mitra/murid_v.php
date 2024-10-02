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
                            <table class="table table-bordered datatable text-capitalize">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Profil</th>
                                        <th scope="col">Status Murid</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_murid as $data_murid) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?></a></th>
                                            <td><?= $data_murid->nama_lengkap_anak ?></td>

                                            <td>
                                                <a href="/mitra_pengajar/data_murid/view/<?= $data_murid->peserta_didik_id ?>" target="_blank" class="btn btn-sm btn-outline-primary" data-id="<?= $data_murid->peserta_didik_id ?>">
                                                    <i class="bi bi-eye"> Lihat Data</i>
                                                </a>
                                            </td>
                                            <td> <span class='<?= ($data_murid->status_murid_id == 1) ? "badge bg-success" : "badge bg-warning" ?>'><?= $data_murid->status_murid ?></span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $data_murid->peserta_didik_id ?>" type="button">
                                                    <i class="bi bi-pencil-square"></i>
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Form <small>Edit <?= $title ?></small> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <input type="hidden" class="form-control" id="foto_lama" name="foto_lama">
                        <label for="nama_lengkap_anak_edit" class="col-form-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap_anak_edit" name="nama_lengkap_anak">
                        <div class="invalid-feedback error-nama-edit">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir_anak_edit" class="col-form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="tanggal_lahir_anak_edit" name="tanggal_lahir_anak">
                        <div class="invalid-feedback error-tanggal-lahir-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="usia_anak_edit" class="col-form-label">Usia:</label>
                        <input type="text" class="form-control" id="usia_anak_edit" name="usia_anak">
                        <div class="invalid-feedback error-tanggal-lahir-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_domisili_anak_edit" class="col-form-label">Alamat Domisili Anak:</label>
                        <input type="text" class="form-control" id="alamat_domisili_anak_edit" name="alamat_domisili_anak">
                        <div class="invalid-feedback error-alamat-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sekolah_anak_edit" class="col-form-label">Sekolah Anak:</label>
                        <input type="text" class="form-control" id="sekolah_anak_edit" name="sekolah_anak">
                        <div class="invalid-feedback error-sekolah-anak-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_ayah_edit" class="col-form-label">Nama Ayah:</label>
                        <input type="text" class="form-control" id="nama_ayah_edit" name="nama_ayah">
                        <div class="invalid-feedback error-nama-ayah-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ayah_edit" class="col-form-label">Pekerjaan Ayah:</label>
                        <input type="text" class="form-control" id="pekerjaan_ayah_edit" name="pekerjaan_ayah">
                        <div class="invalid-feedback error-pekerjaan-ayah-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_ibu_edit" class="col-form-label">Nama Ibu:</label>
                        <input type="text" class="form-control" id="nama_ibu_edit" name="nama_ibu">
                        <div class="invalid-feedback error-nama-ibu-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ibu_edit" class="col-form-label">Pekerjaan Ibu:</label>
                        <input type="text" class="form-control" id="pekerjaan_ibu_edit" name="pekerjaan_ibu">
                        <div class="invalid-feedback error-pekerjaan-ibu-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomor_whatsapp_wali_edit" class="col-form-label">Nomor Whatsapp Wali:</label>
                        <input type="text" class="form-control" id="nomor_whatsapp_wali_edit" name="nomor_whatsapp_wali">
                        <div class="invalid-feedback error-nomor-wali-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username_instagram_wali_edit" class="col-form-label">Username Instagram:</label>
                        <input type="text" class="form-control" id="username_instagram_wali_edit" name="username_instagram_wali">
                        <div class="invalid-feedback error-username-ig-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="info_les_edit" class="col-form-label">Tahu Alifya dari (Boleh Sebut Nama) :</label>
                        <input type="text" class="form-control" id="info_les_edit" name="info_les">
                        <div class="invalid-feedback error-info-les-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="paket_belajar_id_edit" class="col-form-label">Paket Belajar :</label>
                        <select name="paket_belajar_id" id="paket_belajar_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>

                        </select>
                        <div class="invalid-feedback error-paket-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="program_belajar_id_edit" class="col-form-label">Program Belajar:</label>
                        <select name="program_belajar_id" id="program_belajar_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-program-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="materi_belajar_id_edit" class="col-form-label">Materi Belajar:</label>
                        <select name="materi_belajar_id" id="materi_belajar_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-materi-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hari_belajar_edit" class="col-form-label">Hari Belajar:</label>
                        <input type="text" class="form-control" id="hari_belajar_edit" name="hari_belajar">
                        <div class="invalid-feedback error-hari-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_belajar_edit" class="col-form-label">Waktu Belajar:</label>
                        <input type="text" class="form-control" id="waktu_belajar_edit" name="waktu_belajar">
                        <div class="invalid-feedback error-waktu-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto_anak_edit" class="col-form-label">Foto Anak (kosongkan jika tidak mengganti foto):</label>
                        <input type="file" class="form-control" id="foto_anak_edit" name="foto_anak">
                        <div class="invalid-feedback error-foto-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="brosur_edit" class="col-form-label">Saya Sudah Mengetahui Program dan Biaya Paket Belajar melalui Brosur / Internet :</label>
                        <select name="brosur" id="brosur_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya">ya</option>
                        </select>
                        <div class="invalid-feedback error-brosur-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_murid_id_edit" class="col-form-label">Status Murid:</label>
                        <select name="status_murid_id" id="status_murid_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-status-murid-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="data_edit" class="col-form-label">Saya Sudah Mengisi data diatas dengan benar, jujur, dan dapat dipertanggung jawabkan :</label>
                        <select name="data" id="data_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya">ya</option>
                        </select>
                        <div class="invalid-feedback error-data-edit">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).on('click', "#edit", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/mitra_pengajar/data_murid/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.murid.id);
                $("#foto_lama").val(response.murid.foto_anak);
                $("#nama_lengkap_anak_edit").val(response.murid.nama_lengkap_anak);
                $("#tanggal_lahir_anak_edit").val(response.murid.tanggal_lahir_anak);
                $("#usia_anak_edit").val(response.murid.usia_anak);
                $("#alamat_domisili_anak_edit").val(response.murid.alamat_domisili_anak);
                $("#sekolah_anak_edit").val(response.murid.sekolah_anak);
                $("#nama_ayah_edit").val(response.murid.nama_ayah);
                $("#nama_ibu_edit").val(response.murid.nama_ibu);
                $("#pekerjaan_ayah_edit").val(response.murid.pekerjaan_ayah);
                $("#pekerjaan_ibu_edit").val(response.murid.pekerjaan_ibu);
                $("#nomor_whatsapp_wali_edit").val(response.murid.nomor_whatsapp_wali);
                $("#username_instagram_wali_edit").val(response.murid.username_instagram_wali);
                $("#hari_belajar_edit").val(response.murid.hari_belajar);
                $("#waktu_belajar_edit").val(response.murid.waktu_belajar);
                $("#brosur_edit").val(response.murid.brosur).trigger('change');
                $("#info_les_edit").val(response.murid.info_les);
                $("#data_edit").val(response.murid.data).trigger('change');

                let paket_id = `<option value="">--Silahkan Pilih--</option>`;

                response.paket_belajar.forEach(function(e) {
                    paket_id += `<option value="${e.id}"> ${e.nama_paket} </option>`
                });

                $("#paket_belajar_id_edit").html(paket_id);

                $("#paket_belajar_id_edit").val(response.murid.paket_belajar_id).trigger('change');


                let program_id = `<option value="">--Silahkan Pilih--</option>`;

                response.program_belajar.forEach(function(e) {
                    program_id += `<option value="${e.id}"> ${e.nama_program} </option>`
                });

                $("#program_belajar_id_edit").html(program_id);

                $("#program_belajar_id_edit").val(response.murid.program_belajar_id).trigger('change');

                let materi_id = `<option value="">--Silahkan Pilih--</option>`;

                response.materi_belajar.forEach(function(e) {
                    materi_id += `<option value="${e.id}"> ${e.level} </option>`
                });

                $("#materi_belajar_id_edit").html(materi_id);

                $("#materi_belajar_id_edit").val(response.murid.materi_belajar_id).trigger('change');

                let status = `<option value="">--Silahkan Pilih--</option>`;

                response.status_murid.forEach(function(e) {
                    status += `<option value="${e.id}"> ${e.status_murid} </option>`
                });

                $("#status_murid_id_edit").html(status);

                $("#status_murid_id_edit").val(response.murid.status_murid_id).trigger('change');
            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();

        let id = $("#id_edit").val();
        let foto_lama = $("#foto_lama").val();
        let nama_lengkap_anak = $("#nama_lengkap_anak_edit").val();
        let tanggal_lahir_anak = $("#tanggal_lahir_anak_edit").val();
        let usia_anak = $("#usia_anak_edit").val();
        let alamat_domisili_anak = $("#alamat_domisili_anak_edit").val();
        let sekolah_anak = $("#sekolah_anak_edit").val();
        let nama_ayah = $("#nama_ayah_edit").val();
        let nama_ibu = $("#nama_ibu_edit").val();
        let pekerjaan_ayah = $("#pekerjaan_ayah_edit").val();
        let pekerjaan_ibu = $("#pekerjaan_ibu_edit").val();
        let nomor_whatsapp_wali = $("#nomor_whatsapp_wali_edit").val();
        let username_instagram_wali = $("#username_instagram_wali_edit").val();
        let info_les = $("#info_les_edit").val();
        let paket_belajar_id = $("#paket_belajar_id_edit").val();
        let program_belajar_id = $("#program_belajar_id_edit").val();
        let materi_belajar_id = $("#materi_belajar_id_edit").val();
        let hari_belajar = $("#hari_belajar_edit").val();
        let waktu_belajar = $("#waktu_belajar_edit").val();
        let foto_anak = $("#foto_anak_edit").val();
        let status_murid_id = $("#status_murid_id_edit").val();
        let brosur = $("#brosur_edit").val();
        let data = $("#data_edit").val();


        let formData = new FormData(this);

        formData.append('id', id);
        formData.append('foto_lama', foto_lama);
        formData.append('nama_lengkap_anak', nama_lengkap_anak);
        formData.append('tanggal_lahir_anak', tanggal_lahir_anak);
        formData.append('usia_anak', usia_anak);
        formData.append('alamat_domisili_anak', alamat_domisili_anak);
        formData.append('sekolah_anak', sekolah_anak);
        formData.append('nama_ayah', nama_ayah);
        formData.append('nama_ibu', nama_ibu);
        formData.append('pekerjaan_ayah', pekerjaan_ayah);
        formData.append('pekerjaan_ibu', pekerjaan_ibu);
        formData.append('nomor_whatsapp_wali', nomor_whatsapp_wali);
        formData.append('username_instagram_wali', username_instagram_wali);
        formData.append('info_les', info_les);
        formData.append('paket_belajar_id', paket_belajar_id);
        formData.append('program_belajar_id', program_belajar_id);
        formData.append('materi_belajar_id', materi_belajar_id);
        formData.append('hari_belajar', hari_belajar);
        formData.append('waktu_belajar', waktu_belajar);
        formData.append('foto_anak', foto_anak);
        formData.append('status_murid_id', status_murid_id);
        formData.append('brosur', brosur);
        formData.append('data', data);

        $.ajax({
            url: '/mitra_pengajar/data_murid/update',
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
                    if (response.error.nama_lengkap_anak) {
                        $("#nama_lengkap_anak_edit").addClass('is-invalid');
                        $(".error-nama-edit").html(response.error.nama_lengkap_anak);
                    } else {
                        $("#nama_lengkap_anak_edit").removeClass('is-invalid');
                        $(".error-nama-edit").html('');
                    }
                    if (response.error.tanggal_lahir_anak) {
                        $("#tanggal_lahir_anak_edit").addClass('is-invalid');
                        $(".error-tanggal-lahir-edit").html(response.error.tanggal_lahir_anak);
                    } else {
                        $("#tanggal_lahir_anak_edit").removeClass('is-invalid');
                        $(".error-tanggal-lahir-edit").html('');
                    }
                    if (response.error.usia_anak) {
                        $("#usia_anak_edit").addClass('is-invalid');
                        $(".error-usia_anak-edit").html(response.error.usia_anak);
                    } else {
                        $("#usia_anak_edit").removeClass('is-invalid');
                        $(".error-usia_anak-edit").html('');
                    }
                    if (response.error.alamat_domisili_anak) {
                        $("#alamat_domisili_anak_edit").addClass('is-invalid');
                        $(".error-alamat-edit").html(response.error.alamat_domisili_anak);
                    } else {
                        $("#alamat_domisili_anak").removeClass('is-invalid');
                        $(".error-alamat-edit").html('');
                    }
                    if (response.error.sekolah_anak) {
                        $("#sekolah_anak_edit").addClass('is-invalid');
                        $(".error-sekolah-anak-edit").html(response.error.sekolah_anak);
                    } else {
                        $("#sekolah_anak_edit").removeClass('is-invalid');
                        $(".error-sekolah-anak-edit").html('');
                    }
                    if (response.error.nomor_whatsapp_wali) {
                        $("#nomor_whatsapp_wali_edit").addClass('is-invalid');
                        $(".error-nomor-wali-edit").html(response.error.nomor_whatsapp_wali);
                    } else {
                        $("#nomor_whatsapp_wali_edit").removeClass('is-invalid');
                        $(".error-nomor-wali-edit").html('');
                    }
                    if (response.error.info_les) {
                        $("#info_les_edit").addClass('is-invalid');
                        $(".error-info-les-edit").html(response.error.info_les);
                    } else {
                        $("#info_les_edit").removeClass('is-invalid');
                        $(".error-info-les-edit").html('');
                    }
                    if (response.error.paket_belajar_id) {
                        $("#paket_belajar_id_edit").addClass('is-invalid');
                        $(".error-paket-belajar-edit").html(response.error.paket_belajar_id);
                    } else {
                        $("#paket_belajar_id_edit").removeClass('is-invalid');
                        $(".error-paket-belajar-edit").html('');
                    }

                    if (response.error.username_instagram_wali) {
                        $("#username_instagram_wali_edit").addClass('is-invalid');
                        $(".error-username-ig-wali-edit").html(response.error.username_instagram_wali);
                    } else {
                        $("#username_instagram_wali_edit").removeClass('is-invalid');
                        $(".error-username-ig-wali-edit").html('');
                    }

                    if (response.error.program_belajar_id) {
                        $("#program_belajar_id_edit").addClass('is-invalid');
                        $(".error-program-belajar-edit").html(response.error.program_belajar_id);
                    } else {
                        $("#program_belajar_id_edit").removeClass('is-invalid');
                        $(".error-program-belajar-edit").html('');
                    }
                    if (response.error.materi_belajar_id) {
                        $("#materi_belajar_id_edit").addClass('is-invalid');
                        $(".error-materi-belajar-edit").html(response.error.materi_belajar_id);
                    } else {
                        $("#materi_belajar_id_edit").removeClass('is-invalid');
                        $(".error-materi-belajar-edit").html('');
                    }
                    if (response.error.materi_belajar_id) {
                        $("#materi_belajar_id_edit").addClass('is-invalid');
                        $(".error-materi-belajar-edit").html(response.error.materi_belajar_id);
                    } else {
                        $("#materi_belajar_id_edit").removeClass('is-invalid');
                        $(".error-materi-belajar-edit").html('');
                    }
                    if (response.error.hari_belajar) {
                        $("#hari_belajar_edit").addClass('is-invalid');
                        $(".error-hari-belajar-edit").html(response.error.hari_belajar);
                    } else {
                        $("#hari_belajar_edit").removeClass('is-invalid');
                        $(".error-hari-belajar-edit").html('');
                    }
                    if (response.error.waktu_belajar) {
                        $("#waktu_belajar_edit").addClass('is-invalid');
                        $(".error-waktu-edit").html(response.error.waktu_belajar);
                    } else {
                        $("#waktu_belajar_edit").removeClass('is-invalid');
                        $(".error-waktu-edit").html('');
                    }
                    if (response.error.foto_anak) {
                        $("#foto_anak_edit").addClass('is-invalid');
                        $(".error-foto-anak-edit").html(response.error.foto_anak);
                    } else {
                        $("#foto_anak_edit").removeClass('is-invalid');
                        $(".error-foto-anak-edit").html('');
                    }
                    if (response.error.status_murid_id) {
                        $("#status_murid_id_edit").addClass('is-invalid');
                        $(".error-status-murid-edit").html(response.error.status_murid_id);
                    } else {
                        $("#status_murid_id_edit").removeClass('is-invalid');
                        $(".error-status-murid-edit").html('');
                    }
                    if (response.error.brosur) {
                        $("#brosur_edit").addClass('is-invalid');
                        $(".error-brosur-edit").html(response.error.brosur);
                    } else {
                        $("#brosur_edit").removeClass('is-invalid');
                        $(".error-brosur-edit").html('');
                    }
                    if (response.error.data) {
                        $("#data_edit").addClass('is-invalid');
                        $(".error-data-edit").html(response.error.data);
                    } else {
                        $("#data_edit").removeClass('is-invalid');
                        $(".error-data-edit").html('');
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
    })
</script>

<?= $this->endSection(); ?>