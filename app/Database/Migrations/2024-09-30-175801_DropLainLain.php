<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropLainLain extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('harga_mitra_table', 'lain_lain');
    }

    public function down()
    {
        $this->forge->dropTable('harga_mitra_table');
    }
}
