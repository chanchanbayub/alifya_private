<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKehadiranKuisioner extends Migration
{
    public function up()
    {
        $fields = [
            'kehadiran' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'jumlah_murid_aktif'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('kuisioner_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kuisioner_table');
    }
}
