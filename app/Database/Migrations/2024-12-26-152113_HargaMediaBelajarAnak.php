<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HargaMediaBelajarAnak extends Migration
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

            'peserta_didik_id' => [
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
            'jenis_media_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'harga_media' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'lain_lain' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'faktur' => [
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
        $this->forge->addForeignKey('peserta_didik_id', 'data_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jenis_media_id', 'jenis_media_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('media_belajar_anak_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('media_belajar_anak_table');
    }
}
