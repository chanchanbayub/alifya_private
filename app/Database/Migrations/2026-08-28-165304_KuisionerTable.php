<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KuisionerTable extends Migration
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
            'administrasi' => [
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
            'jumlah_murid_aktif' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->addForeignKey('administrasi', 'skala_nilai_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kuisioner_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kuisioner_table');
    }
}
