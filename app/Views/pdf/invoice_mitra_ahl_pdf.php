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
                    <th scope="col">Jumlah Presensi Masuk</th>
                    <th scope="col">Jumlah Presensi Pulang</th>
                    <th scope="col">Jumlah Presensi Dinas Luar</th>
                    <th scope="col">Total Presensi</th>
                    <th scope="col">Upah Mitra</th>
                    <th scope="col">Lain-Lain</th>

                </tr>
            </thead>
            <tbody id="content-table">
                <tr>
                    <td><?= $presensi_masuk ?> </td>
                    <td><?= $presensi_pulang ?> </td>
                    <td><?= $presensi_dinas_luar ?> </td>
                    <td> <?= $jumlah_presensi_perbulan ?> </td>
                    <td>Rp. <?= number_format($upah_mitra)  ?> </td>
                    <td>Rp. <?= number_format($lain_lain) ?> </td>
                </tr>
                <tr>
                    <th colspan="4">Total Pembayaran</th>
                    <th colspan="2">Rp. <?= number_format($total_akhir) ?></th>
                </tr>
            </tbody>
            <tfoot>
                <br>
                <tr>
                    <th colspan="4" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;">Tasikmalaya, <?= date('d F Y') ?></th>
                </tr>
                <tr>
                    <th colspan="4" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;">Founder,</th>
                </tr>
                <tr>
                    <th colspan="4" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;"><img src="assets/img/ttd_anisa.png" alt="" width="130" class="ttd"></th>
                </tr>
                <tr>
                    <th colspan="4" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;">Annisa Shofaril Wahidah Y, S.Pd.</th>
                </tr>
            </tfoot>
        </table>
        <img src="assets/img/cap.png" alt="" style="margin-left:850px; margin-top:-145px;" class="cap">
    </div>
</body>

</html>