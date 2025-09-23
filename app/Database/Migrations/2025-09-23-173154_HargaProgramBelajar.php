<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HargaProgramBelajar extends Migration
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
            // 
            'program_belajar_ahl_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'nama_paket' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'jumlah_pertemuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'harga_paket' => [
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
        $this->forge->addForeignKey('program_belajar_ahl_id', 'program_ahl_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('price_list_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('price_list_table');
    }
}
