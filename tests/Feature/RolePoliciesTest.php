<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


it('can restrict access to see roles', function () {
    $this->actingAs($this->user)
        ->get(route('role.index'))
        ->assertStatus(403);
});

it('can restrict access to create roles', function () {
    $this->actingAs($this->user)
        ->get(route('role.create'))
        ->assertStatus(403);
});

it('can restrict access to store roles', function () {
    $this->actingAs($this->user)
        ->post(route('role.store'), [])
        ->assertStatus(403);
});

it('can restrict access to edit roles', function () {
    $role = Role::create(['slug' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $this->actingAs($this->user)
        ->get(route('role.edit', $role->slug))
        ->assertStatus(403);
});

it('can restrict access to update roles', function () {
    $role = Role::create(['slug' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $this->actingAs($this->user)
        ->patch(route('role.update', $role->id), [])
        ->assertStatus(403);
});

it('can restrict access to destroy roles', function () {
    $role = Role::create(['slug' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $this->actingAs($this->user)
        ->delete(route('role.destroy', $role->id))
        ->assertStatus(403);
});

