<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KonfirmasiKehadiran extends Migration
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

            'mitra_pengajar_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'peserta_didik_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'bulan_invoice' => [
                'type'           => 'varchar',
                'constraint'     => 11,
            ],
            'tahun_invoice' => [
                'type'           => 'varchar',
                'constraint'     => 11,
            ],
            'jumlah_kehadiran' => [
                'type'           => 'varchar',
                'constraint'     => 11,
            ],
            'status_invoice_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('peserta_didik_id', 'data_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mitra_pengajar_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_invoice_id', 'status_invoice_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('konfirmasi_invoice_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('konfirmasi_invoice_table');
    }
}
