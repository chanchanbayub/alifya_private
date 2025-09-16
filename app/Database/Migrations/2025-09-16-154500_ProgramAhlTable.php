<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgramAhlTable extends Migration
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
            'nama_program' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'usia_anak' => [
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
        $this->forge->createTable('program_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('program_ahl_table');
    }
}
