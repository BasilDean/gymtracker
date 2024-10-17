<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Menu $menu): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Menu $menu): bool
    {
    }

    public function delete(User $user, Menu $menu): bool
    {
    }

    public function restore(User $user, Menu $menu): bool
    {
    }

    public function forceDelete(User $user, Menu $menu): bool
    {
    }
}
