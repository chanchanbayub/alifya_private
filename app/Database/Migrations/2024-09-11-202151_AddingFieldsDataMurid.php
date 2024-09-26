<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingFieldsDataMurid extends Migration
{
    public function up()
    {
        $fields = [
            'nama_ayah' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'waktu_belajar'
            ],
            'pekerjaan_ayah' => [
                'type' => 'varchar',
                'constraint' => 255,
                'after' => 'nama_ayah'
            ],
            'nama_ibu' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'pekerjaan_ayah'
            ],
            'pekerjaan_ibu' => [
                'type' => 'varchar',
                'constraint' => 255,
                'after' => 'nama_ibu'
            ]
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('data_murid_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropColumn('data_murid_table', 'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu');
    }
}
