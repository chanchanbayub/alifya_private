<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingHargaTable extends Migration
{
    public function up()
    {
        $fields = [
            'jenis_media_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'after' => 'peserta_didik_id'
            ],
            'bulan' => [
                'type' => 'INT',
                'constraint' => 100,
                'after' => 'harga'
            ],
            'faktur' => [
                'type' => 'varchar',
                'constraint' => 100,
                'after' => 'media_belajar'
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('harga_table', $fields, false, $attributes);
        $this->forge->addForeignKey('jenis_media_id', 'jenis_media_table', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('jenis_media_id', 'faktur', 'bulan');
    }
}
