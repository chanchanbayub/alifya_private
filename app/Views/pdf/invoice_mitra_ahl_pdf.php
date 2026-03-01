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
            padding: 20px 0;
        }

        .logo {
            text-align: center;
            /* margin-top: -30px; */
        }

        #logo_center {
            text-align: center;
        }

        .pengantar {
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
            padding-top: 20px;
            padding-bottom: 20px;
            margin: 0 auto;
            background-image: url('assets/img/logo_baru.png');
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
        <table class="pengantar">
            <thead>
                <tr>
                    <th scope="col">Mitra Pengajar</th>
                    <th scope="col">:</th>
                    <th scope="col" style="text-transform: capitalize;"><?= $upah_ahl["nama_lengkap"] ?> </th>
                </tr>

            </thead>
        </table>

        <table id="table">
            <thead>
                <tr>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Mitra Pengajar</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Upah Mitra </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Bonus Kehadiran</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Booster Penugasan</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Penalangan</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Lain-Lain Ahl</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Pendapatan AP</th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Total Akhir</th>


                </tr>
            </thead>
            <tbody id="content-table">
                <tr>
                    <th scope="col" style="text-transform: capitalize; text-align:center; "><?= $upah_ahl["nama_lengkap"]  ?></th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["upah_mitra"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["bonus_kehadiran"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["booster_penugasan"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["penalangan"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["lain_lain"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["pendapatan_ap"])   ?> </th>
                    <th scope="col" style="text-transform: capitalize; text-align:center; ">Rp. <?= number_format($upah_ahl["total_akhir"])   ?> </th>
                </tr>
            </tbody>

        </table>
    </div>
    <br>
    <div>
        <table align="right">
            <thead>
                <tr>
                    <th colspan="6" style="border: 0;"></th>
                    <th style="border: 0;">Tasikmalaya, <?= date('d F Y') ?></th>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;">Founder,</th>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;"><img src="assets/img/ttd_anisa.png" alt="" width="130" class="ttd"></th>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;"></th>
                    <th colspan="2" style="border: 0;">Annisa Shofaril Wahidah Y, S.Pd.</th>
                </tr>
            </thead>
        </table>
        <img src="assets/img/logo_baru.png" alt="" style="margin-left:950px; margin-top:-155px;" class="cap">


    </div>
</body>

</html>