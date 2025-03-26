<?php

namespace App\Models;

use CodeIgniter\Model;

class AportesModel extends Model
{
    protected $table      = 'pagos'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $allowedFields = ['nro_comp', 'codigo_beneficiario','fecha', 'nombre_pagador', 'meses_pagados', 'monto','meses']; // Campos permitidos

    // Método para obtener el último número de comprobante
    public function getLastNumComp()
    {
        return $this->select('nro_comp')
                    ->orderBy('nro_comp', 'DESC')
                    ->first(); // Obtiene el último registro
    }

    public function buscarCodigo($nro_comp)
    {
        return $this->where('nro_comp', $nro_comp)->findAll();
        
    }

    public function listarComprobantes()
    {
        $db = db_connect();
        $builder = $db->table('pagos');
    
        return $builder
            ->select('nro_comp, MIN(fecha) as fecha, MIN(nombre_pagador) as nombre_pagador, GROUP_CONCAT(DISTINCT codigo_beneficiario SEPARATOR ", ") as codigo_beneficiario, SUM(meses_pagados) as totalM, SUM(monto) as total')
            ->groupBy('nro_comp')
            ->orderBy('nro_comp')
            ->get()
            ->getResultArray(); // Devuelve solo el array, sin setJSON
    }
    
}