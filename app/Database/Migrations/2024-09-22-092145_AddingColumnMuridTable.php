<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingColumnMuridTable extends Migration
{
    public function up()
    {
        $fields = [
            'paket_belajar_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'after' => 'username_instagram_wali'
            ],
            'brosur' => [
                'type' => 'varchar',
                'constraint' => 255,
                'after' => 'foto_anak'
            ],
            'info_les' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'brosur'
            ],
            'data' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'info_les'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addForeignKey('paket_belajar_id', 'data_murid_table', 'id', 'cascade', 'cascade');
        $this->forge->addColumn('data_murid_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropColumn('data_murid_table', 'paket_belajar_id', 'brosur', 'info_les', 'data');
    }
}
