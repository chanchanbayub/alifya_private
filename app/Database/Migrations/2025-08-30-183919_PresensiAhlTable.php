<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PresensiAhlTable extends Migration
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

            'jenis_pekerjaan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
            ],

            'tanggal' => [
                'type' => 'date',
            ],

            'jam' => [
                'type' => 'time',
            ],

            'lokasi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
            ],

            'lain_lain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
            ],

            'status_presensi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null'      => true,
                'unsigned' => true
            ],

            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
            ],

            'dokumentasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
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
        $this->forge->addForeignKey('jenis_pekerjaan_id', 'jenis_pekerjaan_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('lokasi_id', 'lokasi_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_presensi_id', 'status_presensi_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('presensi_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('presensi_ahl_table');
    }
}
