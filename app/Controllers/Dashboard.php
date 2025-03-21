<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;
    public function __construct() {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session(); 
    }

    public function index()
    {
        if ($this->session->get('login')) {

            $datos_menu = ['menu' => 'Inicio']; // Datos para la vista 'templates/main'
            $contenido = 'dashboard'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'Página de inicio',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $this->session->get('usuario'),
            ];

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }
}
