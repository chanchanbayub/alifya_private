<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisMediaBelajar extends Migration
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

            'nama_media' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'harga_media' => [
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
        $this->forge->createTable('jenis_media_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_media_table');
    }
}
