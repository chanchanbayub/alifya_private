<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropColoumBulanUpahPeserta extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('harga_table', 'bulan');
    }

    public function down()
    {
        $this->forge->addColumn('harga_table', 'bulan');
    }
}
