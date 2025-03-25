<?php
namespace App\Controllers;

use App\Models\AsistenciaModel;
use App\Models\GrupoModel;
use App\Models\PersonasModel;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class AsistenciaController extends ResourceController
{
    protected $model ;
    protected $session;
    protected $format    = 'json';
    protected $permisos;
    protected $grupoModel;
    protected $personaModel;

    public function __construct() {
        $this->grupoModel = new GrupoModel();
        $this->personaModel = new PersonasModel();
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->model = new AsistenciaModel();
        $this->session = \Config\Services::session();
        $this->permisos = Services::AutenticarUsuario();
    }

    public function index()
    {
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            $usuario = $this->session->get('usuario');
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'asistencia/asistencia_grupos';
            $lib = ['script' => 'mi-script.js'];
            $usuariosM = $this->permisos->hasPermission($usuarioId,'usuarios');
            //var_dump($usuario['id_empleado']); exit;
            $grupos = $this->grupoModel->get_grupos_tutor($usuario['id_empleado']);
            //var_dump($grupos); exit;
            /*$data['lib'] = 0;
            $data['datos_menu'] = null;
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['personas'] = $this->personaModel->get_persons();
            $data['titulo'] = "Dashboard";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'personas/personas';
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');*/
             // Datos para la vista 'templates/main'
        // Vista dinámica para el contenido
        // Datos para la vista 'templates/footer'

        $data = [
            'titulo' => 'FPE - Asistencia',
            'datos_menu' => $datos_menu,
            'contenido' => $contenido,
            'lib' => $lib,
            'usuario' => $this->session->get('usuario'),
            'usuariosM' => $usuariosM,
            'asistencias' => $this->model->findAll(),
            'grupos' => $grupos,
            'usuario' => $this->session->get('usuario'),
        ];
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function asistenciaGrupos($idG){
        //var_dump($idG); exit;
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            $usuario = $this->session->get('usuario');
            //var_dump($usuario); exit;
            $personas = $this->personaModel->getPersonasGrupo($idG);
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'asistencia/asistencia';
            $lib = ['script' => 'mi-script.js'];
            $usuariosM = $this->permisos->hasPermission($usuarioId,'usuarios');
            //var_dump($usuario['id_empleado']); exit;
            
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            
            $data['titulo'] = "Dashboard";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
           
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');*/
             // Datos para la vista 'templates/main'
        // Vista dinámica para el contenido
        // Datos para la vista 'templates/footer'

        $data = [
            'titulo' => 'FPE - Asistencia',
            'datos_menu' => $datos_menu,
            'contenido' => $contenido,
            'lib' => $lib,
            'usuario' => $this->session->get('usuario'),
            'usuariosM' => $usuariosM,
            'asistencias' => $this->model->findAll(),
            'personas' => $personas,
            'usuario' => $this->session->get('usuario'),
            'idGrupo' => $idG,
        ];
        //var_dump($data); exit;
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('Asistencia no encontrada');
    }

    public function create()
    {
        $data = $this->request->getPost();
        //var_dump($data);
        if ($this->model->insert($data)) {
            return $this->respondCreated($data);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respond($data);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        }
        return $this->failNotFound('Asistencia no encontrada');
    }
}
