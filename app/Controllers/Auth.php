<?php

namespace App\Controllers;

use App\Models\AuthModel; // Namespace corregido
use CodeIgniter\Controller;

class Auth extends BaseController {

    protected $session;
    protected $authModel;

    public function __construct() {
        helper(['form', 'url']);
        $this->session = \Config\Services::session(); // Inicializar la sesión
        $this->authModel = new AuthModel(); // Inicializar el modelo
    }

    public function login() {
        // Cargar la vista de inicio de sesión
        return view('login');
    }

    public function do_login() {
        // Procesar el formulario de inicio de sesión
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Verificar las credenciales
        $user = $this->authModel->check_login($username, $password);
        
        if ($user) {
            // Iniciar sesión
            $this->session->set('username', $username);
            $this->session->set('login', true);
            $this->session->set('usuario', $user);

            // Redirigir al dashboard
            return redirect()->to('/dashboard');
        } else {
            // Mostrar mensaje de error
            $data['error'] = 'Nombre de usuario o contraseña incorrectos';
            return view('login', $data);
        }
    }

    public function logout() {
        // Destruir la sesión
        $this->session->destroy();
        return redirect()->to('/login'); // Redirigir al login
    }
}