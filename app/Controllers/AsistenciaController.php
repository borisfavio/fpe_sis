<?php
namespace App\Controllers;

use App\Models\AsistenciaModel;
use App\Models\GrupoModel;
use App\Models\PersonasModel;
use App\Models\TutorModel;
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
    protected $tutorModel;

    public function __construct() {
        $this->grupoModel = new GrupoModel();
        $this->tutorModel = new TutorModel();
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->model = new AsistenciaModel();
        $this->session = \Config\Services::session();
        $this->permisos = Services::AutenticarUsuario();
        $this->personaModel = new PersonasModel();
    }

    public function index()
    {
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            $usuario = $this->session->get('usuario');
            $datos_menu = $this->permisos->getUserPermissions($usuarioId);
            $contenido = 'asistencia/asistencia_grupos';
            $lib = ['script' => 'mi-script.js'];
            $usuariosM = $this->permisos->hasPermission($usuarioId,'usuarios');
             $grupos = $this->grupoModel->get_grupos_tutor($usuario['id_tutor']);
            
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
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
        //var_dump($data); exit;
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function tutor($id)
    {
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            
            $usuario = $this->session->get('usuario');
            $datos_menu = $this->permisos->getUserPermissions($usuarioId);
            $contenido = 'asistencia/asistencia_grupos_tutor';
            $lib = ['script' => 'mi-script.js'];
            $usuariosM = $this->permisos->hasPermission($usuarioId,'usuarios');
            //var_dump($this->grupoModel); exit;
            $grupos = $this->grupoModel->get_grupos_tutor($id);
            //var_dump($grupos); exit;
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
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
        //var_dump($data['grupos']); exit;
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
            //var_dump($this->personaModel); exit;
            $datos_menu = $this->permisos->getUserPermissions($usuarioId);
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
            'alumnos' => $personas,
            'usuario' => $this->session->get('usuario'),
            'idGrupo' => $idG,
            'fecha_actual' => date('Y-m-d')
        ];
        //var_dump($data); exit;
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function asistenciaGruposTutor(){
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            $usuario = $this->session->get('usuario');
            //var_dump($this->tutorModel); exit;
            $personas = $this->tutorModel->getTutoresActivos();
            //var_dump($personas); exit;
            $datos_menu = $this->permisos->getUserPermissions($usuarioId);
            $contenido = 'asistencia/asistencia_tutores';
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
            
            'fecha_actual' => date('Y-m-d')
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

    public function registrar()
    {
        $model = new AsistenciaModel();
        $alumnoModel = new PersonasModel();
        
        $fecha = $this->request->getPost('fecha');
        $alumnos = $alumnoModel->where('group_id', $this->request->getPost('grupo_id'))->findAll();
        
        //var_dump($alumnos); exit;
        foreach ($alumnos as $alumno) {
            $estado = $this->request->getPost('asistencia_'.$alumno['id']) ?? 'ausente';
            
            $data = [
                'beneficiario_id' => $alumno['id'],
                'fecha' => $fecha,
                'estado' => $estado,
                'observaciones' => $this->request->getPost('observacion_'.$alumno['id'])
            ];
            

            // Verificar si ya existe registro para evitar duplicados
            $existe = $model->where('beneficiario_id', $alumno['id'])
                          ->where('fecha', $fecha)
                          ->first();
                          //var_dump($existe); exit;
            if ($existe) {
                $model->update($existe['id'], $data);
            } else {
                $model->registrarAsistencia($data);
            }
        }
        
        return redirect()->to('/asistencia')->with('success', 'Asistencias registradas correctamente');
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
