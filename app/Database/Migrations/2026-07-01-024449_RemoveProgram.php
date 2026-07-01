<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveProgram extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('data_murid_table', 'data_murid_table_program_belajar_id_foreign');
        $this->forge->dropColumn('data_murid_table', 'program_belajar_id');
    }

    public function down()
    {
        $this->forge->dropTable('data_murid_table');
    }
}
