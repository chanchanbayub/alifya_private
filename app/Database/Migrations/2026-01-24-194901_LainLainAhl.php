<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LainLainAhl extends Migration
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

            'peserta_didik_ahl_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],

            'bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tahun' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'lain_lain' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
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
        $this->forge->addForeignKey('peserta_didik_ahl_id', 'peserta_didik_ahl_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lain_lain_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('lain_lain_ahl_table');
    }
}
