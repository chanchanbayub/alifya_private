<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table            = 'testimonial_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['link_instagram', 'foto_1', 'foto_2', 'foto_3'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTestimonial()
    {
        return $this->table($this->table)
            ->orderBy('id desc')
            ->get()->getResultObject();
    }
}
