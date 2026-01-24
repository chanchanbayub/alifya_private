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

                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered" id="data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Profil Peserta</th>
                                        <th scope="col">Status Peserta</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- EndForeach -->
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">

                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="mitra_id" class="col-form-label">Silahkan Pilih :</label>
                        <select name="mitra_id" id="mitra_id" class="form-control">
                            <option value="">Silahkan Pilih</option>

                        </select>
                        <div class="invalid-feedback error-pengajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_layanan_id" class="col-form-label">Silahkan Pilih :</label>
                        <select name="jenis_layanan_id" id="jenis_layanan_id" class="form-control">
                            <option value="">Silahkan Pilih</option>

                        </select>
                        <div class="invalid-feedback error-layanan">
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
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
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
                        <input type="hidden" class="form-control" id="foto_anak_lama" name="foto_anak_lama">
                        <input type="hidden" class="form-control" id="bukti_tf_lama" name="bukti_tf_lama">
                        <label for="ketersediaan" class="col-form-label">Apakah Mom/Pap bersedia untuk Ananda ikut berproses bersama Alifya? :</label>
                        <select name="ketersediaan" id="ketersediaan" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya, bersedia">Ya, Bersedia</option>
                            <option value="tidak bersedia">Tidak Bersedia</option>
                        </select>
                        <div class="invalid-feedback error-ketersediaan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_ayah" class="col-form-label">Nama Ayah : </label>
                        <input type="text" name="nama_ayah" id="nama_ayah" class="form-control">
                        <div class="invalid-feedback error-nama-ayah">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan_ayah" class="col-form-label">Pekerjaan Ayah : </label>
                        <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control">
                        <div class="invalid-feedback error-pekerjaan-ayah">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_ibu" class="col-form-label">Nama ibu : </label>
                        <input type="text" name="nama_ibu" id="nama_ibu" class="form-control">
                        <div class="invalid-feedback error-nama-ibu">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan_ibu" class="col-form-label">Pekerjaan ibu : </label>
                        <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control">
                        <div class="invalid-feedback error-pekerjaan-ibu">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="usersname_instagram" class="col-form-label">Usersname Instagram : </label>
                        <input type="text" name="usersname_instagram" id="usersname_instagram" class="form-control">
                        <div class="invalid-feedback error-usersname-instagram">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_whatsapp_orang_tua" class="col-form-label">Nomor Whatssapp Orang Tua : </label>
                        <input type="text" name="nomor_whatsapp_orang_tua" id="nomor_whatsapp_orang_tua" class="form-control">
                        <div class="invalid-feedback error-nomor-wa">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_domisili_anak">Alamat Domisili Lengkap :</label>
                        <textarea name="alamat_domisili_anak" id="alamat_domisili_anak" class="form-control"></textarea>
                        <p class="invalid-feedback  error-alamat-domisili-anak"></p>
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap_anak">Nama Lengkap Anak :</label>
                        <input type="text" class="form-control" id="nama_lengkap_anak" name="nama_lengkap_anak">
                        <div class="invalid-feedback error-nama-lengkap-anak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_panggilan_anak">Nama Panggilan Anak :</label>
                        <input type="text" class="form-control" id="nama_panggilan_anak" name="nama_panggilan_anak">
                        <div class="invalid-feedback error-nama-panggilan-anak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir_anak">Tanggal Lahir Anak :</label>
                        <input type="date" class="form-control" id="tanggal_lahir_anak" name="tanggal_lahir_anak" />
                        <div class="invalid-feedback error-tanggal-lahir-anak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin :</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                            <option value="">Silahkan Pilih</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                        <div class="invalid-feedback error-jenis-kelamin">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pendidikan_id">Tingkat pendidikan formal saat ini :</label>
                        <select name="pendidikan_id" id="pendidikan_id" class="form-select">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($pendidikan as $pendidikan) : ?>
                                <option value="<?= $pendidikan->id ?>"><?= $pendidikan->pendidikan ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback error-pendidikan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sekolah_anak">Nama Sekolah :</label>
                        <input type="text" class="form-control" id="sekolah_anak" name="sekolah_anak" placeholder="SDN ...." />
                        <div class="invalid-feedback error-sekolah-anak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ukuran_baju">Ukuran Baju Anak :</label>
                        <table style="border-collapse: collapse; text-align:center" class="table table-bordered">
                            <tr>
                                <td style="padding: 10px;">Siza Chart(cm)</td>
                                <td style="padding: 10px;">S</td>
                                <td style="padding: 10px;">M</td>
                                <td style="padding: 10px;">L</td>
                                <td style="padding: 10px;">XL</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Lebar Dada</td>
                                <td style="padding: 10px;">31</td>
                                <td style="padding: 10px;">34,5</td>
                                <td style="padding: 10px;">37</td>
                                <td style="padding: 10px;">39,5</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Panjang Badan</td>
                                <td style="padding: 10px;">43</td>
                                <td style="padding: 10px;">45,5</td>
                                <td style="padding: 10px;">50,5</td>
                                <td style="padding: 10px;">53</td>
                            </tr>
                        </table>
                        <select name="ukuran_baju" id="ukuran_baju" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                        </select>
                        <div class="invalid-feedback error-ukuran-baju">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="program_belajar_ahl_id">Program Belajar :</label>
                        <select name="program_belajar_ahl_id" id="program_belajar_ahl_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($program_ahl as $program_ahl) : ?>
                                <option value="<?= $program_ahl->id ?>"><?= $program_ahl->nama_program ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-program-belajar">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_pertemuan_id">Jumlah Pertemuan :</label>
                        <select name="jumlah_pertemuan_id" id="jumlah_pertemuan_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($price_list as $price_list) : ?>
                                <option value="<?= $price_list->id ?>"><?= $price_list->jumlah_pertemuan ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-jumlah-pertemuan">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto_anak">Upload Foto Ananda :</label>
                        <input type="file" class="form-control" id="foto_anak" name="foto_anak" />
                        <div class="invalid-feedback error-foto-anak">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_tf">Upload bukti transfer pendaftaran Rp 350.000, ke BNI 0949684935 a.n Annisa Shofaril Wahidah :</label>
                        <input type="file" class="form-control" id="bukti_tf" name="bukti_tf" />
                        <div class="invalid-feedback error-bukti-tf">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="izin_dokumentasi">Apakah Mom/Pap berkenan jika dokumentasi kegiatan belajar Ananda (foto/video) digunakan untuk kebutuhan media sosial Alifya Learning :</label>
                        <label>
                            Dokumentasi akan ditampilkan dengan tetap menjaga etika, kenyamanan, dan privasi Ananda
                        </label>
                        <select name="izin_dokumentasi" id="izin_dokumentasi" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="ya, berkenan">Ya, Berkenan</option>
                            <option value="tidak, saya tidak berkenan">Tidak, Saya Tidak Berkenan</option>
                        </select>
                        <div class="invalid-feedback error-izin-dokumentasi">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="info_alifya">Dari mana Mom/Pap mengetahui Alifya Learning? :</label>
                        <input type="text" class="form-control" id="info_alifya" name="info_alifya" placeholder="Boleh sebutkan nama orang yang merekomendasikan, akun media sosial, atau sumber lainnya" />
                        <div class="invalid-feedback error-info-alifya">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="data_1">Saya Menyatakan Bahwa :</label>
                        <select name="data_1" id="data_1" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan">Saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan</option>
                        </select>
                        <div class="invalid-feedback error-data1">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="data_2">Saya Menyatakan Bahwa :</label>
                        <select name="data_2" id="data_2" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="saya memahami dan menyetujui proses belajar di alifya">Saya memahami dan menyetujui proses belajar di Alifya</option>
                        </select>
                        </select>
                        <div class="invalid-feedback error-data2">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_bergabung">Tanggal Bergabung :</label>
                        <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" />
                        <div class="invalid-feedback error-tanggal-bergabung">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_peserta_id">Status Peserta Didik :</label>
                        <select name="status_peserta_id" id="status_peserta_id" class="form-select">
                            <option value="">--Silahkan Pilih</option>
                            <?php foreach ($status_murid as $status_murid) : ?>
                                <option value="<?= $status_murid->id ?>"><?= $status_murid->status_murid ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback error-status-peserta-didik">
                        </div>
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
    $(document).ready(function() {

        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/mitra_pengajar/peserta_ahl/getPesertaAhl',
                method: 'POST'
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: true
                },
                {
                    data: 'nama_lengkap_anak',
                },
                {
                    data: 'lihat_profil',
                    orderable: false
                },

                {
                    data: 'status_murid',
                },

            ],
        });
    });


    $(document).ready(function(e) {
        $("#edit_form").submit(function(e) {
            e.preventDefault();

            let id_edit = $("#id_edit").val();

            let foto_anak_lama = $("#foto_anak_lama").val();
            let bukti_tf_lama = $("#bukti_tf_lama").val();

            let ketersediaan = $("#ketersediaan").val();
            // Data Orang Tua
            let nama_ayah = $("#nama_ayah").val();
            let pekerjaan_ayah = $("#pekerjaan_ayah").val();
            let nama_ibu = $("#nama_ibu").val();
            let pekerjaan_ibu = $("#pekerjaan_ibu").val();
            let usersname_instagram = $("#usersname_instagram").val();
            let nomor_whatsapp_orang_tua = $("#nomor_whatsapp_orang_tua").val();
            let alamat_domisili_anak = $("#alamat_domisili_anak").val();

            // Data Murid
            let nama_lengkap_anak = $("#nama_lengkap_anak").val();
            let nama_panggilan_anak = $("#nama_panggilan_anak").val();
            let tanggal_lahir_anak = $("#tanggal_lahir_anak").val();
            let jenis_kelamin = $("#jenis_kelamin").val();
            let pendidikan_id = $("#pendidikan_id").val();
            let sekolah_anak = $("#sekolah_anak").val();
            let ukuran_baju = $("#ukuran_baju").val();

            // 
            let program_belajar_ahl_id = $("#program_belajar_ahl_id").val();
            let jumlah_pertemuan_id = $("#jumlah_pertemuan_id").val();

            let foto_anak = $("#foto_anak").val();
            let bukti_tf = $("#bukti_tf").val();
            let izin_dokumentasi = $("#izin_dokumentasi").val();
            let info_alifya = $("#info_alifya").val();
            let data_1 = $("#data_1").val();
            let data_2 = $("#data_2").val();
            let tanggal_bergabung = $("#tanggal_bergabung").val();
            let status_peserta_id = $("#status_peserta_id").val();

            let formData = new FormData(this);

            formData.append('id', id_edit);
            formData.append('foto_anak_lama', foto_anak_lama);
            formData.append('bukti_tf_lama', bukti_tf_lama);

            formData.append('ketersediaan', ketersediaan);

            formData.append('nama_ayah', nama_ayah);
            formData.append('pekerjaan_ayah', pekerjaan_ayah);
            formData.append('nama_ibu', nama_ibu);
            formData.append('pekerjaan_ibu', pekerjaan_ibu);
            formData.append('usersname_instagram', usersname_instagram);
            formData.append('nomor_whatsapp_orang_tua', nomor_whatsapp_orang_tua);
            formData.append('alamat_domisili_anak', alamat_domisili_anak);

            formData.append('nama_lengkap_anak', nama_lengkap_anak);
            formData.append('nama_panggilan_anak', nama_panggilan_anak);
            formData.append('tanggal_lahir_anak', tanggal_lahir_anak);
            formData.append('jenis_kelamin', jenis_kelamin);
            formData.append('pendidikan_id', pendidikan_id);
            formData.append('ukuran_baju', ukuran_baju);

            formData.append('program_belajar_ahl_id', program_belajar_ahl_id);
            formData.append('jumlah_pertemuan_id', jumlah_pertemuan_id);
            formData.append('foto_anak', foto_anak);
            formData.append('bukti_tf', bukti_tf);
            formData.append('izin_dokumentasi', izin_dokumentasi);
            formData.append('info_alifya', info_alifya);
            formData.append('data_1', data_1);
            formData.append('data_2', data_2);
            formData.append('tanggal_bergabung', tanggal_bergabung);
            formData.append('status_peserta_id', status_peserta_id);

            $.ajax({
                url: '/admin/peserta_ahl/update',
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
                    $('.update').html('<i class="bi bi-arrow-right"></i> Ubah');
                    $('.update').prop('disabled', false);
                    if (response.error) {
                        if (response.error.ketersediaan) {
                            $("#ketersediaan").addClass('is-invalid');
                            $(".error-ketersediaan").html(response.error.ketersediaan);
                        } else {
                            $("#ketersediaan").removeClass('is-invalid');
                            $(".error-ketersediaan").html('');
                        }
                        if (response.error.nama_ayah) {
                            $("#nama_ayah").addClass('is-invalid');
                            $(".error-nama-ayah").html(response.error.nama_ayah);
                        } else {
                            $("#nama_ayah").removeClass('is-invalid');
                            $(".error-nama-ayah").html('');
                        }
                        if (response.error.pekerjaan_ayah) {
                            $("#pekerjaan_ayah").addClass('is-invalid');
                            $(".error-pekerjaan-ayah").html(response.error.pekerjaan_ayah);
                        } else {
                            $("#pekerjaan_ayah").removeClass('is-invalid');
                            $(".error-pekerjaan-ayah").html('');
                        }
                        if (response.error.nama_ibu) {
                            $("#nama_ibu").addClass('is-invalid');
                            $(".error-nama-ibu").html(response.error.nama_ibu);
                        } else {
                            $("#nama_ibu").removeClass('is-invalid');
                            $(".error-nama-ibu").html('');
                        }
                        if (response.error.pekerjaan_ibu) {
                            $("#pekerjaan_ibu").addClass('is-invalid');
                            $(".error-pekerjaan-ibu").html(response.error.pekerjaan_ibu);
                        } else {
                            $("#pekerjaan_ibu").removeClass('is-invalid');
                            $(".error-pekerjaan-ibu").html('');
                        }
                        if (response.error.usersname_instagram) {
                            $("#usersname_instagram").addClass('is-invalid');
                            $(".error-usersname-instagram").html(response.error.usersname_instagram);
                        } else {
                            $("#usersname_instagram").removeClass('is-invalid');
                            $(".error-usersname-instagram").html('');
                        }
                        if (response.error.nomor_whatsapp_orang_tua) {
                            $("#nomor_whatsapp_orang_tua").addClass('is-invalid');
                            $(".error-wa-anak").html(response.error.nomor_whatsapp_orang_tua);
                        } else {
                            $("#nomor_whatsapp_orang_tua").removeClass('is-invalid');
                            $(".error-wa-anak").html('');
                        }
                        if (response.error.alamat_domisili_anak) {
                            $("#alamat_domisili_anak").addClass('is-invalid');
                            $(".error-alamat-domisili-anak").html(response.error.alamat_domisili_anak);
                        } else {
                            $("#alamat_domisili_anak").removeClass('is-invalid');
                            $(".error-alamat-domisili-anak").html('');
                        }
                        if (response.error.nama_lengkap_anak) {
                            $("#nama_lengkap_anak").addClass('is-invalid');
                            $(".error-nama-lengkap-anak").html(response.error.nama_lengkap_anak);
                        } else {
                            $("#nama_lengkap_anak").removeClass('is-invalid');
                            $(".error-nama-lengkap-anak").html('');
                        }
                        if (response.error.nama_panggilan_anak) {
                            $("#nama_panggilan_anak").addClass('is-invalid');
                            $(".error-nama-panggilan-anak").html(response.error.nama_panggilan_anak);
                        } else {
                            $("#nama_panggilan_anak").removeClass('is-invalid');
                            $(".error-nama-panggilan-anak").html('');
                        }
                        if (response.error.tanggal_lahir_anak) {
                            $("#tanggal_lahir_anak").addClass('is-invalid');
                            $(".error-tanggal-lahir-anak").html(response.error.tanggal_lahir_anak);
                        } else {
                            $("#tanggal_lahir_anak").removeClass('is-invalid');
                            $(".error-tanggal-lahir-anak").html('');
                        }
                        if (response.error.jenis_kelamin) {
                            $("#jenis_kelamin").addClass('is-invalid');
                            $(".error-jenis-kelamin").html(response.error.jenis_kelamin);
                        } else {
                            $("#jenis_kelamin").removeClass('is-invalid');
                            $(".error-jenis-kelamin").html('');
                        }
                        if (response.error.pendidikan_id) {
                            $("#pendidikan_id").addClass('is-invalid');
                            $(".error-pendidikan").html(response.error.pendidikan_id);
                        } else {
                            $("#pendidikan_id").removeClass('is-invalid');
                            $(".error-pendidikan").html('');
                        }
                        if (response.error.sekolah_anak) {
                            $("#sekolah_anak").addClass('is-invalid');
                            $(".error-sekolah_anak").html(response.error.sekolah_anak);
                        } else {
                            $("#sekolah_anak").removeClass('is-invalid');
                            $(".error-sekolah_anak").html('');
                        }
                        if (response.error.ukuran_baju) {
                            $("#ukuran_baju").addClass('is-invalid');
                            $(".error-ukuran-baju").html(response.error.ukuran_baju);
                        } else {
                            $("#ukuran_baju").removeClass('is-invalid');
                            $(".error-ukuran-baju").html('');
                        }
                        if (response.error.program_belajar_ahl_id) {
                            $("#program_belajar_ahl_id").addClass('is-invalid');
                            $(".error-program-belajar").html(response.error.program_belajar_ahl_id);
                        } else {
                            $("#program_belajar_ahl_id").removeClass('is-invalid');
                            $(".error-program-belajar").html('');
                        }
                        if (response.error.jumlah_pertemuan_id) {
                            $("#jumlah_pertemuan_id").addClass('is-invalid');
                            $(".error-jumlah-pertemuan").html(response.error.jumlah_pertemuan_id);
                        } else {
                            $("#jumlah_pertemuan_id").removeClass('is-invalid');
                            $(".error-jumlah-pertemuan").html('');
                        }
                        if (response.error.foto_anak) {
                            $("#foto_anak").addClass('is-invalid');
                            $(".error-foto-anak").html(response.error.foto_anak);
                        } else {
                            $("#foto_anak").removeClass('is-invalid');
                            $(".error-foto-anak").html('');
                        }
                        if (response.error.bukti_tf) {
                            $("#bukti_tf").addClass('is-invalid');
                            $(".error-bukti-tf").html(response.error.bukti_tf);
                        } else {
                            $("#bukti_tf").removeClass('is-invalid');
                            $(".error-bukti-tf").html('');
                        }
                        if (response.error.izin_dokumentasi) {
                            $("#izin_dokumentasi").addClass('is-invalid');
                            $(".error-izin-dokumentasi").html(response.error.izin_dokumentasi);
                        } else {
                            $("#izin_dokumentasi").removeClass('is-invalid');
                            $(".error-izin-dokumentasi").html('');
                        }
                        if (response.error.info_alifya) {
                            $("#info_alifya").addClass('is-invalid');
                            $(".error-info-alifya").html(response.error.info_alifya);
                        } else {
                            $("#info_alifya").removeClass('is-invalid');
                            $(".error-info-alifya").html('');
                        }
                        if (response.error.data_1) {
                            $("#data_1").addClass('is-invalid');
                            $(".error-data1").html(response.error.data_1);
                        } else {
                            $("#data_1").removeClass('is-invalid');
                            $(".error-data1").html('');
                        }
                        if (response.error.data_2) {
                            $("#data_2").addClass('is-invalid');
                            $(".error-data2").html(response.error.data_1);
                        } else {
                            $("#data_2").removeClass('is-invalid');
                            $(".error-data2").html('');
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
                    $('.update').html('<i class="bi bi-arrow-right"></i> Ubah');
                    $('.update').prop('disabled', false);
                }
            });
        })
    });

    // Aksi Edit 
    $(document).on('click', "#edit", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/peserta_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {

                $("#id_edit").val(response.peserta_ahl.id);
                $("#foto_anak_lama").val(response.peserta_ahl.foto_anak);
                $("#bukti_tf_lama").val(response.peserta_ahl.bukti_tf);
                $("#ketersediaan").val(response.peserta_ahl.ketersediaan).trigger('change');
                $("#nama_ayah").val(response.peserta_ahl.nama_ayah);
                $("#pekerjaan_ayah").val(response.peserta_ahl.pekerjaan_ayah);
                $("#nama_ibu").val(response.peserta_ahl.nama_ibu);
                $("#pekerjaan_ibu").val(response.peserta_ahl.pekerjaan_ibu);
                $("#usersname_instagram").val(response.peserta_ahl.usersname_instagram);
                $("#nomor_whatsapp_orang_tua").val(response.peserta_ahl.nomor_whatsapp_orang_tua);
                $("#alamat_domisili_anak").val(response.peserta_ahl.alamat_domisili_anak);
                $("#nama_lengkap_anak").val(response.peserta_ahl.nama_lengkap_anak);
                $("#nama_panggilan_anak").val(response.peserta_ahl.nama_panggilan_anak);
                $("#tanggal_lahir_anak").val(response.peserta_ahl.tanggal_lahir_anak);
                $("#jenis_kelamin").val(response.peserta_ahl.jenis_kelamin).trigger('change');
                $("#pendidikan_id").val(response.peserta_ahl.pendidikan_id).trigger('change');
                $("#sekolah_anak").val(response.peserta_ahl.sekolah_anak);
                $("#ukuran_baju").val(response.peserta_ahl.ukuran_baju);
                $("#izin_dokumentasi").val(response.peserta_ahl.izin_dokumentasi).trigger('change');
                $("#info_alifya").val(response.peserta_ahl.info_alifya);
                $("#data_1").val(response.peserta_ahl.data_1);
                $("#data_2").val(response.peserta_ahl.data_2);
                $("#tanggal_bergabung").val(response.peserta_ahl.tanggal_bergabung);
                $("#status_peserta_id").val(response.peserta_ahl.status_peserta_id);
                $("#program_belajar_ahl_id").val(response.peserta_ahl.program_belajar_ahl_id).trigger('change');
                $("#jumlah_pertemuan_id").val(response.peserta_ahl.jumlah_pertemuan_id).trigger('change');



            }
        });
    });

    // Aksi Hapus
    $(document).on('click', "#delete", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/admin/peserta_ahl/edit',
            method: 'get',
            dataType: 'JSON',
            data: {
                id: id,
            },
            success: function(response) {
                $("#id_delete").val(response.peserta_ahl.id);
            }
        });
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();
        let id = $("#id_delete").val();
        $.ajax({
            url: '/admin/peserta_ahl/delete',
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