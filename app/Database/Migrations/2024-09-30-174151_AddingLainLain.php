<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingLainLain extends Migration
{
    public function up()
    {
        $fields = [
            'lain_lain' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'booster_media'
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
