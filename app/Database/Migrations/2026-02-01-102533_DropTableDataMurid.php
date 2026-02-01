<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropTableDataMurid extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('data_murid_table', 'data, brosur, usia_anak');
    }

    public function down()
    {
        $this->forge->dropTable('data_murid_table');
    }
}
