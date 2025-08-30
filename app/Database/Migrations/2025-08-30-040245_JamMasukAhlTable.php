<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JamMasukAhlTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'jenis_pekerjaan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
            ],

            'jam_masuk_ahl' => [
                'type' => 'time',
            ],

            'jam_pulang_ahl' => [
                'type' => 'time',
            ],

            'created_at' => [
                'type' => 'datetime',

            ],
            'updated_at' => [
                'type' => 'datetime',

            ],
        ]);
        $this->forge->addKey('id', true);
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addForeignKey('jenis_pekerjaan_id', 'jenis_pekerjaan_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jam_masuk_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jam_masuk_ahl_table');
    }
}
