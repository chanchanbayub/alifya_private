<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingBoosterMedia extends Migration
{
    public function up()
    {
        $fields = [
            'booster_media' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'harga_mitra'
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('harga_mitra_table', $fields, false, $attributes);
        $this->forge->dropColumn('harga_mitra_table', 'bulan_mitra');
    }

    public function down()
    {
        $this->forge->dropTable('harga_mitra_table');
    }
}
