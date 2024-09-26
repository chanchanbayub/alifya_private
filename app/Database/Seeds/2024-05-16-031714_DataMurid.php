<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataMurid extends Migration
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

            'nama_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'tanggal_lahir' => [
                'type' => 'date',
            ],

            'usia_anak' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'alamat_domisili_anak' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'program_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'materi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'hari_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'jam_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->createTable('data_anak_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_anak_table');
    }
}
