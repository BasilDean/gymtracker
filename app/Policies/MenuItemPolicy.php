<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_menu');
    }

    public function view(User $user, Menu $menu): bool
    {
        return $user->hasPermissionTo('view_menu');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_menu');
    }

    public function update(User $user, Menu $menu): bool
    {
        return $user->hasPermissionTo('update_menu');
    }

    public function delete(User $user, Menu $menu): bool
    {
        return $user->hasPermissionTo('delete_menu');
    }
}
