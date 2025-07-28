<?php
namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table = 'beneficiarios'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    /*protected $allowedFields = ['Local_id','account_name','gender','birthdate','caregiver_birthdate','phone','estado','nombres', 'codigo', 'edad','primary_caregiver','religious_affiliation','street', 'group_id'];*/ // Campos permitidos para inserción/actualización
    protected $allowedFields = ['phone','estado','nombres', 'codigo']; // Campos permitidos para inserción/actualización



    public function getPersons()
    {
        return $this->findAll(); // Retorna todos los registros de la tabla
    }

    public function insertPerson($data)
    {
        return $this->insert($data); // Inserta un registro y devuelve el ID
    }

    public function getPersonById($id)
    {
        return $this->find($id); // Busca un registro por su ID
    }

    public function getPersonByCod($cod)
    {
        // Validar el código (opcional, pero recomendado)
        if (empty($cod)) {
            return null; // O lanzar una excepción
        }
        //otra opcion
        return $this->where('codigo', $cod)->first(); // Devuelve un solo registro
        
        
        // Usar el Query Builder de CI4
        /*$builder = $this->db->table('beneficiarios');
        $builder->where('codigo', $cod);
        $query = $builder->get();

        // Devolver un solo registro (asumiendo que 'codigo' es único)
        return $query->getRow();*/
    }

    public function getPersonasTutor($tutor_id)
    {
        $sql = "CALL ObtenerBeneficiariosPorTutor(?)";
        return $this->db->query($sql, [$tutor_id])->getResultArray(); // Ejecutar procedimiento almacenado
    }
    
    public function getPersonasGrupo($grupo_id)
    {
        if (empty($grupo_id)) {
            return null; // O lanzar una excepción
        }
        //otra opcion
        //var_dump($grupo_id);
        //$pers = $this->where('grupo_id', $grupo_id)->findAll();
        //var_dump($pers); exit; 
        return $this->where('grupo_id', $grupo_id)->findAll(); // Ejecutar procedimiento almacenado
    }

    public function updatePerson($id, $data)
    {   
        var_dump($data); exit;
        return $this->update($id, $data); // Actualiza el registro con el ID dado
    }

    public function deletePerson($id)
    {
        return $this->delete($id); // Elimina el registro con el ID dado
    }
}
