<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpahMitraAhl extends Migration
{
    public function up()
    {
        $fields = [
            'bonus_kehadiran' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'upah_mitra'
            ],
            'booster_penugasan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'bonus_kehadiran',
                'null' => true,
            ],
            'penalangan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'booster_penugasan',
                'null' => true,
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('upah_mitra_ahl_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('upah_mitra_ahl_table');
    }
}
