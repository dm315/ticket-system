<?php

namespace App\Traits\Permissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


trait HasPermissionsTrait
{

    // Relations::
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')->where('status', 1);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user')->where('status', 1);
    }

//    -------------------------------------------------------------------------------------------


    // Methods::
    public function hasPermission($permission): bool
    {
        return (bool)$this->permissions->where('title', $permission)->count();
    }

    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission): bool
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('title', $role))
                return true;
        }
        return false;
    }

}
