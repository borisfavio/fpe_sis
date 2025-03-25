<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use Config\Services;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $session;
    protected $permisos;
    protected $datos;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session();
        $this->permisos = Services::AutenticarUsuario();
        //cargar datos
        $this->datos = [
            'titulo' => 'FPE - Usuarios',
            'datos_menu' => $this->permisos->getUserPermissions($this->session->get('usuario')['id']),
            'usuario' => $this->session->get('usuario'),
        ];
    }



    public function index() {
        //var_dump($this->session->get('login')); exit;
        if ($this->session->get('login')) {
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
            $data = $this->datos;
            $data['contenido'] = $contenido;
            $data['lib'] = $lib;
            $data['usuarios'] = $this->usuarioModel->findAll();
                return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
       
    }

	public function create() {
        // Lógica para mostrar el formulario de creación
        if ($this->session->get('login')) {
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
            $data = $this->datos;
            $data['contenido'] = $contenido;
            $data['lib'] = $lib;

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
