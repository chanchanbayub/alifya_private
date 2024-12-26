<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropColumnTableHarga extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('harga_table', 'jenis_media_id, media_belajar, faktur');
    }

    public function down()
    {
        $this->forge->addColumn('harga_table', 'jenis_media_id, media_belajar, faktur');
    }
}
