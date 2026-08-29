<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNilaiAwalDanAkhir extends Migration
{
    public function up()
    {
        $fields = [
            'nilai_awal' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'bobot'
            ],
            'nilai_akhir' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'nilai_awal'
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('skala_nilai_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('skala_nilai_table');
    }
}
