<?php

namespace App\Controllers;

use App\Models\GrupoModel;
use App\Models\PersonasModel;
use Config\Services;

class GruposController extends BaseController
{
    protected $grupoModel;
    protected $session;
    protected $personaModel;
    protected $permisos;
    protected $datos;

	public function __construct() {
        $this->checkSession();
        $this->grupoModel = new GrupoModel();
        $this->personaModel = new PersonasModel();

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

    public function inicio()
    {
        if (!$this->session->get('login')) {
            return redirect()->to('/logout');
        }
        $model = new GrupoModel();
        $data['grupos'] = $model->grupos_tutor();
        //var_dump($data); exit;
        return view('grupos/index', $data);
    }

    public function index() {
        if ($this->session->get('login')) {
            $usuario = $this->session->get('usuario');
            $contenido = 'grupos/grupos'; 
            $lib = ['script' => 'mi-script.js'];
            $grupos = $this->grupoModel->get_grupos_tutor($usuario['id_tutor']);
            //var_dump($grupos); exit;
            $data =$this->datos;
            $data['contenido'] = $contenido;
            $data['lib'] = $lib;
            $data['grupos'] = $grupos;

                return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
           
       
    }


    public function create()
    {
        return view('grupos/form');
    }

    public function store()
    {
        $model = new GrupoModel();
        $model->save([
            'nombres' => $this->request->getPost('nombres'),
            'id_tutor' => $this->request->getPost('id_tutor'),
            'id_programa' => $this->request->getPost('id_programa'),
            'status' => $this->request->getPost('status'),
            'dias' => $this->request->getPost('dias'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
        return redirect()->to('/grupos');
    }

    public function edit($id)
    {
        $model = new GrupoModel();
        $data['grupo'] = $model->find($id);
        return view('grupos/form', $data);
    }

    public function update($id)
    {
        $model = new GrupoModel();
        $model->update($id, [
            'nombres' => $this->request->getPost('nombres'),
            'id_tutor' => $this->request->getPost('id_tutor'),
            'id_programa' => $this->request->getPost('id_programa'),
            'status' => $this->request->getPost('status'),
            'dias' => $this->request->getPost('dias'),
            'updated_at' => date('Y-m-d')
        ]);
        return redirect()->to('/grupos');
    }

    public function delete($id)
    {
        $model = new GrupoModel();
        $model->delete($id);
        return redirect()->to('/grupos');
    }


    public function tutor($grupoid) {
        if ($this->session->get('login')) {
            $contenido = 'grupos/grupos_tutor';
            $lib = ['script' => 'mi-script.js'];
            $personas = $this->grupoModel->ObtenerBeneficiariosTutor($grupoid);
            //var_dump($personas); exit;
            /*
            $data['cantidadN'] = 2;
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
            $data = $this->datos;
            $data['contenido'] = $contenido;
            $data['lib'] = $lib;
            $data['personas'] = $personas;
        
            return view('templates/estructura', $data);
        } else {
            redirect('logout');
        }
       
    }

}