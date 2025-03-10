<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice </title>
    <style>
        #table th,
        td {
            width: 100%;
            margin: 0 auto;
            border: 1px solid black;
            text-align: center;
            box-sizing: border-box;
            text-transform: capitalize;
        }

        .logo {
            text-align: center;
            /* margin-top: -30px; */
        }

        #logo_center {
            text-align: center;
        }

        #pengantar {
            text-align: left;
            margin: 0 auto;
        }

        .cap {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 150px;
            z-index: -1;
        }

        .container {
            box-sizing: border-box;
            border: 1px solid black;
            width: 100%;
            padding-left: 10px;
            padding-right: 10px;
            margin: 0 auto;
            background-image: url('assets/img/logo.png');
            background-size: 350px;
            background-repeat: no-repeat;
            background-origin: content-box;
            background-position: center;
            /* background-position-x: center; */

        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <div class="logo">
            <img src="assets/img/logo.png" id="logo_center" width="80" alt="logo">
        </div> -->
        <!-- <hr> -->
        <table id="pengantar">
            <thead>
                <tr>
                    <th scope="col">Mitra Pengajar</th>
                    <th scope="col">:</th>
                    <th scope="col" style="text-transform: capitalize;"><?= $mitra_pengajar->nama_lengkap ?> </th>
                </tr>

            </thead>
        </table>

        <table id="table">
            <thead>
                <tr>
                    <th scope="col">Pertemuan</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Harga / Pertemuan</th>
                </tr>
            </thead>
            <tbody id="content-table">
                <?php $no = 1; ?>
                <?php foreach ($invoice as $invoice) : ?>
                    <tr>
                        <td>Pertemuan Ke -<?= $no++ ?> </td>
                        <td><?= $invoice->nama_lengkap_anak ?> </td>
                        <td> <?= tanggal_indonesia(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?>, <?= date_indo(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?></td>
                        <td>Rp. <?= number_format($invoice->harga_mitra)  ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Jumlah Pertemuan</th>
                    <th>Rp. <?= number_format($total) ?></th>
                </tr>
                <tr>
                    <th colspan="3">Media Belajar</th>
                    <th>Rp. <?= number_format($media_belajar) ?></th>
                </tr>
                <tr>
                    <th colspan="3">Lain-Lain</th>
                    <th>Rp. <?= number_format($lain_lain) ?></th>
                </tr>
                <tr>
                    <th colspan="3">Booster Media</th>
                    <th>Rp. <?= number_format($booster_media) ?></th>
                </tr>
                <tr>
                    <th colspan="3">Total Pembayaran</th>
                    <th>Rp. <?= number_format($total + $media_belajar + $lain_lain + $booster_media) ?></th>
                </tr>

                <tr>
                    <th colspan="3" style="border: 0;"></th>
                    <th style="border: 0;">Tasikmalaya, <?= date('d F Y') ?></th>
                </tr>
                <tr>
                    <th colspan="3" style="border: 0;"></th>
                    <th style="border: 0;">Founder,</th>
                </tr>
                <tr>
                    <th colspan="3" style="border: 0;"></th>
                    <th style="border: 0;"><img src="assets/img/ttd_anisa.png" alt="" width="100" class="ttd"></th>
                </tr>
                <tr>
                    <th colspan="3" style="border: 0;"></th>
                    <th style="border: 0;">Annisa Shofaril Wahidah Y, S.Pd.</th>
                </tr>
            </tfoot>
        </table>
        <img src="assets/img/cap.png" alt="" style="margin-left:905px; margin-top:-145px;" class="cap">
    </div>
</body>

</html>