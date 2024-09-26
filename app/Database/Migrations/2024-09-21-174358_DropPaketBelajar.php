<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropPaketBelajar extends Migration
{
    public function up()
    {
        $fields = [
            'jumlah_pertemuan' => [
                'name' => 'usia_anak',
                'type' => 'Varchar',
                'constraint' => 100,
                'null' => true,
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->modifyColumn('program_belajar_table', $fields, $attributes);
        $this->forge->dropColumn('program_belajar_table', 'harga');
    }

    public function down()
    {
        $this->forge->dropTable('program_belajar_table');
    }
}
