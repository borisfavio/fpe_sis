<?php

namespace App\Services;

class CodigoGeneratorService
{
    public function generarCodigo($longitud = 8)
    {
        return strtoupper(bin2hex(random_bytes($longitud / 2)));
    }
}
?>
