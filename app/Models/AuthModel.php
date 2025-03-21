<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    // Campos que se pueden insertar o actualizar
    protected $allowedFields = ['email', 'password'];

    public function check_login($username, $password)
    {
        try {
            // Sanitizar y validar los datos de entrada
            $username = esc($username);
            $password = esc($password);

            // Buscar el usuario por nombre de usuario
            $user = $this->where('email', $username)->first();
            //var_dump($user); exit;

            if ($user && password_verify($password, $user['password'])) {
                return $user; // Retorna el usuario si la contraseña es válida
            }

            return null; // Retorna null si no hay coincidencias
        } catch (\Exception $e) {
            // Log del error (opcional)
            log_message('error', 'Error en check_login: ' . $e->getMessage());
            return null;
        }
    }
}