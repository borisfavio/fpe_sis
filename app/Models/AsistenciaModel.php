<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $table      = 'asistencias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['beneficiario_id', 'fecha', 'estado', 'observaciones', 'grupo_id'];
    protected $useTimestamps = false;

    //regsitrar asistencia
    public function registrarAsistencia($data)
    {
        return $this->insert($data);
    }
    //obtener asistencia por fecha
    public function obtenerAsistenciasPorFecha($fecha)
    {
        return $this->select('asistencias.*, alumnos.nombre, alumnos.matricula, alumnos.grupo')
                    ->join('alumnos', 'alumnos.id = asistencias.alumno_id')
                    ->where('fecha', $fecha)
                    ->findAll();
    }
}
