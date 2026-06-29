<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriAprTable extends Migration
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

            'nama_kategori_apr' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'bobot_nilai_apr' => [
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
        $this->forge->createTable('kategori_apr_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kategori_apr_table');
    }
}
