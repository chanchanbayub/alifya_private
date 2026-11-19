<?php

header("Content-Type: application/vnd-ms-excel;");
header("Content-Disposition: attachment; filename=data_peserta_ap.xls");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Alifya Private</title>
    <link href="/assets/img/logo2.png" rel="icon">
    <link href="/assets/img/logo2.png" rel="apple-touch-icon">
</head>
<style>
    table {
        width: 100%;
        vertical-align: middle;
        font-family: Arial;
        font-size: 12px;
    }

    table,
    th,
    td {
        text-transform: uppercase;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
        font-family: Arial;
        font-size: 14px;

    }

    .judul {
        font-family: Arial;
        font-size: 14px;
        text-align: center;
        text-transform: uppercase;
    }
</style>

<body>

    <div class="card-body">
        <h2 class="card-title">Data Peserta Didik AP <span>| Table </span></h2>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Lengkap Anak</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Panggilan</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Tanggal Lahir</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Jenis Kelamin</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Alamat Domisili Anak</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Ayah</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Pekerjaan Ayah</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Ibu</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Pekerjaan Ibu</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Agama</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Pendidikan Saat Ini</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Sekolah Anak</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Riwayat Penyakit</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Ukuran Baju</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nomor Whatsapp Orang Tua</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Instagram Orang Tua</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Materi Belajar</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Catatan</th>

                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($peserta_didik as $peserta_didik) : ?>
                    <tr>
                        <td scope="col"><?= $no++ ?></td>
                        <td scope="col"><?= $peserta_didik->nama_lengkap_anak ?></td>
                        <td scope="col"><?= $peserta_didik->nama_panggilan_anak ?></td>
                        <td scope="col"><?= date_indo(date('Y-m-d', strtotime($peserta_didik->tanggal_lahir_anak))) ?></td>
                        <td scope="col"><?= $peserta_didik->jenis_kelamin ?></td>
                        <td scope="col"><?= $peserta_didik->alamat_domisili_anak ?></td>
                        <td scope="col"><?= $peserta_didik->nama_ayah ?></td>
                        <td scope="col"><?= $peserta_didik->pekerjaan_ayah ?></td>
                        <td scope="col"><?= $peserta_didik->nama_ibu ?></td>
                        <td scope="col"><?= $peserta_didik->pekerjaan_ibu ?></td>
                        <td scope="col"><?= $peserta_didik->agama ?></td>
                        <td scope="col"><?= $peserta_didik->pendidikan ?></td>
                        <td scope="col"><?= $peserta_didik->sekolah_anak ?></td>
                        <td scope="col"><?= $peserta_didik->riwayat_penyakit ?></td>
                        <td scope="col"><?= $peserta_didik->ukuran_baju ?></td>
                        <td scope="col"><?= $peserta_didik->nomor_whatsapp_wali ?></td>
                        <td scope="col"><?= $peserta_didik->username_instagram_wali ?></td>
                        <td scope="col"><?= $peserta_didik->level ?></td>
                        <td scope="col"><?= $peserta_didik->catatan ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</body>

</html>