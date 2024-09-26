<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgramMateri extends Migration
{
    public function up()
    {
        $fields = [
            'program_belajar_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'after' => 'id',
                'unsigned' => true
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addForeignKey('program_belajar_id', 'program_belajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addColumn('materi_belajar_table', $fields, $attributes);
        $this->forge->dropColumn('materi_belajar_table', 'keterangan');
    }

    public function down()
    {
        $this->forge->dropColumn('materi_belajar_table', 'program_belajar_id');
    }
}
