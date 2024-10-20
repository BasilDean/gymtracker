<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

it('can list roles', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);
    $permission = Permission::create(['name' => 'view_role', 'title' => ['en' => 'View Role', 'es' => 'Ver Rol']]);
    $role->permissions()->attach($permission);
    $this->actingAs($user);

    $response = $this->get(route('role.index'));

    $response->assertStatus(200)
        ->assertInertia(fn(Assert $page) => $page
            ->component('Roles/Index')
            ->has('roles.data', 1)
        );
});

it('can show create page', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);
    $permission = Permission::create(['name' => 'create_role', 'title' => ['en' => 'Create Role', 'es' => 'Crear Rol']]);
    $role->permissions()->attach($permission);
    Permission::factory()->count(9)->create();
    // auth as user
    $this->actingAs($user);

    $response = $this->get(route('role.create'));


    $response->assertStatus(200)
        ->assertInertia(fn(Assert $page) => $page
            ->component('Roles/Create')->has('permissions.data', 10)
        );
});

it('can create a new role', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);
    $permission = Permission::create(['name' => 'create_role', 'title' => ['en' => 'Create Role', 'es' => 'Crear Rol']]);
    $role->permissions()->attach($permission);
    $permission = Permission::create(['name' => 'view_dashboard', 'title' => ['en' => 'View Dashboard', 'es' => 'Ver Dashboard']]);
    $role->permissions()->attach($permission);

    $permissions = Permission::factory()->count(8)->create();
    // auth as user
    $this->actingAs($user);

    $response = $this->post(route('role.store'), [
        'title' => ['en' => 'New Role', 'es' => 'Nuevo Rol'],
        'permissions' => $permissions->pluck('id')->toArray()
    ]);

    $createdRole = Role::where('name', 'new-role')->firstOrFail();

    $response->assertRedirect(route('role.edit', $createdRole->name))
        ->assertSessionHas('success', 'Role created successfully.');

    $this->assertDatabaseHas('roles', ['name' => 'new-role']);
    $this->assertDatabaseCount('permission_role', 10);
});

it('can open edit form for role', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);

    $permission = Permission::create(['name' => 'view_role', 'title' => ['en' => 'View Role', 'es' => 'Ver Rol']]);
    $role->permissions()->attach($permission);

    $role = Role::create(['name' => 'new-role', 'title' => ['en' => 'New Role', 'es' => 'Nuevo Rol']]);
    $role->permissions()->attach($permission);
    $user->roles()->attach($role);

    $permissions = Permission::factory()->count(9)->create();
    // auth as user
    $this->actingAs($user);

    $response = $this->get(route('role.edit', $role->name));

    $response->assertStatus(200)
        ->assertInertia(fn(Assert $page) => $page
            ->component('Roles/Edit')
            ->has('role', 5)
            ->has('permissions.data', 10)
        );
});

it('can update role', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);

    $permission = Permission::create(['name' => 'update_role', 'title' => ['en' => 'Update Role', 'es' => 'Actualizar Rol']]);
    $role->permissions()->attach($permission);
    $permission = Permission::create(['name' => 'view_dashboard', 'title' => ['en' => 'View Dashboard', 'es' => 'Ver Dashboard']]);
    $role->permissions()->attach($permission);

    $role = Role::create(['name' => 'new-role', 'title' => ['en' => 'New Role', 'es' => 'Nuevo Rol']]);
    $user->roles()->attach($role);

    $permissions = Permission::factory()->count(8)->create();
    // auth as user
    $this->actingAs($user);

    $response = $this->patch(route('role.update', $role->id), [
        'title' => ['en' => 'Updated Role', 'es' => 'Rol Actualizado'],
        'permissions' => $permissions->pluck('id')->toArray()
    ]);

    $response->assertRedirect(route('role.edit', 'updated-role'))
        ->assertSessionHas('success', 'Role updated successfully.');

    $this->assertDatabaseHas('roles', ['name' => 'updated-role']);
    $this->assertDatabaseCount('permission_role', 10);
});

it('can delete role', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $user->roles()->attach($role);

    $permission = Permission::create(['name' => 'delete_role', 'title' => ['en' => 'Delete Role', 'es' => 'Eliminar Rol']]);
    $role->permissions()->attach($permission);
    $permission = Permission::create(['name' => 'view_dashboard', 'title' => ['en' => 'View Dashboard', 'es' => 'Ver Dashboard']]);
    $role->permissions()->attach($permission);

    $role = Role::create(['name' => 'new-role', 'title' => ['en' => 'New Role', 'es' => 'Nuevo Rol']]);

    // auth as user
    $this->actingAs($user);

    $response = $this->delete(route('role.destroy', $role->id));

    $response->assertRedirect(route('role.index'))
        ->assertSessionHas('success', 'Role deleted successfully.');

    $this->assertDatabaseMissing('roles', ['name' => 'new-role']);
});

