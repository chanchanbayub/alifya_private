<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penambahan extends Migration
{
    public function up()
    {
        $fields = [
            'patokan_alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'alamat_domisili'
            ],
            'kontak_darurat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'patokan_alamat'
            ],
            'cakupan_wilayah' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'patokan_alamat'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('data_pengajar_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_pengajar_table');
    }
}
