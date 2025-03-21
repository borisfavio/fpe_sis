<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios'; // Nombre de la tabla
    protected $primaryKey = 'id';      // Clave primaria

    protected $allowedFields = ['nombre', 'email', 'password']; // Campos que se pueden insertar o actualizar

    protected $useTimestamps = true; // Usar timestamps (created_at, updated_at)
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}