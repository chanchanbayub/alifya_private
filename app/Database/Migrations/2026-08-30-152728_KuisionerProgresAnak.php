<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KuisionerProgresAnak extends Migration
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

            'pembimbing_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'mitra_pengajar_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'peserta_didik_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'bulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tahun' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'progres_anak' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('pembimbing_id', 'pembimbing_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mitra_pengajar_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('peserta_didik_id', 'data_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('progres_anak', 'skala_nilai_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kuisioner_progres_anak_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kuisioner_progres_anak_table');
    }
}
