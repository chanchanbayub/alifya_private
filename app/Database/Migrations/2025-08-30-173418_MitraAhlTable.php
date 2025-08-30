<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MitraAhlTable extends Migration
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

            'mitra_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
            ],

            'jenis_layanan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
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
        $this->forge->addForeignKey('mitra_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jenis_layanan_id', 'layanan_ahl_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mitra_pengajar_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('mitra_pengajar_ahl_table');
    }
}
