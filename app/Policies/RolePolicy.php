<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Allow viewing any role if the user has the 'view_any_role' permission
        return $user->role->permissions->contains('name', 'view_any_role');
    }

    public function view(User $user, Role $role): bool
    {
        // Allow viewing a specific role if the user has the 'view_role' permission
        return $user->role->permissions->contains('name', 'view_role');
    }

    public function create(User $user): bool
    {
        // Allow creating a role if the user has the 'create_role' permission
        return $user->role->permissions->contains('name', 'create_role');
    }

    public function update(User $user, Role $role): bool
    {
        // Allow updating a role if the user has the 'update_role' permission
        return $user->role->permissions->contains('name', 'update_role');
    }

    public function delete(User $user, Role $role): bool
    {
        // Allow deleting a role if the user has the 'delete_role' permission
        return $user->role->permissions->contains('name', 'delete_role');
    }
}
