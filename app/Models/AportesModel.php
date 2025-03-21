<?php

namespace App\Models;

use CodeIgniter\Model;

class AportesModel extends Model
{
    protected $table      = 'pagos'; // Nombre de la tabla
    protected $primaryKey = 'id';
    protected $allowedFields = ['nro_comp', 'codigo_beneficiario','fecha', 'nombre_pagador', 'meses_pagados', 'monto']; // Campos permitidos

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
}