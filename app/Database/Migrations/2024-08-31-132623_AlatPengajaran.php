<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlatPengajaran extends Migration
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

            'materi_belajar' => [
                'type'           => 'Varchar',
                'constraint'     => 100,
            ],
            'link' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
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
        $this->forge->createTable('alat_pengajaran_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->createTable('alat_pengajaran_table');
    }
}
