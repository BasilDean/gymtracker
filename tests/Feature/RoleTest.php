<?php


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

it('can create a role', function () {
    $role = Role::factory()->create();

    expect($role->name)->toBeString()
        ->and(json_encode($role->title, JSON_THROW_ON_ERROR))->toBeJson()
        ->and($role->getTranslatedTitleAttribute())->toBeString();
});

it('can be attached to a user', function () {
    $role = Role::factory()->create();

    $user = User::factory()->create();

    $user->roles()->attach($role);

    expect($user->roles->first()->name)->toBe($role->name)
        ->and($role->hasPermissionTo('some_permission'))->toBeBool();
});

it('can have permissions', function () {
    $role = Role::factory()->create();
    $permission = Permission::factory()->create();

    $role->permissions()->attach($permission);

    expect($role->permissions->first()->name)->toBeString();
});


it('can have permissions to.. ', function () {
    $role = Role::factory()->create();
    $permission = Permission::factory()->create();

    $role->permissions()->attach($permission);

    expect($role->hasPermissionTo($permission))->toBeTrue()
        ->and($role->hasPermissionTo($permission->name))->toBeTrue()
        ->and($role->hasPermissionTo('some_permission'))->toBeFalse();
});

it('belongs to users', function () {
    $role = Role::factory()->create();
    $user = User::factory()->create();

    $user->roles()->attach($role);
    $attachedUser = $role->users->first();

    expect($attachedUser)->not->toBeNull()
        ->and($attachedUser->name)->toBe($user->name);
});
