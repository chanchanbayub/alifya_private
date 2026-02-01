<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenambahanDataPesertaDidik extends Migration
{
    public function up()
    {
        $fields = [
            'ketersediaan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'uid_murid'
            ],
            'nama_panggilan_anak' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'nama_lengkap_anak',
                'null' => true,
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'tanggal_lahir_anak',
                'null' => true,
            ],
            'pendidikan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'after' => 'alamat_domisili_anak',
                'null' => true,
                'unsigned' => true
            ],

            'ukuran_baju' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'sekolah_anak',
                'null' => true,
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'info_les',
                'null' => true,
            ],
            'bukti_tf' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'foto_anak',
                'null' => true,
            ],
            'izin_dokumentasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'bukti_tf',
                'null' => true,
            ],
            'tata_tertib' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'izin_dokumentasi',
                'null' => true,
            ],
            'tindak_lanjut' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'tata_tertib',
                'null' => true,
            ],
            'larangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'tindak_lanjut',
                'null' => true,
            ],
            'data_1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'larangan',
                'null' => true,
            ],
            'data_2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'data_1',
                'null' => true,
            ],


        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addForeignKey('pendidikan_id', 'tingkat_pendidikan_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addColumn('data_murid_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_murid_table');
    }
}
