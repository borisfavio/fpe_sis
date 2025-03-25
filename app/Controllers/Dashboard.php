<?php

namespace App\Controllers;

use Config\Services;
class Dashboard extends BaseController
{
    protected $session;
    protected   $authService;
    protected $permisos;
    protected $datos;

    public function __construct() {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session();
        $this->permisos = Services::AutenticarUsuario();
        //cargar datos
        $this->datos = [
            'titulo' => 'FPE - Inicio',
            'datos_menu' => $this->permisos->getUserPermissions($this->session->get('usuario')['id']),
            'usuario' => $this->session->get('usuario'),
        ];

    }

    public function index()
    {
       // var_dump($this->session->get('login')); exit;
        if ($this->session->get('login')) {
            $contenido = 'dashboard'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'
            //cargar datso por modulo
            $data = $this->datos;
            $data['contenido'] =$contenido;
            $data['lib'] = $lib;
            //var_dump($data['datos_menu']); exit;
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }
}
