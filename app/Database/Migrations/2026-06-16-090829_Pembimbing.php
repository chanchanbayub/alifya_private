<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembimbing extends Migration
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
            'mitra_pengajar_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
        $this->forge->addForeignKey('mitra_pengajar_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembimbing_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('pembimbing_table');
    }
}
