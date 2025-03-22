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
}

?>