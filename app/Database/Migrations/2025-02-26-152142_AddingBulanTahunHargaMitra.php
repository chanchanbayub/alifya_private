<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingBulanTahunHargaMitra extends Migration
{
    public function up()
    {
        $fields = [
            'bulan' => [
                'type' => 'INT',
                'constraint' => 100,
                'after' => 'peserta_didik_id'
            ],
            'tahun' => [
                'type' => 'INT',
                'constraint' => 100,
                'after' => 'bulan'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('harga_mitra_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('harga_mitra_table');
    }
}
