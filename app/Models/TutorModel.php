<?php

namespace App\Models;

use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $table            = 'tutores';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombre', 'state'];

    public function getTutoresActivos()
    {
        return $this->where('state', 1)->findAll(); // Filtra solo los activos
    }
}
