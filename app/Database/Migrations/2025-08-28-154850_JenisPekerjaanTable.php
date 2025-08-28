<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisPekerjaanTable extends Migration
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

            'jenis_pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
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
        $this->forge->createTable('jenis_pekerjaan_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_pekerjaan_table');
    }
}
