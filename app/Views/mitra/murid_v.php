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
                                            <td> <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $data_murid->peserta_didik_id ?>" type="button">
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
                        <label for="ketersediaan_edit" class="col-form-label">Apakah Mom/Pap bersedia untuk Ananda ikut berproses bersama Alifya? : </label>
                        <select name="ketersediaan" id="ketersediaan_edit" class="form-select" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya, bersedia">Ya, Bersedia</option>
                            <option value="tidak bersedia">Tidak Bersedia</option>
                        </select>
                        <div class="invalid-feedback error-ketersediaan-edit">
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
                        <label for="agama_edit" class="col-form-label">Agama:</label>
                        <input type="text" class="form-control" id="agama_edit" name="agama">
                        <div class="invalid-feedback error-agama-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username_instagram_wali_edit" class="col-form-label">Username Instagram:</label>
                        <input type="text" class="form-control" id="username_instagram_wali_edit" name="username_instagram_wali">
                        <div class="invalid-feedback error-username-ig-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomor_whatsapp_wali_edit" class="col-form-label">Nomor Whatsapp Wali:</label>
                        <input type="text" class="form-control" id="nomor_whatsapp_wali_edit" name="nomor_whatsapp_wali">
                        <div class="invalid-feedback error-nomor-wali-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_domisili_anak_edit" class="col-form-label">Alamat Domisili Lengkap:</label>
                        <textarea name="alamat_domisili_anak" id="alamat_domisili_anak_edit" class="form-control"></textarea>
                        <div class="invalid-feedback error-alamat-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="id_edit" name="id">
                        <input type="text" class="form-control" id="foto_lama" name="foto_lama">
                        <input type="text" class="form-control" id="bukti_tf_lama" name="bukti_tf_lama">

                        <label for="nama_lengkap_anak_edit" class="col-form-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap_anak_edit" name="nama_lengkap_anak">
                        <div class="invalid-feedback error-nama-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_panggilan_anak_edit" class="col-form-label">Nama Panggilan Anak :</label>
                        <input type="text" class="form-control" id="nama_panggilan_anak_edit" name="nama_panggilan_anak" require>
                        <div class="invalid-feedback error-nama-panggilan-edit">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir_anak_edit" class="col-form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="tanggal_lahir_anak_edit" name="tanggal_lahir_anak">
                        <div class="invalid-feedback error-tanggal-lahir-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin_edit" class="col-form-label">Jenis Kelamin :</label>
                        <select name="jenis_kelamin" id="jenis_kelamin_edit" class="form-control" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="p">Perempuan</option>
                            <option value="l">Laki-laki</option>
                        </select>
                        <div class="invalid-feedback error-jenis-kelamin-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_id_edit_edit" class="col-form-label">Tingkat pendidikan formal saat ini :</label>
                        <select name="pendidikan_id" id="pendidikan_id_edit" class="form-control" require>
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback error-pendidikan-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sekolah_anak_edit" class="col-form-label">Nama Sekolah :</label>
                        <input type="text" class="form-control" id="sekolah_anak_edit" name="sekolah_anak">
                        <div class="invalid-feedback error-sekolah-anak-edit">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="ukuran_baju">Ukuran Baju Anak :</label>
                        <br>
                        <table class="table" style="border-collapse: collapse; text-align:center">
                            <tr>
                                <td style="padding: 10px;">Siza Chart(cm)</td>
                                <td style="padding: 10px;">S</td>
                                <td style="padding: 10px;">M</td>
                                <td style="padding: 10px;">L</td>
                                <td style="padding: 10px;">XL</td>
                                <td style="padding: 10px;">XXL</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Lebar Dada</td>
                                <td style="padding: 10px;">31</td>
                                <td style="padding: 10px;">34,5</td>
                                <td style="padding: 10px;">37</td>
                                <td style="padding: 10px;">39,5</td>
                                <td style="padding: 10px;">45</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Panjang Badan</td>
                                <td style="padding: 10px;">43</td>
                                <td style="padding: 10px;">45,5</td>
                                <td style="padding: 10px;">50,5</td>
                                <td style="padding: 10px;">53</td>
                                <td style="padding: 10px;">56</td>
                            </tr>
                        </table>
                        <br>
                        <select name="ukuran_baju" id="ukuran_baju_edit" class="form-control" require>
                            <option value="">Silahkan Pilih</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                        </select>

                        <div class="invalid-feedback error-ukuran-baju-edit">
                        </div>
                    </div>

                    <br>

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

                    <div class="mb-3">
                        <label for="paket_belajar_id_edit" class="col-form-label">Paket Belajar :</label>
                        <select name="paket_belajar_id" id="paket_belajar_id_edit" class="form-select">
                            <option value="">--Silahkan Pilih-- </option>

                        </select>
                        <div class="invalid-feedback error-paket-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hari_belajar_edit" class="col-form-label">Ajuan Opsi Hari Les :</label>
                        <input type="text" class="form-control" id="hari_belajar_edit" name="hari_belajar">
                        <div class="invalid-feedback error-hari-belajar-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_belajar_edit" class="col-form-label">Ajuan Opsi Waktu Les :</label>
                        <input type="text" class="form-control" id="waktu_belajar_edit" name="waktu_belajar">
                        <div class="invalid-feedback error-waktu-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_edit" class="col-form-label">Notes untuk calon pengajar :</label>
                        <input type="text" class="form-control" id="catatan_edit" name="catatan" require>
                        <div class="invalid-feedback error-catatan-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto_anak_edit" class="col-form-label">Foto Anak:</label>
                        <input type="file" class="form-control" id="foto_anak_edit" name="foto_anak">
                        <div class="invalid-feedback error-foto-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bukti_tf_edit" class="col-form-label">Bukti TF:</label>
                        <input type="file" class="form-control" id="bukti_tf_edit" name="bukti_tf">
                        <div class="invalid-feedback error-bukti-tf-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="izin_dokumentasi_edit" class="col-form-label">Apakah Mom/Pap berkenan jika dokumentasi kegiatan belajar Ananda (foto/video) digunakan untuk kebutuhan media sosial Alifya Learning?: </label>
                        <select name="izin_dokumentasi" id="izin_dokumentasi_edit" class="form-select" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya, bersedia">Ya Bersedia</option>
                            <option value="Tidak Bersedia">Tidak Bersedia</option>
                        </select>
                        <div class="invalid-feedback error-izin-dokumentasi-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tata_tertib_edit" class="col-form-label">Tata Tertib : </label>
                        <select name="tata_tertib" id="tata_tertib_edit" class="form-select" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya sudah membaca dan menyetujui tata tertib">saya sudah membaca dan menyetujui tata tertib</option>
                        </select>
                        <div class="invalid-feedback error-tata-tertib-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tindak_lanjut_edit" class="col-form-label">Tindak Lanjut Kegiatan : </label>
                        <select name="tindak_lanjut" id="tindak_lanjut_edit" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya sudah membaca dan menyetujui tindak lanjut kegiatan">Saya sudah membaca dan menyetujui Tindak Lanjut Kegiatan</option>
                        </select>
                        <div class="invalid-feedback error-tindak-lanjut-edit">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="larangan_edit" class="col-form-label">Prohibition/Larangan : </label>
                        <select name="larangan" id="larangan_edit" class="form-select" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya sudah membaca dan menyetujui prohibition/larangan">saya sudah membaca dan menyetujui prohibition/larangan</option>
                        </select>
                        <div class="invalid-feedback error-tindak-lanjut-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="info_les_edit" class="col-form-label">Dari mana Mom/Pap mengetahui Alifya Learning?:</label>
                        <input type="text" class="form-control" id="info_les_edit" name="info_les" require>
                        <div class="invalid-feedback error-info-les-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="data_1_edit" class="col-form-label">Saya Menyatakan Bahwa :</label>
                        <select name="data_1" id="data_1_edit" class="form-control" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan">saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan</option>
                        </select>
                        <div class="invalid-feedback error-data-1-edit">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="data_2_edit" class="col-form-label">Saya Menyatakan Bahwa :</label>
                        <select name="data_2" id="data_2_edit" class="form-control" require>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya memahami dan menyetujui proses belajar di alifya">saya memahami dan menyetujui proses belajar di alifya</option>
                        </select>
                        <div class="invalid-feedback error-data-2-edit">
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

                $("#hari_belajar_edit").val(response.murid.hari_belajar);
                $("#waktu_belajar_edit").val(response.murid.waktu_belajar);

                $("#catatan_edit").val(response.murid.catatan);
                $("#izin_dokumentasi_edit").val(response.murid.izin_dokumentasi).trigger('change');
                $("#tata_tertib_edit").val(response.murid.tata_tertib).trigger('change');
                $("#tindak_lanjut_edit").val(response.murid.tindak_lanjut).trigger('change');

                $("#larangan_edit").val(response.murid.larangan).trigger('change');
                $("#info_les_edit").val(response.murid.info_les);

                $("#data_1_edit").val(response.murid.data_1).trigger('change');
                $("#data_2_edit").val(response.murid.data_2).trigger('change');

                $("#id_edit").val(response.murid.id);
                $("#foto_lama").val(response.murid.foto_anak);
                $("#bukti_tf_lama").val(response.murid.bukti_tf);

                $("#ketersediaan_edit").val(response.murid.ketersediaan).trigger('change');

                $("#nama_ayah_edit").val(response.murid.nama_ayah);
                $("#pekerjaan_ayah_edit").val(response.murid.pekerjaan_ayah);
                $("#nama_ibu_edit").val(response.murid.nama_ibu);
                $("#pekerjaan_ibu_edit").val(response.murid.pekerjaan_ibu);
                $("#agama_edit").val(response.murid.agama);
                $("#username_instagram_wali_edit").val(response.murid.username_instagram_wali);
                $("#nomor_whatsapp_wali_edit").val(response.murid.nomor_whatsapp_wali);
                $("#alamat_domisili_anak_edit").val(response.murid.alamat_domisili_anak);

                $("#nama_lengkap_anak_edit").val(response.murid.nama_lengkap_anak);
                $("#nama_panggilan_anak_edit").val(response.murid.nama_panggilan_anak);
                $("#tanggal_lahir_anak_edit").val(response.murid.tanggal_lahir_anak);
                $("#jenis_kelamin_edit").val(response.murid.jenis_kelamin).trigger('change');

                let paket_id = `<option value="">--Silahkan Pilih--</option>`;

                response.paket_belajar.forEach(function(e) {
                    paket_id += `<option value="${e.id}"> ${e.nama_paket} </option>`
                });

                $("#paket_belajar_id_edit").html(paket_id);

                $("#paket_belajar_id_edit").val(response.murid.paket_belajar_id).trigger('change');

                let status = `<option value="">--Silahkan Pilih--</option>`;

                // pendidikan
                let pendidikan = `<option value="">--Silahkan Pilih--</option>`;

                response.pendidikan.forEach(function(e) {
                    pendidikan += `<option value="${e.id}"> ${e.pendidikan} </option>`
                });

                $("#pendidikan_id_edit").html(pendidikan);
                $("#pendidikan_id_edit").val(response.murid.pendidikan_id).trigger('change');

                $("#sekolah_anak_edit").val(response.murid.sekolah_anak);
                $("#ukuran_baju_edit").val(response.murid.ukuran_baju);

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

            }
        });
    });

    $("#edit_form").submit(function(e) {
        e.preventDefault();

        let id = $("#id_edit").val();
        let foto_lama = $("#foto_lama").val();
        let bukti_tf_lama = $("#bukti_tf_lama").val();

        let nama_ayah = $("#nama_ayah_edit").val();
        let nama_ibu = $("#nama_ibu_edit").val();
        let pekerjaan_ayah = $("#pekerjaan_ayah_edit").val();
        let pekerjaan_ibu = $("#pekerjaan_ibu_edit").val();
        let agama = $("#agama_edit").val();
        let username_instagram_wali = $("#username_instagram_wali_edit").val();
        let nomor_whatsapp_wali = $("#nomor_whatsapp_wali_edit").val();
        let alamat_domisili_anak = $("#alamat_domisili_anak_edit").val();

        let nama_lengkap_anak = $("#nama_lengkap_anak_edit").val();
        let nama_panggilan_anak = $("#nama_panggilan_anak_edit").val();
        let tanggal_lahir_anak = $("#tanggal_lahir_anak_edit").val();
        let sekolah_anak = $("#sekolah_anak_edit").val();
        let jenis_kelamin = $("#jenis_kelamin_edit").val();
        let pendidikan_id = $("#pendidikan_id_edit").val();
        let ukuran_baju = $("#ukuran_baju_edit").val();

        let program_belajar_id = $("#program_belajar_id_edit").val();
        let materi_belajar_id = $("#materi_belajar_id_edit").val();
        let paket_belajar_id = $("#paket_belajar_id_edit").val();
        let hari_belajar = $("#hari_belajar_edit").val();
        let waktu_belajar = $("#waktu_belajar_edit").val();
        let catatan = $("#catatan_edit").val();

        let foto_anak = $("#foto_anak_edit").val();
        let bukti_tf = $("#bukti_tf_edit").val();

        let izin_dokumentasi = $("#izin_dokumentasi_edit").val();
        let tata_tertib = $("#tata_tertib_edit").val();
        let tindak_lanjut = $("#tindak_lanjut_edit").val();
        let larangan = $("#larangan_edit").val();
        let info_les = $("#info_les_edit").val();
        let ketersediaan = $("#ketersediaan_edit").val();


        let data_1 = $("#data_1_edit").val();
        let data_2 = $("#data_2_edit").val();


        let formData = new FormData(this);

        formData.append('id', id);
        formData.append('foto_lama', foto_lama);
        formData.append('bukti_tf_lama', bukti_tf_lama);

        formData.append('nama_ayah', nama_ayah);
        formData.append('nama_ibu', nama_ibu);
        formData.append('pekerjaan_ayah', pekerjaan_ayah);
        formData.append('pekerjaan_ibu', pekerjaan_ibu);
        formData.append('agama', agama);
        formData.append('nomor_whatsapp_wali', nomor_whatsapp_wali);
        formData.append('username_instagram_wali', username_instagram_wali);
        formData.append('alamat_domisili_anak', alamat_domisili_anak);

        formData.append('nama_lengkap_anak', nama_lengkap_anak);
        formData.append('nama_panggilan_anak', nama_panggilan_anak);
        formData.append('tanggal_lahir_anak', tanggal_lahir_anak);
        formData.append('sekolah_anak', sekolah_anak);
        formData.append('jenis_kelamin', jenis_kelamin);
        formData.append('pendidikan_id', pendidikan_id);
        formData.append('ukuran_baju', ukuran_baju);

        formData.append('program_belajar_id', program_belajar_id);
        formData.append('materi_belajar_id', materi_belajar_id);
        formData.append('paket_belajar_id', paket_belajar_id);
        formData.append('hari_belajar', hari_belajar);
        formData.append('waktu_belajar', waktu_belajar);
        formData.append('catatan', catatan);

        formData.append('foto_anak', foto_anak);
        formData.append('bukti_tf', bukti_tf);

        formData.append('izin_dokumentasi', izin_dokumentasi);
        formData.append('tata_tertib', tata_tertib);
        formData.append('tindak_lanjut', tindak_lanjut);
        formData.append('larangan', larangan);
        formData.append('info_les', info_les);
        formData.append('ketersediaan', ketersediaan);

        formData.append('data_1', data_1);
        formData.append('data_2', data_2);

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

                    if (response.error.ketersediaan) {
                        $("#ketersediaan_edit").addClass('is-invalid');
                        $(".error-ketersediaan-edit").html(response.error.ketersediaan);
                    } else {
                        $("#ketersediaan_edit").removeClass('is-invalid');
                        $(".error-ketersediaan-edit").html('');
                    }

                    if (response.error.nama_ayah) {
                        $("#nama_ayah_edit").addClass('is-invalid');
                        $(".error-nama-ayah-edit").html(response.error.nama_ayah);
                    } else {
                        $("#nama_ayah_edit").removeClass('is-invalid');
                        $(".error-nama-ayah-edit").html('');
                    }

                    if (response.error.pekerjaan_ayah) {
                        $("#pekerjaan_ayah_edit").addClass('is-invalid');
                        $(".error-pekerjaan-ayah-edit").html(response.error.pekerjaan_ayah);
                    } else {
                        $("#pekerjaan_ayah_edit").removeClass('is-invalid');
                        $(".error-pekerjaan-ayah-edit").html('');
                    }

                    if (response.error.nama_ibu) {
                        $("#nama_ibu_edit").addClass('is-invalid');
                        $(".error-nama-ibu-edit").html(response.error.nama_ibu);
                    } else {
                        $("#nama_ibu_edit").removeClass('is-invalid');
                        $(".error-nama-ibu-edit").html('');
                    }

                    if (response.error.pekerjaan_ibu) {
                        $("#pekerjaan_ibu_edit").addClass('is-invalid');
                        $(".error-pekerjaan-ibu-edit").html(response.error.pekerjaan_ibu);
                    } else {
                        $("#pekerjaan_ibu_edit").removeClass('is-invalid');
                        $(".error-pekerjaan-ibu-edit").html('');
                    }

                    if (response.error.agama) {
                        $("#agama_edit").addClass('is-invalid');
                        $(".error-agama-edit").html(response.error.agama);
                    } else {
                        $("#agama_edit").removeClass('is-invalid');
                        $(".error-agama-edit").html('');
                    }

                    if (response.error.username_instagram_wali) {
                        $("#username_instagram_wali_edit").addClass('is-invalid');
                        $(".error-username-ig-wali-edit").html(response.error.username_instagram_wali);
                    } else {
                        $("#username_instagram_wali_edit").removeClass('is-invalid');
                        $(".error-username-ig-wali-edit").html('');
                    }

                    if (response.error.nomor_whatsapp_wali) {
                        $("#nomor_whatsapp_wali_edit").addClass('is-invalid');
                        $(".error-nomor-wali-edit").html(response.error.nomor_whatsapp_wali);
                    } else {
                        $("#nomor_whatsapp_wali_edit").removeClass('is-invalid');
                        $(".error-nomor-wali-edit").html('');
                    }

                    if (response.error.alamat_domisili_anak) {
                        $("#alamat_domisili_anak_edit").addClass('is-invalid');
                        $(".error-alamat-edit").html(response.error.alamat_domisili_anak);
                    } else {
                        $("#alamat_domisili_anak").removeClass('is-invalid');
                        $(".error-alamat-edit").html('');
                    }

                    if (response.error.nama_lengkap_anak) {
                        $("#nama_lengkap_anak_edit").addClass('is-invalid');
                        $(".error-nama-edit").html(response.error.nama_lengkap_anak);
                    } else {
                        $("#nama_lengkap_anak_edit").removeClass('is-invalid');
                        $(".error-nama-edit").html('');
                    }

                    if (response.error.nama_panggilan_anak) {
                        $("#nama_panggilan_anak_edit").addClass('is-invalid');
                        $(".error-nama-panggilan-edit").html(response.error.nama_panggilan_anak);
                    } else {
                        $("#nama_panggilan_anak_edit").removeClass('is-invalid');
                        $(".error-nama-panggilan-edit").html('');
                    }

                    if (response.error.tanggal_lahir_anak) {
                        $("#tanggal_lahir_anak_edit").addClass('is-invalid');
                        $(".error-tanggal-lahir-edit").html(response.error.tanggal_lahir_anak);
                    } else {
                        $("#tanggal_lahir_anak_edit").removeClass('is-invalid');
                        $(".error-tanggal-lahir-edit").html('');
                    }

                    if (response.error.jenis_kelamin) {
                        $("#jenis_kelamin_edit").addClass('is-invalid');
                        $(".error-jenis-kelamin-edit").html(response.error.jenis_kelamin);
                    } else {
                        $("#jenis_kelamin_edit").removeClass('is-invalid');
                        $(".error-jenis-kelamin-edit").html('');
                    }

                    if (response.error.pendidikan_id) {
                        $("#pendidikan_id_edit").addClass('is-invalid');
                        $(".error-pendidikan-edit").html(response.error.pendidikan_id);
                    } else {
                        $("#pendidikan_id_edit").removeClass('is-invalid');
                        $(".error-pendidikan-edit").html('');
                    }

                    if (response.error.sekolah_anak) {
                        $("#sekolah_anak_edit").addClass('is-invalid');
                        $(".error-sekolah-anak-edit").html(response.error.sekolah_anak);
                    } else {
                        $("#sekolah_anak_edit").removeClass('is-invalid');
                        $(".error-sekolah-anak-edit").html('');
                    }

                    if (response.error.ukuran_baju) {
                        $("#ukuran_baju_edit").addClass('is-invalid');
                        $(".error-ukuran-baju-edit").html(response.error.ukuran_baju);
                    } else {
                        $("#ukuran_baju_edit").removeClass('is-invalid');
                        $(".error-ukuran-baju-edit").html('');
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

                    if (response.error.paket_belajar_id) {
                        $("#paket_belajar_id_edit").addClass('is-invalid');
                        $(".error-paket-belajar-edit").html(response.error.paket_belajar_id);
                    } else {
                        $("#paket_belajar_id_edit").removeClass('is-invalid');
                        $(".error-paket-belajar-edit").html('');
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

                    if (response.error.catatan) {
                        $("#catatan_edit").addClass('is-invalid');
                        $(".error-catatan-edit").html(response.error.catatan);
                    } else {
                        $("#catatan_edit").removeClass('is-invalid');
                        $(".error-catatan-edit").html('');
                    }

                    if (response.error.izin_dokumentasi) {
                        $("#izin_dokumentasi_edit").addClass('is-invalid');
                        $(".error-izin-dokumentasi-edit").html(response.error.izin_dokumentasi);
                    } else {
                        $("#izin_dokumentasi_edit").removeClass('is-invalid');
                        $(".error-izin-dokumentasi-edit").html('');
                    }

                    if (response.error.tata_tertib) {
                        $("#tata_tertib_edit").addClass('is-invalid');
                        $(".error-tata-tertib-edit").html(response.error.tata_tertib);
                    } else {
                        $("#tata_tertib_edit").removeClass('is-invalid');
                        $(".error-tata-tertib-edit").html('');
                    }

                    if (response.error.tindak_lanjut) {
                        $("#tindak_lanjut_edit").addClass('is-invalid');
                        $(".error-tindak-lanjut-edit").html(response.error.tindak_lanjut);
                    } else {
                        $("#tindak_lanjut_edit").removeClass('is-invalid');
                        $(".error-tindak-lanjut-edit").html('');
                    }

                    if (response.error.larangan) {
                        $("#larangan_edit").addClass('is-invalid');
                        $(".error-larangan-edit").html(response.error.larangan);
                    } else {
                        $("#larangan_edit").removeClass('is-invalid');
                        $(".error-larangan-edit").html('');
                    }

                    if (response.error.info_les) {
                        $("#info_les_edit").addClass('is-invalid');
                        $(".error-info-les-edit").html(response.error.info_les);
                    } else {
                        $("#info_les_edit").removeClass('is-invalid');
                        $(".error-info-les-edit").html('');
                    }

                    if (response.error.data_1) {
                        $("#data_1_edit").addClass('is-invalid');
                        $(".error-data-1-edit").html(response.error.data_1);
                    } else {
                        $("#data_1_edit").removeClass('is-invalid');
                        $(".error-data-1-edit").html('');
                    }

                    if (response.error.data_2) {
                        $("#data_2_edit").addClass('is-invalid');
                        $(".error-data-2-edit").html(response.error.data_2);
                    } else {
                        $("#data_2_edit").removeClass('is-invalid');
                        $(".error-data-2-edit").html('');
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