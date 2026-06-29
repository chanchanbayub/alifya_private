<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SkalaNilaiApr extends Migration
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

            'kategori_apr_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'nilai' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'bobot' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'keterangan' => [
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
        $this->forge->addForeignKey('kategori_apr_id', 'kategori_apr_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('skala_nilai_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('skala_nilai_table');
    }
}
