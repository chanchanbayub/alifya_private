<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpahMitraAhlTable extends Migration
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
            'mitra_ahl_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'bulan' => [
                'type'       => 'date',
            ],
            'upah_mitra' => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'lain_lain' => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
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
        $this->forge->addForeignKey('mitra_ahl_id', 'mitra_pengajar_ahl_table', 'mitra_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('upah_mitra_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('upah_mitra_ahl_table');
    }
}
