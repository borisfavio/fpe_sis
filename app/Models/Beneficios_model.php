<?php
namespace App\Models;

use CodeIgniter\Model;


class Beneficios_model extends Model 
{
    protected $table      = 'regalos'; // Nombre de la tabla
    protected $primaryKey = 'id';      // Clave primaria

    protected $allowedFields = ['cod_ben', 'descripcion', 'fecha_entrega', 'act_id', 'ruta_foto']; // Campos que se pueden insertar o actualizar



    public function insert_person($data) {
        $this->db->insert('beneficiarios', $data);
        return $this->db->insert_id();
    }

    public function get_beneficio_by_id($id) {
        $query = $this->db->get_where('actividades', array('id' => $id));
        return $query->row();
    }

    public function get_person_by_cod($cod) {
        $query = $this->db->get_where('beneficiarios', array('codigo' => $cod));
        return $query->row();
    }

    public function update_person($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('beneficiarios', $data);
    }

    public function delete_person($id) {
        $this->db->where('id', $id);
        $this->db->delete('personas');
    }
}