<?php
header("Content-Type: application/vnd-ms-excel;");
header("Content-Disposition: attachment; filename=pembukuan_mitra.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembukuan Mitra</title>
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
        <h2 class="card-title">Rekap Peserta Didik Bulan <?= bulan($bulan_indo)  ?> <span>| Table </span></h2>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th scope="col" style="text-transform: capitalize; text-align:center">No</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Mitra Pengajar</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Jumlah Anak Aktif</th>
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
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= $presensi["jumlah_anak"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= $presensi["total_presensi"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["harga_mitra"])  ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["booster_media"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["total_media_belajar"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center">Rp. <?= number_format($presensi["total_lain_lain"]) ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center; font-weight: bold">Rp. <?= number_format($presensi["total_akhir"]) ?>.</td>
                        <td></td>
                        <td></td>
                    </tr>
            </tbody>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align: center;">TOTAL PEMASUKAN :</th>
                <th style="text-align: center;"><?= $total_anak_aktif ?></th>
                <th style="text-align: center;"><?= $total_presensi_perbulan ?></th>
                <th colspan="7" style="text-align: center;">Rp. <?= number_format($total_pemasukan) ?> </th>

            </tr>
        </tfoot>
        </table>
    </div>

</body>

</html>