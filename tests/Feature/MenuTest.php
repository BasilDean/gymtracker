<?php


use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Lang;

uses(RefreshDatabase::class);


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->role = Role::create(['slug' => 'admin', 'title' => ['en' => 'Admin', 'es' => 'Administrador']]);
    $this->user->roles()->attach($this->role->id);
    $this->permissionToViewDashboard = Permission::create(['slug' => 'view_dashboard', 'title' => ['en' => 'View Dashboard', 'es' => 'Ver Panel']]);
    $this->role->permissions()->attach($this->permissionToViewDashboard->id);
    $this->permissionToViewMenus = Permission::create(['slug' => 'view_menu', 'title' => ['en' => 'View Menus', 'es' => 'Ver Menús']]);
    $this->permissionToCreateMenus = Permission::create(['slug' => 'create_menu', 'title' => ['en' => 'Create Menus', 'es' => 'Crear Menús']]);
    $this->permissionToUpdateMenus = Permission::create(['slug' => 'update_menu', 'title' => ['en' => 'Update Menus', 'es' => 'Actualizar Menús']]);
    $this->permissionToDeleteMenus = Permission::create(['slug' => 'delete_menu', 'title' => ['en' => 'Delete Menus', 'es' => 'Eliminar Menús']]);
    $this->translations = Lang::get('menus');
});

it('can restrict access to see menus without permission', function () {
    $this->actingAs($this->user)
        ->get(route('menu.index'))
        ->assertStatus(403);
});

it('can restrict access to create menus', function () {
    $this->actingAs($this->user)
        ->get(route('menu.create'))
        ->assertStatus(403);
});

it('can restrict access to edit menu', function () {
    $this->actingAs($this->user);
    $menu = Menu::factory()->create();
    $this->get(route('menu.edit', $menu->slug), [])
        ->assertStatus(403);
});

it('can restrict access to update menu', function () {
    $this->actingAs($this->user);
    Menu::factory()->create();

    $this->patch(route('menu.update', 1), [
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header'
    ])
        ->assertStatus(403);
});

it('can restrict access to delete menu', function () {
    Menu::factory()->create();
    $this->actingAs($this->user)
        ->delete(route('menu.destroy', 1))
        ->assertStatus(403);
});

it('can allow access to see menus', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToViewMenus->id);
    $this->actingAs($this->user)
        ->get(route('menu.index'))
        ->assertStatus(200);
});

it('can create menu', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user)
        ->get(route('menu.create'))
        ->assertStatus(200);
});

it('can store a menu', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header'
    ]);
    $createdMenu = Menu::where('slug', 'home')->firstOrFail();
    $response->assertRedirect(route('menu.edit', $createdMenu->slug))
        ->assertSessionHas('success', $this->translations['menu_created']);
    $this->assertDatabaseHas('menus', ['slug' => 'home']);
});

it('can edit menu', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToUpdateMenus->id);
    $menu = Menu::factory()->create();
    $this->actingAs($this->user)
        ->get(route('menu.edit', $menu->slug))
        ->assertStatus(200);
});

it('can update menu', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToUpdateMenus->id);
    $menu = Menu::factory()->create();
    $this->actingAs($this->user);
    $response = $this->patch(route('menu.update', $menu->id), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header'
    ]);
    $response->assertRedirect(route('menu.edit', 'home'))
        ->assertSessionHas('success', $this->translations['menu_updated']);
    $this->assertDatabaseHas('menus', ['slug' => 'home']);
});

it('can delete menu', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToDeleteMenus->id);
    $menu = Menu::factory()->create();
    $this->actingAs($this->user);
    $response = $this->delete(route('menu.destroy', $menu->id));
    $response->assertRedirect(route('menu.index'))
        ->assertSessionHas('success', $this->translations['menu_deleted']);
    $this->assertDatabaseMissing('menus', ['slug' => $menu->slug]);
});

it('required to have title.en', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header'
    ]);
    $response->assertSessionHasErrors('title.en');
});

it('required to have title', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'type' => 'private',
        'placement' => 'header'
    ]);
    $response->assertSessionHasErrors('title');
});
it('required to have type', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'placement' => 'header'
    ]);
    $response->assertSessionHasErrors('type');
});
it('required to have placement', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private'
    ]);
    $response->assertSessionHasErrors('placement');
});

it('title can be translated', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header'
    ]);
    $createdMenu = Menu::where('slug', 'home')->firstOrFail();
    $titles = ($createdMenu->title);
    $this->assertEquals('Home', $createdMenu->title);
    app()->setLocale('es');
    $this->assertEquals('Inicio', $createdMenu->title);
});

it('can have sort order', function () {
    $this->user->roles->first()->permissions()->attach($this->permissionToCreateMenus->id);
    $this->actingAs($this->user);
    $response = $this->post(route('menu.store'), [
        'slug' => 'home',
        'title' => ['en' => 'Home', 'es' => 'Inicio'],
        'type' => 'private',
        'placement' => 'header',
        'order' => 1
    ]);
    $createdMenu = Menu::where('slug', 'home')->firstOrFail();
    $this->assertEquals(1, $createdMenu->order);
});
