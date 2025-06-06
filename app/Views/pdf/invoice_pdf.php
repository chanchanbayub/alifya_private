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
            padding: 6px 5px;
        }


        .logo {
            text-align: center;
            /* margin-top: -40px; */
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
            <img src="assets/img/logo.png" id="logo_center" width="100" alt="logo">
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
                    <th scope="col" style="text-transform: capitalize;">Peserta Didik </th>
                    <th scope="col">: </th>
                    <th scope="col" style="text-transform: capitalize;"><?= $peserta_didik ?> </th>
                </tr>
            </thead>
        </table>
        <table id="table">
            <thead>
                <tr>
                    <th>Pertemuan</th>
                    <th>Tanggal</th>
                    <th>Upah / Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($invoice as $invoice) : ?>
                    <tr>
                        <td>Pertemuan Ke -<?= $no++ ?> </td>
                        <td> <?= tanggal_indonesia(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?>, <?= date_indo(date('Y-m-d', strtotime($invoice->tanggal_masuk))) ?></td>
                        <?php if ($harga != null) : ?>
                            <td>Rp. <?= number_format($harga->harga) ?></td>
                        <?php else : ?>
                            <td>Rp. 0</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>

                <tr>
                    <th colspan="2">Jumlah Pertemuan</th>
                    <?php if ($harga != null) : ?>
                        <th>Rp. <?= number_format($total * $harga->harga) ?> </th>
                    <?php else : ?>
                        <th>Rp.0 </th>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th colspan="2">Media Belajar</th>
                    <?php if ($harga != null) : ?>
                        <th>Rp. <?= number_format($harga->harga_media) ?> </th>
                    <?php else : ?>
                        <th>Rp.0 </th>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th colspan="2">Lain-Lain</th>
                    <?php if ($harga != null) : ?>
                        <th>Rp. <?= number_format($harga->lain_lain) ?> </th>
                    <?php else : ?>
                        <th>Rp.0 </th>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th colspan="2">Total Pembayaran</th>
                    <?php if ($harga != null) : ?>
                        <th>Rp. <?= number_format($total * $harga->harga + $harga->harga_media + $harga->lain_lain) ?></th>
                    <?php else : ?>
                        <th>Rp.0 </th>
                    <?php endif; ?>
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
                    <th style="border: 0;">Tasikmalaya, <?= date_indo('Y-m-d');  ?></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;">Founder,</th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;"><img src="assets/img/ttd_anisa.png" alt="tanda_tangan" width="100"></th>
                </tr>
                <tr>
                    <th colspan="2" style="border: 0;"></th>
                    <th style="border: 0;"> <span>Annisa Shofaril Wahidah Y, S.Pd.</span></th>
                </tr>
            </tfoot>
        </table>
        <img src="assets/img/cap.png" alt="stempel" style="margin-left:780px; margin-top:-150px;" class="cap">
    </div>

</body>

</html>