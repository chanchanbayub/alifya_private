<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalTetap extends Migration
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
            'hari_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],

            'mitra_pengajar_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'peserta_didik_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'jam_belajar' => [
                'type'           => 'time',
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
        $this->forge->addForeignKey('hari_id', 'hari_belajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mitra_pengajar_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('peserta_didik_id', 'data_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jadwal_tetap_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_tetap_table');
    }
}
