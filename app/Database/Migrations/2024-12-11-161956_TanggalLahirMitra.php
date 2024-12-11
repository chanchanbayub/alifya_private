<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TanggalLahirMitra extends Migration
{
    public function up()
    {
        $fields = [
            'tanggal_lahir_mitra' => [
                'type'           => 'date',
                'null'  => true,
                'after' => 'email',
            ],


        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('data_pengajar_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropColumn('data_pengajar_table', 'tanggal_lahir_mitra');
    }
}
