<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, MenuItem $menuItem): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, MenuItem $menuItem): bool
    {
    }

    public function delete(User $user, MenuItem $menuItem): bool
    {
    }

    public function restore(User $user, MenuItem $menuItem): bool
    {
    }

    public function forceDelete(User $user, MenuItem $menuItem): bool
    {
    }
}
