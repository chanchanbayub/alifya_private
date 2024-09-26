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
            border: 1px solid black;
            text-align: center;
            box-sizing: border-box;
            border: 1px solid;
            margin: 0 auto;
            /* text-transform: capitalize; */
        }

        table {
            margin: 0 auto;
            /* width: 100%; */
        }

        .logo {
            text-align: center;
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
            width: 200;
            z-index: -1;
        }

        .container {
            box-sizing: border-box;
            width: 100%;
            border: 1px solid black;
            padding: 40px 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/img/logo.png" id="logo_center" width="150" alt="logo">
        </div>
        <!-- <hr> -->
        <table id="pengantar">
            <thead>
                <tr>
                    <th scope="col">Mitra Pengajar</th>
                    <th scope="col">:</th>
                    <th scope="col" style="text-transform: capitalize;"><?= $mitra_pengajar->nama_lengkap ?> </th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col" style="text-transform: capitalize;">Peserta Didik </th>
                    <th scope="col">: </th>
                    <th scope="col" style="text-transform: capitalize;"><?= $peserta_didik ?> </th>
                </tr>
            </thead>
        </table>
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">Pertemuan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Upah / Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($invoice as $invoice) : ?>
                    <tr>
                        <td>Pertemuan Ke -<?= $no++ ?> </td>
                        <td> <?= tanggal_indonesia(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?>, <?= date_indo(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?></td>
                        <td>Rp. <?= number_format($harga) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total Pembayaran</th>
                    <th>Rp. <?= number_format($total * $harga) ?></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;">Tasikmalaya, <?= date('d F Y') ?></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;">Founder,</th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;"><img src="assets/img/ttd_anisa.png" alt="" class="ttd"></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;"> <span>Annisa Shofaril Wahidah Y, S.Pd.</span></th>
                </tr>
            </tfoot>
        </table>

        <img src="assets/img/cap.png" alt="" style="margin-left:830px; margin-top:-180px;" class="cap">
    </div>

</body>

</html>