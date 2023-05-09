<?php

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('CreatePermissionsTable')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function CreatePermissionsTable($table)
    {

       

        $permissions = Permission::where('group_name', '=', $table)->first();
  
        if($permissions==null){
  
          $roleSuperAdmin = Role::where('name', '=','superadmin')->first();        
  
          $permissions = 
            [
                'group_name' => $table,
                'permissions' => [
                    $table.'_create',
                    $table.'_view',
                    $table.'_edit',
                    $table.'_delete',
                    $table.'_approve',
                ]
                ];
        
                $permissionGroup = $permissions['group_name'];
  
                for ($j = 0; $j < count($permissions['permissions']); $j++) {
  
                  $permission = Permission::create(['name' => $permissions['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                  $roleSuperAdmin->givePermissionTo($permission);
                  $permission->assignRole($roleSuperAdmin);  
  
                }
        }

    }
}
