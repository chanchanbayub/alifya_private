<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TestimonialTable extends Migration
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

            'link_instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
            ],
            'foto_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
            ],
            'foto_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
            ],
            'foto_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
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
        $this->forge->createTable('testimonial_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('testimonial_table');
    }
}
