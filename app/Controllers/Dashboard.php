<?php

namespace App\Controllers;

use Config\Services;
class Dashboard extends BaseController
{
    protected $session;
protected   $authService;

    public function __construct() {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session();
        
    }

    public function index()
    {
        
        if ($this->session->get('login')) {

            $usuarioId = $this->session->get('usuario')['id'];
            
            $permisos = Services::AutenticarUsuario();
            
            $usuariosM = $permisos->hasPermission($usuarioId,'usuarios');
            

            $usuario = $this->session->get('usuario');
            
            
            $datos_menu = $permisos->getUserPermissions($usuarioId); // Datos para la vista 'templates/main'
            $contenido = 'dashboard'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'FPE - Inicio',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $usuario,
                'usuariosM' => $usuariosM,
            ];

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }
}
