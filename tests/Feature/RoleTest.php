<?php


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

it('can create a role', function () {
    $role = Role::factory()->create();

    expect($role->slug)->toBeString();
});

it('can be attached to a user', function () {
    $role = Role::factory()->create();

    $user = User::factory()->create();

    $user->roles()->attach($role);

    expect($user->roles->first()->slug)->toBe($role->slug)
        ->and($role->hasPermissionTo('some_permission'))->toBeBool();
});

it('can have permissions', function () {
    $role = Role::factory()->create();
    $permission = Permission::factory()->create();

    $role->permissions()->attach($permission);

    expect($role->permissions->first()->slug)->toBeString();
});


it('can have permissions to.. ', function () {
    $role = Role::factory()->create();
    $permission = Permission::factory()->create();

    $role->permissions()->attach($permission);

    expect($role->hasPermissionTo($permission))->toBeTrue()
        ->and($role->hasPermissionTo($permission->slug))->toBeTrue()
        ->and($role->hasPermissionTo('some_permission'))->toBeFalse();
});

it('belongs to users', function () {
    $role = Role::factory()->create();
    $user = User::factory()->create();

    $user->roles()->attach($role);
    $attachedUser = $role->users->first();

    expect($attachedUser)->not->toBeNull()
        ->and($attachedUser->slug)->toBe($user->slug);
});
