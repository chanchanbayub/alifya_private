<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingPenambahanDataGuru extends Migration
{
    public function up()
    {
        $fields = [
            'pekerjaan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'username_instagram',
            ],
            'pernyataan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'pekerjaan',
            ],
            'kontrak' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'pernyataan',
            ],
            'kendaraan_pribadi' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'kontrak',
            ],
            'media_belajar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'kendaraan_pribadi',
            ],
            'alasan_bergabung' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'media_belajar',
            ],
            'kelebihan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'alasan_bergabung',
            ],
            'info_loker' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'kelebihan',
            ],
            'ijazah' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'  => true,
                'after' => 'info_loker',
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('data_pengajar_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropColumn('data_pengajar_table', 'pekerjaan', 'kontrak', 'pernyataan', 'kendaraan_pribadi', 'media_belajar', 'alasan_bergabung', 'kelebihan', 'info_loker', 'ijazah');
    }
}
