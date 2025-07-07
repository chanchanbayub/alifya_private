<?= $this->extend('layout/template_users') ?>

<?= $this->section('content') ?>
<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2 text-secondary">Daftar Sebagai Mitra Pengajar</span>
            </p>
            <h1 class="mb-4">Mitra Pengajar</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="sendLamaran" novalidate="novalidate">
                        <?= csrf_field(); ?>
                        <div class="control-group">
                            <label for="nama_lengkap">Nama Lengkap dengan Gelar :</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger error-nama-lengkap"></p>
                        </div>

                        <div class="control-group">
                            <label for="nomor_whatsapp">Nomor Whatsapp :</label>
                            <input type="nomor_whatsapp" class="form-control" id="nomor_whatsapp" name="nomor_whatsapp" placeholder="contoh : 6282xxxxxx" />
                            <p class="help-block text-danger error-nomor-whatsapp"></p>
                        </div>

                        <div class="control-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh : abc@gmail.com" />
                            <p class="help-block text-danger error-email"></p>
                        </div>

                        <div class="control-group">
                            <label for="tanggal_lahir_mitra">Tanggal Lahir :</label>
                            <input type="date" class="form-control" id="tanggal_lahir_mitra" name="tanggal_lahir_mitra" />
                            <p class="help-block text-danger error-tanggal-lahir"></p>
                        </div>

                        <div class="control-group">
                            <label for="usia">Usia :</label>
                            <input type="number" class="form-control" id="usia" name="usia" placeholder="contoh : 23" />
                            <p class="help-block text-danger error-email"></p>
                        </div>

                        <div class="control-group">
                            <label for="alamat_domisili">Alamat Domisili :</label>
                            <textarea name="alamat_domisili" id="alamat_domisili" class="form-control"></textarea>
                            <p class="help-block text-danger error-alamat-domisili"></p>
                        </div>

                        <div class="control-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir :</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="contoh : S-1" />
                            <p class="help-block text-danger error-pendidikan-terakhir"></p>
                        </div>
                        <div class="control-group">
                            <label for="jurusan">Jurusan :</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="contoh : PG - PAUD" />
                            <p class="help-block text-danger error-jurusan"></p>
                        </div>

                        <div class="control-group">
                            <label for="status_perkawinan">Status Perkawinan :</label>
                            <select name="status_perkawinan" id="status_perkawinan" class="form-control">
                                <option value="">Silahkan Pilih Status Perkawinan</option>
                                <option value="1">Lajang</option>
                                <option value="2">Menikah (sedang hamil)</option>
                                <option value="3">Menikah (tidak sedang hamil)</option>
                            </select>
                            <p class="help-block text-danger error-status-perkawinan"></p>
                        </div>
                        <div class="control-group">
                            <label for="username_instagram">Username Instagram :</label>
                            <input type="text" class="form-control" id="username_instagram" name="username_instagram" placeholder="Masukan Username Instagram : abc" />
                            <p class="help-block text-danger error-username-instagram"></p>
                        </div>
                        <div class="control-group">
                            <label for="pekerjaan">Pekerjaan / Kesibukan Saat ini :</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="contoh : guru" />
                            <p class="help-block text-danger error-pekerjaan"></p>
                        </div>
                        <div class="control-group">
                            <label for="kontrak">Apakah anda siap untuk di kontrak 1 Tahun (tidak berencana mengikuti kuliah, ppg, tidak berencana pindah domisili, tidak dalam persiapan menikah) :</label>
                            <select name="kontrak" id="kontrak" class="form-control">
                                <option value="">Silahkan Pilih </option>
                                <option value="1">Ya, Siap dikontrak 1 Tahun</option>
                                <option value="2">Tidak, Karena sudah ada rencana lain dalam waktu dekat</option>
                            </select>
                            <p class="help-block text-danger error-kontrak"></p>
                        </div>
                        <div class="control-group">
                            <label for="pernyataan">Apakah anda siap jika ditempatkan mengajar ke rumah anak, dengan jarak mak. 30 menit dari domisili anda (12 - 15km) :</label>
                            <select name="pernyataan" id="pernyataan" class="form-control">
                                <option value="">Silahkan Pilih </option>
                                <option value="1">Ya, Siap</option>
                                <option value="2">Tidak</option>
                            </select>
                            <p class="help-block text-danger error-pernyataan"></p>
                        </div>

                        <div class="control-group">
                            <label for="kendaraan_pribadi">Memiliki Kendaraan Pribadi</label>
                            <select name="kendaraan_pribadi" id="kendaraan_pribadi" class="form-control">
                                <option value="">Silahkan Pilih </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <p class="help-block text-danger error-kendaraan-pribadi"></p>
                        </div>

                        <div class="control-group">
                            <label for="media_belajar">Seberapa siapkah anda dalam menyediakan media belajar bagi anak usia 2 - 6 tahun yang kreatif, silahkan jelaskan :</label>
                            <input type="text" class="form-control" id="media_belajar" name="media_belajar" />
                            <p class="help-block text-danger error-media-belajar"></p>
                        </div>

                        <div class="control-group">
                            <label for="alasan_bergabung">Alasan ingin bergabung mengajar di Alifya Private :</label>
                            <input type="text" class="form-control" id="alasan_bergabung" name="alasan_bergabung" />
                            <p class="help-block text-danger error-alasan-bergabung"></p>
                        </div>

                        <div class="control-group">
                            <label for="kelebihan">Apa yang bisa anda tawarkan kepada kami supaya Alifya Private bisa memilih anda sebagai calon mitra pengajar dan mengikuti tahap selanjutnya yaitu interview :</label>
                            <input type="text" class="form-control" id="kelebihan" name="kelebihan" />
                            <p class="help-block text-danger error-kelebihan"></p>
                        </div>

                        <div class="control-group">
                            <label for="info_loker">Tahu info loker alifya Private dari (Sebutkan nama / platform) :</label>
                            <input type="text" class="form-control" id="info_loker" name="info_loker" />
                            <p class="help-block text-danger error-info"></p>
                        </div>

                        <div class="control-group">
                            <label for="foto">Upload Foto :</label>
                            <input type="file" class="form-control" id="foto" name="foto" />
                            <p class="help-block text-danger error-foto"></p>
                        </div>

                        <div class="control-group">
                            <label for="cv">Upload CV (pdf) :</label>
                            <input type="file" class="form-control" id="cv" name="cv" />
                            <p class="help-block text-danger error-cv"></p>
                        </div>

                        <div class="control-group">
                            <label for="ijazah">Upload Ijazah (pdf) :</label>
                            <input type="file" class="form-control" id="ijazah" name="ijazah" />
                            <p class="help-block text-danger error-ijazah"></p>
                        </div>

                        <div>
                            <button class="btn btn-primary btn-lg save" type="submit" id="sendMessageButton">
                                Kirim Lamaran
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

        let nama_lengkap = $("#nama_lengkap").val();
        let nomor_whatsapp = $("#nomor_whatsapp").val();
        let email = $("#email").val();
        let usia = $("#usia").val();
        let tanggal_lahir_mitra = $("#tanggal_lahir_mitra").val();
        let alamat_domisili = $("#alamat_domisili").val();
        let pendidikan_terakhir = $("#pendidikan_terakhir").val();
        let jurusan = $("#jurusan").val();
        let status_perkawinan = $("#status_perkawinan").val();
        let username_instagram = $("#username_instagram").val();
        let foto = $("#foto").val();
        let cv = $("#cv").val();

        let pekerjaan = $("#pekerjaan").val();
        let kontrak = $("#kontrak").val();
        let pernyataan = $("#pernyataan").val();
        let kendaraan_pribadi = $("#kendaraan_pribadi").val();
        let media_belajar = $("#media_belajar").val();
        let alasan_bergabung = $("#alasan_bergabung").val();
        let kelebihan = $("#kelebihan").val();
        let info_loker = $("#info_loker").val();
        let ijazah = $("#ijazah").val();


        let formData = new FormData(this);

        formData.append('nama_lengkap', nama_lengkap);
        formData.append('nomor_whatsapp', nomor_whatsapp);
        formData.append('email', email);
        formData.append('usia', usia);
        formData.append('tanggal_lahir_mitra', tanggal_lahir_mitra);
        formData.append('alamat_domisili', alamat_domisili);
        formData.append('pendidikan_terakhir', pendidikan_terakhir);
        formData.append('jurusan', jurusan);
        formData.append('status_perkawinan', status_perkawinan);
        formData.append('username_instagram', username_instagram);
        formData.append('foto', foto);
        formData.append('cv', cv);

        formData.append('pekerjaan', pekerjaan);
        formData.append('kontrak', kontrak);
        formData.append('pernyataan', pernyataan);
        formData.append('kendaraan_pribadi', kendaraan_pribadi);
        formData.append('media_belajar', media_belajar);
        formData.append('alasan_bergabung', alasan_bergabung);
        formData.append('kelebihan', kelebihan);
        formData.append('info_loker', info_loker);
        formData.append('ijazah', ijazah);

        $.ajax({
            url: '/daftar_mitra_pengajar/insert',
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
                $('.save').html(`Kirim Lamaran`)
                $('.save').prop('disabled', false);
                if (response.error) {
                    if (response.error.nama_lengkap) {
                        $("#nama_lengkap").addClass('is-invalid');
                        $(".error-nama-lengkap").html(response.error.nama_lengkap);
                    } else {
                        $("#nama_lengkap").removeClass('is-invalid');
                        $(".error-nama-lengkap").html('');
                    }
                    if (response.error.nomor_whatsapp) {
                        $("#nomor_whatsapp").addClass('is-invalid');
                        $(".error-nomor-whatsapp").html(response.error.nomor_whatsapp);
                    } else {
                        $("#nomor_whatsapp").removeClass('is-invalid');
                        $(".error-nomor-whatsapp").html('');
                    }
                    if (response.error.email) {
                        $("#email").addClass('is-invalid');
                        $(".error-email").html(response.error.email);
                    } else {
                        $("#email").removeClass('is-invalid');
                        $(".error-email").html('');
                    }
                    if (response.error.tanggal_lahir_mitra) {
                        $("#tanggal_lahir_mitra").addClass('is-invalid');
                        $(".error-tanggal-lahir").html(response.error.tanggal_lahir_mitra);
                    } else {
                        $("#tanggal_lahir_mitra").removeClass('is-invalid');
                        $(".error-tanggal-lahir").html('');
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
                        $(".error-alamat-domisili").html(response.error.alamat_domisili);
                    } else {
                        $("#alamat_domisili").removeClass('is-invalid');
                        $(".error-alamat-domisili").html('');
                    }
                    if (response.error.pendidikan_terakhir) {
                        $("#pendidikan_terakhir").addClass('is-invalid');
                        $(".error-pendidikan-terakhir").html(response.error.pendidikan_terakhir);
                    } else {
                        $("#pendidikan_terakhir").removeClass('is-invalid');
                        $(".error-pendidikan-terakhir").html('');
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
                        $(".error-username-instagram").html(response.error.username_instagram);
                    } else {
                        $("#username_instagram").removeClass('is-invalid');
                        $(".error-username-instagram").html('');
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
                    if (response.error.ijazah) {
                        $("#ijazah").addClass('is-invalid');
                        $(".error-ijazah").html(response.error.ijazah);
                    } else {
                        $("#ijazah").removeClass('is-invalid');
                        $(".error-ijazah").html('');
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
                                Kirim Lamaran
                            </button>`)
                $('.save').prop('disabled', false);
            }
        });
    })
</script>


<?= $this->endSection(); ?>