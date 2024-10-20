<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    public function index(): Response
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::paginate(10);
        $roles->getCollection()->transform(function ($role) {
            $localeTitle = $role->getTranslation('title', app()->getLocale());
            $role->locale_title = $localeTitle;

            return $role;
        });

        $translations = $this->getTranslations();

        return Inertia::render('Roles/Index', ['roles' => $roles, 'translations_roles' => $translations]);
    }

    private function getTranslations()
    {
        return Lang::get('roles');
    }

    public function create(): Response
    {
        $this->authorize('create', Role::class);
        $translations = $this->getTranslations();
        $permissions = Permission::paginate(100);
        $permissions->getCollection()->transform(function ($permission) {
            $localeTitle = $permission->getTranslation('title', app()->getLocale());
            $permission->locale_title = $localeTitle;

            return $permission;
        });
        return Inertia::render('Roles/Create', ['translations_roles' => $translations, 'permissions' => $permissions]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $this->authorize('create', Role::class);
        $attributes = $request->validated();
        $name = Str::lower(Str::slug($attributes['title']['en']));
        $role = new Role();
        $role->fill($attributes);
        $role->name = $name;
        $role->save();
        $role->permissions()->attach($attributes['permissions']);
        $translations = $this->getTranslations();
        return redirect()->route('role.edit', $role->name)->with('success', $translations['role_created']);
    }

    public function edit($name): Response
    {
        $role = Role::select('id', 'name', 'title')->where('name', $name)->firstOrFail();
        $this->authorize('view', $role);
        $role->permissionIds = $role->permissions->pluck('id');
        $permissions = Permission::paginate(100);
        $permissions->getCollection()->transform(function ($permission) {
            $localeTitle = $permission->getTranslation('title', app()->getLocale());
            $permission->locale_title = $localeTitle;
            return $permission;
        });

        $translations = $this->getTranslations();

        return Inertia::render('Roles/Edit', ['role' => $role, 'translations_roles' => $translations, 'permissions' => $permissions]);

    }

    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $this->authorize('update', $role);
        $attributes = $request->validated();
        $name = Str::lower(Str::slug($attributes['title']['en']));

        $role->fill($attributes);
        $role->name = $name;
        $role->save();
        $role->permissions()->sync($attributes['permissions']);

        $translations = $this->getTranslations();
        return redirect()->route('role.edit', $role->name)->with('success', $translations['role_updated']);
    }

    public function destroy($id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete', $role);
        $role->delete();
        $translations = $this->getTranslations();
        return redirect()->route('role.index')->with('success', $translations['role_deleted']);
    }
}
