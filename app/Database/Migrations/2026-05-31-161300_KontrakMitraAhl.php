<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KontrakMitraAhl extends Migration
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
            'mitra_pengajar_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'awal_bergabung' => [
                'type'           => 'date',
            ],

            'akhir_kontrak' => [
                'type'           => 'date',
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
        $this->forge->addForeignKey('mitra_pengajar_id', 'mitra_pengajar_ahl_table', 'mitra_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kontrak_mitra_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kontrak_mitra_ahl_table');
    }
}
