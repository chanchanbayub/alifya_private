<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesertaDidikAhl extends Migration
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
            'ketersediaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            // Data Orang Tua
            'nama_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pekerjaan_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pekerjaan_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'usersname_instagram' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nomor_whatsapp_orang_tua' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat_domisili_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            // Data Murid
            'nama_lengkap_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_panggilan_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_lahir_anak' => [
                'type'       => 'date',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sekolah_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ukuran_baju' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            // 
            'program_belajar_ahl_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'foto_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'bukti_tf' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'izin_dokumentasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'info_alifya' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'data_1' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'data_2' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'status_peserta_id' => [
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
        $this->forge->addForeignKey('program_belajar_ahl_id', 'program_ahl_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_peserta_id', 'status_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peserta_didik_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('peserta_didik_ahl_table');
    }
}
