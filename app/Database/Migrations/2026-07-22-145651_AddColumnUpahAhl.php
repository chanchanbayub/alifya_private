<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnUpahAhl extends Migration
{
    public function up()
    {
        $fields = [
            'insentif' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'bonus_kehadiran'
            ],
            'model_class' => [
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
