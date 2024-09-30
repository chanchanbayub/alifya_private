<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingMediaBelajarInUpahAnak extends Migration
{
    public function up()
    {
        $fields = [
            'media_belajar' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'harga'
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('harga_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('harga_table');
    }
}
