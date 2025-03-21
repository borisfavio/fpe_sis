<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $session;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        helper('url'); 
        $this->session = \Config\Services::session();
    }



    public function index() {
        //var_dump($this->session->get('login')); exit;
        if ($this->session->get('login')) {
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'usuarios/index'; 
            $lib = ['script' => 'mi-script.js'];
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');
            //var_dump($data); exit;*/
            $data = [
                'titulo' => 'FPE - Usuarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuarios' => $this->usuarioModel->findAll(),
                'usuario' => $this->session->get('usuario')
            ];
                return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
       
    }

	public function create() {
        // Lógica para mostrar el formulario de creación
        if ($this->session->get('login')) {
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'usuarios/create_user'; 
            $lib = ['script' => 'mi-script.js'];
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');
            //var_dump($data); exit;*/
            $data = [
                'titulo' => 'FPE - Usuarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuarios' => $this->usuarioModel->findAll(),
                'usuario' => $this->session->get('usuario')
            ];
                return view('templates/estructura', $data);
            
	
        }
    }

    // Guardar un nuevo usuario
    public function guardar()
    {
        $rules = [
            'nombre'  => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email|is_unique[usuarios.email]',
            'password'=> 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre'  => $this->request->getPost('nombre'),
            'email'   => $this->request->getPost('email'),
            'password'=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->usuarioModel->insert($data);
        return redirect()->to('/usuarios')->with('message', 'Usuario creado exitosamente.');
    

    }


}
