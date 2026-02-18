<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <h1 class="mb-4">Alifya Home Learning</h1>
            <p class="section-title px-5">
                <span class="px-2 text-secondary">Pendaftaran Alifya Home Learning</span>
            </p>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5>PILIHAN PROGRAM DAN AJUAN JADWAL
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="control-group">
                            <label>Alifya Learning percaya bahwa pendidikan bukan hanya tentang hasil cepat, tetapi tentang proses panjang yang konsisten, sabar, dan menyenangkan. Maka dari itu, penting bagi Mom/Pap memahami bahwa perkembangan setiap anak berbeda dan membutuhkan waktu 🌱 </label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="sendLamaran" novalidate="novalidate">
                        <?= csrf_field(); ?>
                        <div class="control-group">
                            <label for="ketersediaan">Apakah Mom/Pap bersedia untuk Ananda ikut berproses bersama Alifya? :</label>
                            <select name="ketersediaan" id="ketersediaan" class="form-control">
                                <option value="">--Silahkan Pilih--</option>
                                <option value="ya, bersedia">Ya, Bersedia</option>
                                <option value="tidak bersedia">Tidak Bersedia</option>
                            </select>

                            <p class="help-block text-danger error-ketersediaan"></p>
                        </div>

                        <div class="control-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>DATA ORANG TUA / WALI
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="control-group">
                                        <label for="nama_ayah">Nama Ayah :</label>
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukan Nama Ayah" />
                                        <p class="help-block text-danger error-nama-ayah"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="control-group">
                            <label for="pekerjaan_ayah">Pekerjaan Ayah :</label>
                            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Masukan Pekerjaan Ayah" />
                            <p class="help-block text-danger error-pekerjaan-ayah"></p>
                        </div>

                        <div class="control-group">
                            <label for="nama_ibu">Nama Ibu :</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Masukan Nama Ibu" />
                            <p class="help-block text-danger error-nama-ibu"></p>
                        </div>

                        <div class="control-group">
                            <label for="pekerjaan_ibu">Pekerjaan Ibu :</label>
                            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Masukan Pekerjaan ibu" />
                            <p class="help-block text-danger error-pekerjaan-ibu"></p>
                        </div>

                        <div class="control-group">
                            <label for="usersname_instagram">Username Instagram Orang Tua :</label>
                            <input type="text" class="form-control" id="usersname_instagram" name="username_instagram" placeholder="Masukan Username Instagram" />
                            <p class="help-block text-danger error-usersname-instagram"></p>
                        </div>

                        <div class="control-group">
                            <label for="nomor_whatsapp_orang_tua">Nomor Whatssapp aktif :</label>
                            <input type="number" class="form-control" id="nomor_whatsapp_orang_tua" name="nomor_whatsapp_orang_tua" placeholder="6281xxxxxx" />
                            <p class="help-block text-danger error-wa-anak"></p>
                        </div>

                        <div class="control-group">
                            <label for="alamat_domisili_anak">Alamat Domisili Lengkap :</label>
                            <textarea name="alamat_domisili_anak" id="alamat_domisili_anak" class="form-control"></textarea>
                            <p class="help-block text-danger error-alamat-domisili-anak"></p>
                        </div>

                        <div class="control-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>DATA ANANDA
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="control-group">
                                        <label for="nama_lengkap_anak">Nama Lengkap Anak :</label>
                                        <input type="text" class="form-control" id="nama_lengkap_anak" name="nama_lengkap_anak" placeholder="Masukan Nama Lengkap Anak" />
                                        <p class="help-block text-danger error-nama-lengkap-anak"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="control-group">
                            <label for="nama_panggilan_anak">Nama Panggilan Anak :</label>
                            <input type="text" class="form-control" id="nama_panggilan_anak" name="nama_panggilan_anak" placeholder="Masukan Panggilan Anak" />
                            <p class="help-block text-danger error-nama-panggilan-anak"></p>
                        </div>

                        <div class="control-group">
                            <label for="tanggal_lahir_anak">Tanggal Lahir Anak :</label>
                            <input type="date" class="form-control" id="tanggal_lahir_anak" name="tanggal_lahir_anak" />
                            <p class="help-block text-danger error-tanggal_lahir_anak"></p>
                        </div>

                        <div class="control-group">
                            <label for="jenis_kelamin">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="">Silahkan Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>

                            <p class="help-block text-danger error-jenis-kelamin"></p>
                        </div>

                        <div class="control-group">
                            <label for="pendidikan_id">Tingkat pendidikan formal saat ini :</label>
                            <select name="pendidikan_id" id="pendidikan_id" class="form-control">
                                <option value="">Silahkan Pilih</option>
                                <?php foreach ($pendidikan as $pendidikan) : ?>
                                    <option value="<?= $pendidikan->id ?>"><?= $pendidikan->pendidikan ?></option>
                                <?php endforeach; ?>
                            </select>

                            <p class="help-block text-danger error-pendidikan"></p>
                        </div>

                        <div class="control-group">
                            <label for="sekolah_anak">Nama Sekolah :</label>
                            <input type="text" class="form-control" id="sekolah_anak" name="sekolah_anak" placeholder="SDN ...." />
                            <p class="help-block text-danger error-sekolah-anak"></p>
                        </div>

                        <div class="control-group">
                            <label for="ukuran_baju">Ukuran Baju Anak :</label>
                            <table border="1" style="border-collapse: collapse; text-align:center">
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
                            <br>
                            <select name="ukuran_baju" id="ukuran_baju" class="form-control">
                                <option value="">Silahkan Pilih</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>

                            <p class="help-block text-danger error-ukuran-baju"></p>
                        </div>

                        <br>
                        <div class="control-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>PILIHAN PROGRAM DAN AJUAN JADWAL
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="control-group">
                                        <label>Alifya Home Learning tetap mengusung konsep semi-private agar tiap anak mendapatkan perhatian maksimal: </label>
                                        <br>
                                        <span>🔹 Kelas Preskill: 1 guru untuk 2 anak </span> <br>
                                        <span>🔹 Kelas Baca - Ngaji: 1 guru untuk 3 anak</span> <br>
                                        <span>🔹 Kelas Public Speaking: 1 guru untuk 4 anak </span> <br>
                                        <br>
                                        <span> Durasi belajar: 60 - 70 menit.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="control-group">
                            <label for="program_belajar_id">Brosur Alifya Home Learning (<a href="/assets/img/price_list.jpeg" target="_blank">Lihat Brosur</a>) :</label>
                            <br>
                            <img src="/assets/img/price_list.jpeg" alt="brosur" width="350">
                        </div>
                        <br>

                        <div class="control-group">
                            <label for="program_belajar_ahl_id">Program Belajar :</label>
                            <select name="program_belajar_ahl_id" id="program_belajar_ahl_id" class="form-control">
                                <option value="">--Silahkan Pilih</option>
                                <?php foreach ($program_ahl as $program_ahl) : ?>
                                    <option value="<?= $program_ahl->id ?>"><?= $program_ahl->nama_program ?> (<?= $program_ahl->usia_anak ?>)</option>
                                <?php endforeach; ?>

                            </select>
                            <p class="help-block text-danger error-program-belajar"></p>
                        </div>

                        <div class="control-group">
                            <label for="jumlah_pertemuan_id">Jumlah Pertemuan :</label>
                            <select name="jumlah_pertemuan_id" id="jumlah_pertemuan_id" class="form-control">
                                <option value="">--Silahkan Pilih</option>
                                <?php foreach ($jumlah_pertemuan as $jumlah_pertemuan) : ?>
                                    <option value="<?= $jumlah_pertemuan->id ?>"><?= $jumlah_pertemuan->jumlah_pertemuan ?> (<?= $jumlah_pertemuan->nama_paket ?>) (<?= $jumlah_pertemuan->nama_program ?> ) </option>
                                <?php endforeach; ?>

                            </select>
                            <p class="help-block text-danger error-jumlah-pertemuan"></p>
                        </div>

                        <div class="control-group">
                            <div class="card">
                                <div class="card-header">
                                    <h5>LAMPIRAN TAMBAHAN
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="control-group">
                                        <label for="foto_anak">Upload Foto Ananda :</label>
                                        <input type="file" class="form-control" id="foto_anak" name="foto_anak" />
                                        <p class="help-block text-danger error-foto-anak"></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">
                            <label for="bukti_tf">Upload bukti transfer pendaftaran Rp 350.000, ke BNI 0949684935 a.n Annisa Shofaril Wahidah :</label>
                            <input type="file" class="form-control" id="bukti_tf" name="bukti_tf" />
                            <p class="help-block text-danger error-bukti-tf"></p>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>PERSETUJUAN
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="control-group">
                                    <label for="izin_dokumentasi">Apakah Mom/Pap berkenan jika dokumentasi kegiatan belajar Ananda (foto/video) digunakan untuk kebutuhan media sosial Alifya Learning :</label>
                                    <label>
                                        Dokumentasi akan ditampilkan dengan tetap menjaga etika, kenyamanan, dan privasi Ananda
                                    </label>
                                    <select name="izin_dokumentasi" id="izin_dokumentasi" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        <option value="ya, berkenan">Ya, Berkenan</option>
                                        <option value="Tidak, Saya Tidak Berkenan">Tidak, Saya Tidak Berkenan</option>
                                    </select>
                                    <p class="help-block text-danger error-izin-dokumentasi"></p>
                                </div>

                            </div>
                        </div>
                </div>
                <br>
                <div class="control-group">
                    <label for="info_alifya">Dari mana Mom/Pap mengetahui Alifya Learning? :</label>
                    <input type="text" class="form-control" id="info_alifya" name="info_alifya" placeholder="Boleh sebutkan nama orang yang merekomendasikan, akun media sosial, atau sumber lainnya" />
                    <p class="help-block text-danger error-info-alifya"></p>
                </div>

                <div class="control-group">
                    <label for="data_1">Saya Menyatakan Bahwa :</label>
                    <select name="data_1" id="data_1" class="form-control">
                        <option value="">--Silahkan Pilih--</option>
                        <option value="Saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan">Saya mengisi data ini dengan jujur dan dapat dipertanggung jawabkan</option>
                    </select>
                    <p class="help-block text-danger error-data1"></p>
                </div>
                <div class="control-group">
                    <label for="data_2">Saya Menyatakan Bahwa :</label>
                    <select name="data_2" id="data_2" class="form-control">
                        <option value="">--Silahkan Pilih--</option>
                        <option value="Saya memahami dan menyetujui proses belajar di Alifya">Saya memahami dan menyetujui proses belajar di Alifya</option>
                    </select>
                    <p class="help-block text-danger error-data2"></p>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-lg save" type="submit" id="sendMessageButton">
                    Kirim
                </button>
            </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
<!-- Contact End -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $("#sendLamaran").submit(function(e) {
        e.preventDefault();

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

        let formData = new FormData(this);

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


        $.ajax({
            url: '/daftar_peserta_ahl/insert',
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
                $('.save').html(`Kirim`)
                $('.save').prop('disabled', false);
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
                        window.location.href = '/';
                    }, 4000)
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: `Data Belum Tersimpan!`,
                });
                $('.save').html(`<button class="btn btn-primary py-2 px-10 save" type="submit" id="sendMessageButton">
                                Kirim 
                            </button>`)
                $('.save').prop('disabled', false);
            }
        });
    })
</script>


<?= $this->endSection(); ?>