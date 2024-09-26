<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataGuru extends Migration
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
            'uid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'usia' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'alamat_domisili' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'pendidikan_terakhir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'status_perkawinan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'nomor_whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'username_instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'cv' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],

            'status_id' => [
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
        $this->forge->addForeignKey('status_id', 'status_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('data_pengajar_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_pengajar_table');
    }
}
