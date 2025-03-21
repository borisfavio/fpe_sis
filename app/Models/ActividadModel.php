<?php

namespace App\Models;

use CodeIgniter\Model;

class ActividadModel extends Model
{
    protected $table            = 'actividades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'descripcion', 'fecha_creacion', 'estado'];


}
