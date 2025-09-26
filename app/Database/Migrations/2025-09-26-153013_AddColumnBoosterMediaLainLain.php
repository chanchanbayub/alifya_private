<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnBoosterMediaLainLain extends Migration
{
    public function up()
    {
        $fields = [
            'booster_media_mitra' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'lain_lain',
                'null' => true,
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('lain_lain_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('lain_lain_table');
    }
}
