<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $table      = 'asistencia';
    protected $primaryKey = 'id';
    protected $allowedFields = ['estado', 'fecha', 'beneficiario_id', 'grupo_id'];
    protected $useTimestamps = false;
}
