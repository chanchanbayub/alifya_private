<?php

header("Content-Type: application/vnd-ms-excel;");
header("Content-Disposition: attachment; filename=pembukuan_mitra_ahl.xls");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembukuan Mitra Alifya Home Learning</title>
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
                    <th scope="col" style="text-transform: capitalize; text-align:center">Nama Lengkap</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Upah Mitra</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Bonus Kehadiran</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Insentif/Backup</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Booster Penugasan </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Model Class</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Penalangan</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Lain-Lain</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Pendapatan AP</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center">Total Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($upah_ahl as $upah) : ?>
                    <tr>
                        <td scope="col"><?= $no++ ?></td>
                        <td scope="col" style="text-transform: capitalize;"><?= $upah["nama_lengkap"] ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["upah_mitra"], 0, ",", ".")   ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["bonus_kehadiran"], 0, ",", ".")   ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["insentif"], 0, ",", ".")   ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["booster_penugasan"], 0, ",", ".")  ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["model_class"], 0, ",", ".") ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["penalangan"], 0, ",", ".") ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["lain_lain"], 0, ",", ".") ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center"><?= number_format($upah["pendapatan_ap"], 0, ",", ".") ?></td>
                        <td scope="col" style="text-transform: capitalize; text-align:center; font-weight: bold"><?= number_format($upah["total_akhir"], 0, ",", ".") ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>