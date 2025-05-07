<?php

header("Content-Type: application/vnd-ms-excel;");
header("Content-Disposition: attachment; filename=pembukuan_peserta_didik.xls");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembukuan Peserta Didik</title>
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
        <h2 class="card-title">Rekap Invoice Bulan <?= bulan($bulan_indo)  ?> <span>| Table </span></h2>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Mitra Pengajar</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Anak</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Presensi</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Upah Per Anak</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Upah</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Media Belajar</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Lain-Lain</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Total Akhir</th>
                    <th colspan="2" scope="col" style="text-transform: capitalize; text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_presensi as $presensi) : ?>
                    <tr>
                        <td scope="col"><?= $no++ ?></td>
                        <td scope="col" style="text-transform: capitalize;"><?= $presensi["nama_lengkap"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= $presensi["nama_lengkap_anak"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= $presensi["total_presensi_perbulan"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["harga"])  ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["jumlah_upah"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["media_belajar"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["lain_lain"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center; font-weight: bold">Rp. <?= number_format($presensi["total_akhir"]) ?>.</td>
                        <td></td>
                        <td></td>
                    </tr>
            </tbody>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: center;">TOTAL PEMASUKAN :</th>
                <th style="text-align: center;"><?= $total_presensi_perbulan ?></th>
                <th colspan="7" style="text-align: center;">Rp. <?= number_format($total_pemasukan) ?> </th>

            </tr>
        </tfoot>
        </table>
    </div>

</body>

</html>