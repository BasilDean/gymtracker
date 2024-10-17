<?php


use App\Models\Permission;
use App\Models\Role;

it('can be assigned to a role', function () {
    $role = Role::factory()->create();
    $permission = Permission::factory()->create();

    $role->permissions()->attach($permission);

    expect($permission->roles->first()->name)->toBe($role->name);
});

it('has translations', function () {
    $permission = Permission::factory()->create();

    expect($permission->getTranslatedTitleAttribute())->toBeString();
});
