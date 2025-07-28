<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    protected $table      = 'grupos'; // Nombre de la tabla
    protected $primaryKey = 'id';      // Clave primaria

    protected $allowedFields = [
        'nombres', 'id_tutor', 'id_programa', 'status', 'dias', 'created_at', 'updated_at'
    ];// datos que se pueden modificar

    protected $useTimestamps = true; // Usar timestamps (created_at, updated_at)
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_grupos_tutor(int $id)
    {
        return $this->where('id_tutor', $id)->findAll();
    }

    public function grupos_tutor()
    {
        return $this->db->table('grupos')
        ->select('grupos.*, tutores.nombre AS nombre_tutor')
        ->join('tutores', 'tutores.id = grupos.id_tutor')
        ->get()
        ->getResultArray();
    }

    public function ObtenerBeneficiariosTutor($grupo_id)
    {
        // Obtener la instancia de la base de datos
        $db = \Config\Database::connect();

        // Definir la consulta SQL con el procedimiento almacenado
        $sql = "CALL ObtenerBeneficiariosTutor(?)";

        // Ejecutar la consulta con el parámetro
        $result = $db->query($sql, [$grupo_id]);

        // Retornar los resultados como un array asociativo
        return $result->getResultArray();
    }
}




    

