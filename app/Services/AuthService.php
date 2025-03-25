<?php

namespace App\Services;

use App\Models\UsuarioModel;
use App\Models\RolePermissionModel;

class AuthService {
    protected $userModel;
    protected $rolePermissionModel;
    
    public function __construct() {
        $this->userModel = new UsuarioModel();
        $this->rolePermissionModel = new RolePermissionModel();
    }

    public function hasPermission($userId, $permissionName) {
        
        $user = $this->userModel->find($userId);
        
        if (!$user) return false;
        
        $permissions = $this->rolePermissionModel->where('role_id', $user['rol_id'])->findAll();
        
        $permissionIds = array_column($permissions, 'permission_id');
        
        $permissionModel = new \App\Models\PermissionModel();
        $permission = $permissionModel->where('name', $permissionName)->first();
        
        return in_array($permission['id'], $permissionIds);
    }

    //funcion que devuelve datos de menu
    public function getUserPermissions($userId)
{
    $user = $this->userModel->find($userId);

    if (!$user) {
        return [];
    }

    // Obtener los permisos del rol del usuario
    $permissions = $this->rolePermissionModel->where('role_id', $user['rol_id'])->findAll();
    $permissionIds = array_column($permissions, 'permission_id');

    // Obtener los nombres de los permisos
    $permissionModel = new \App\Models\PermissionModel();
    $permissionList = $permissionModel->whereIn('id', $permissionIds)->findAll();

    // Formatear el resultado como array asociativo
    $permissionsArray = [];
    foreach ($permissionList as $perm) {
        $permissionsArray[$perm['name']] = true;
    }

    // Lista completa de módulos con acceso predeterminado en `false`
    $allModules = ['inicio', 'usuarios', 'asistencia','aportes', 'reportes', 'configuracion'];
    
    // Generar el array final con `false` por defecto
    $datos_menu = array_fill_keys($allModules, false);
    
    // Activar los permisos obtenidos del usuario
    foreach ($permissionsArray as $module => $hasAccess) {
        if (array_key_exists($module, $datos_menu)) {
            $datos_menu[$module] = $hasAccess;
        }
    }

    return $datos_menu;
}

}

?>