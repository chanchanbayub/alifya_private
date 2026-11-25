<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">

  <title>Kop Surat Alifya Home Learning</title>

  <style>
    body {
      font-family: "Times New Roman", serif;
      font-size: 12pt;
      color: #000;
      margin: 0;
      padding: 0;
    }


    /* KOP SURAT */
    .kop-surat {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 0;
      /* border: 1px solid black; */
    }

    .kop-surat td {
      vertical-align: middle;
      /* border: 1px solid black; */
    }

    /* LOGO */
    .kolom-logo {
      width: 15%;
      text-align: center;
      /* padding-right: 5px; */
      /* margin-top: -20px; */
      /* border: 1px solid black; */
    }


    .kolom-logo img {
      width: 35px;
      height: auto;

    }

    /* IDENTITAS LEMBAGA */
    .kolom-identitas {
      width: 80%;
      text-align: center;
    }

    .nama-lembaga {
      font-size: 16pt;
      font-weight: bold;
      text-transform: uppercase;
      line-height: 1.1;
      margin: 0;
      letter-spacing: 0.3px;
    }

    .tagline {
      font-size: 14pt;
      font-weight: bold;
      text-transform: uppercase;
      margin-top: 2px;
      margin-bottom: 5px;
    }

    .alamat {
      font-size: 10pt;
      line-height: 1.3;
      margin: 0;
    }

    .kontak {
      font-size: 10pt;
      line-height: 1.3;
      margin: 0;
    }

    /* GARIS PEMBATAS */
    .garis-kop {
      width: 100%;
      border-bottom: 1.5px solid #000;
      /* margin-top: 3px; */
      margin-bottom: 2px;
    }

    .garis-kedua {
      width: 100%;
      border-bottom: 0.5px solid #000;
    }

    /* ISI SURAT */
    .isi-surat {
      margin-top: 10px;
      line-height: 1.5;
    }

    /* JUDUL */
    .judul {
      text-align: center;
      font-size: 14pt;
      font-weight: bold;
      /* margin-bottom: 5px; */
      text-transform: uppercase;
    }

    /* BAGIAN IDENTITAS */
    .judul-bagian {
      font-size: 12pt;
      font-weight: bold;
      margin-top: 5px;
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    /* TABEL BIODATA */
    .tabel-biodata {
      width: 100%;
      border-collapse: collapse;
      font-size: 12pt;
    }

    .tabel-biodata td {
      padding: 2px 5px;
      vertical-align: top;
      line-height: 1.25;
      /* border: 1px solid black; */
    }

    .nomor {
      width: 5px;
      /* padding-left: 25px !important; */
      text-align: center;
    }

    .label {
      width: 215px;
    }

    .titik-dua {
      width: 15px;
      text-align: center;
    }

    .isi {
      width: auto;
      text-transform: capitalize;
    }

    /* SUB IDENTITAS ANAK */
    .sub-nomor {
      width: 55px;
      /* padding-left: 55px !important; */
    }

    .sub-label {
      width: 190px;
    }

    /* JARAK ANTAR BAGIAN */
    .bagian {
      margin-bottom: 5px;
    }

    /* BAGIAN FOTO DAN TANDA TANGAN */
    .bagian-bawah {
      width: 100%;
      margin-top: 70px;
      border-collapse: collapse;
    }

    .bagian-bawah td {
      vertical-align: bottom;
    }

    .kolom-foto {
      width: 50%;
      text-align: left;
      /* border: 1px solid black; */
      vertical-align: top;
    }

    .foto-siswa {
      width: 130px;
      height: 170px;
      object-fit: cover;

    }

    .kolom-ttd {
      width: 50%;
      text-align: center;
    }

    .tanggal {
      margin-bottom: 5px;
      text-align: center;
    }

    .jabatan {
      margin: 0;
      text-align: center;
    }

    .area-ttd {
      height: 90px;
      text-align: center;
    }

    .logo-ttd {
      width: 120px;
      height: 75px;
    }

    .nama-ttd {
      font-weight: bold;
      text-decoration: underline;
      margin-top: 0;
    }
  </style>
</head>

<body>

  <!-- KOP SURAT -->
  <table class="kop-surat">
    <tr>

      <!-- LOGO -->
      <td class="kolom-logo">
        <img src="assets/img/logo_baru.png" alt="logo_alifya" style="width: 100;">
      </td>

      <!-- IDENTITAS -->
      <td class="kolom-identitas">

        <p class="nama-lembaga">
          ALIFYA HOME LEARNING
        </p>

        <p class="tagline">
          LEARNING BY PLAYING
        </p>

        <p class="alamat">
          Alamat: Perumahan Casablanca, Jl. Cipicung,
          Kota Tasikmalaya
        </p>

        <p class="kontak">
          Instagram: @alifya.learning |
          Telp. +62xxxxxxxxxx
        </p>

      </td>

    </tr>
  </table>

  <!-- GARIS KOP -->
  <div class="garis-kop"></div>
  <div class="garis-kedua"></div>

  <!-- ISI SURAT -->
  <div class="isi-surat">

    <!-- JUDUL -->
    <div class="judul">
      BIODATA SISWA
    </div>

    <!-- A. IDENTITAS ANAK -->
    <div class="bagian">

      <div class="judul-bagian">
        A. IDENTITAS ANAK
      </div>

      <table class="tabel-biodata">

        <tr>
          <td class="nomor">1.</td>
          <td colspan="6">Nama Anak</td>
        </tr>

        <tr>
          <td></td>
          <td class="sub-nomor">a. Nama Lengkap</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nama_lengkap_anak ?></td>

        </tr>

        <tr>
          <td></td>
          <td class="sub-nomor">b. Nama Panggilan</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nama_panggilan_anak ?></td>
        </tr>

        <tr>
          <td class="nomor">2.</td>
          <td class="label">Jenis Kelamin</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= ($biodata_peserta->jenis_kelamin == "l" ? "Laki-Laki" : "Perempuan") ?></td>
        </tr>

        <tr>
          <td class="nomor">3.</td>
          <td class="label">Tanggal Lahir</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= date_indo($biodata_peserta->tanggal_lahir_anak)  ?></td>
        </tr>

        <tr>
          <td class="nomor">4.</td>
          <td class="label">Usia</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $usia->y ?> Tahun, <?= $usia->m ?> Bulan, <?= $usia->d ?> Hari</td>
        </tr>

        <tr>
          <td class="nomor">5.</td>
          <td class="label">Alamat</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->alamat_domisili_anak ?></td>
        </tr>

      </table>

    </div>

    <!-- B. IDENTITAS ORANG TUA -->
    <div class="bagian">

      <div class="judul-bagian">
        B. IDENTITAS ORANG TUA
      </div>

      <table class="tabel-biodata">

        <tr>
          <td colspan="1" class="nomor">1.</td>
          <td class="label">Nama Ayah</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nama_ayah ?></td>
        </tr>

        <tr>
          <td colspan="1" class="nomor">2.</td>
          <td class="label">Pekerjaan Ayah</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->pekerjaan_ayah ?></td>
        </tr>

        <tr>
          <td colspan="1" class="nomor">3.</td>
          <td class="label">Nama Ibu</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nama_ibu ?></td>
        </tr>

        <tr>
          <td colspan="1" class="nomor">4.</td>
          <td class="label">Pekerjaan Ibu</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->pekerjaan_ibu ?></td>
        </tr>

        <tr>
          <td class="nomor" colspan="1">5.</td>
          <td class="label">No. Telepon Orang Tua</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nomor_whatsapp_orang_tua ?></td>
        </tr>

      </table>

    </div>

    <!-- C. STATUS SISWA -->
    <div class="bagian">

      <div class="judul-bagian">
        C. STATUS SISWA
      </div>

      <table class="tabel-biodata">

        <tr>
          <td class="nomor" colspan="1">1.</td>
          <td class="label">Layanan</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4">Alifya Home Learning</td>
        </tr>

        <tr>
          <td class="nomor" colspan="1">2.</td>
          <td class="label">Program</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $biodata_peserta->nama_program ?></td>
        </tr>

        <tr>
          <td class="nomor" colspan="1">3.</td>
          <td class="label">Waktu Registrasi</td>
          <td class="titik-dua">:</td>
          <td class="isi" colspan="4"><?= $tgl_bergabung ?></td>
        </tr>

      </table>

    </div>

    <!-- FOTO DAN TANDA TANGAN -->
    <table class="bagian-bawah">

      <tr>

        <!-- FOTO SISWA -->
        <td class="kolom-foto">
          <img src="<?= $foto_peserta ?>"
            class="foto-siswa"
            alt="Foto Siswa">
        </td>

        <!-- TANDA TANGAN -->
        <td class="kolom-ttd">

          <p class="tanggal">
            Tasikmalaya, <?= date('d F Y') ?>
          </p>

          <p class="jabatan">
            Head of Alifya Home Learning
          </p>

          <div class="area-ttd">
            <!-- <img src="logo-ttd.png"
              class="logo-ttd"
              alt="Stempel dan Tanda Tangan"> -->
          </div>
          <br><br><br><br><br><br>

          <p class="nama-ttd">
            Eka Sutisnawati, S.Pd.
          </p>

        </td>

      </tr>

    </table>


  </div>

</body>

</html>