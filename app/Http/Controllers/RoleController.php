<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\TranslationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use LaravelIdea\Helper\App\Models\_IH_Permission_C;

class RoleController extends Controller
{
    protected TranslationService $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::paginate(10);
        $roles->getCollection()->transform(function ($role) {
            return $this->translationService->transform($role, 'title');
        });

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'translations_roles' => $this->getTranslations(),
        ]);
    }

    private function getTranslations()
    {
        return Lang::get('roles');
    }

    public function create(): Response
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::paginate(100);
        $permissions->getCollection()->transform(function ($permission) {
            return $this->translationService->transform($permission, 'title');
        });
        return Inertia::render('Roles/Create', [
            'translations_roles' => $this->getTranslations(),
            'permissions' => $permissions
        ]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $this->authorize('create', Role::class);
        $attributes = $request->validated();
        $slug = Str::lower(Str::slug($attributes['title']['en']));
        $role = new Role();
        $role->fill($attributes);
        $role->slug = $slug;
        $role->save();
        $role->permissions()->attach($attributes['permissions']);
        return redirect()->route('role.edit', $role->slug)->with('success', $this->getTranslations()['role_created']);
    }

    public function edit($slug): Response
    {
        $role = $this->findRoleBySlug($slug);
        $this->authorize('view', $role);
        $role->permissionIds = $role->permissions->pluck('id')->toArray();
        $permissions = $this->getTransformedPermissions();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'translations_roles' => $this->getTranslations(),
            'permissions' => $permissions
        ]);
    }

    private function findRoleBySlug($slug): Role
    {
        return Role::select('id', 'slug', 'title')->where('slug', $slug)->firstOrFail();
    }

    private function getTransformedPermissions(): array|LengthAwarePaginator|_IH_Permission_C
    {
        $paginationLimit = 100;
        $permissions = Permission::paginate($paginationLimit);

        $permissions->getCollection()->transform(function ($permission) {
            return $this->translationService->transform($permission, 'title');
        });

        return $permissions;
    }

    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $this->authorize('update', $role);
        $attributes = $request->validated();
        $slug = Str::lower(Str::slug($attributes['title']['en']));

        $role->fill($attributes);
        $role->slug = $slug;
        $role->save();
        $role->permissions()->sync($attributes['permissions']);

        return redirect()->route('role.edit', $role->slug)->with('success', $this->getTranslations()['role_updated']);
    }

    public function destroy($id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('role.index')->with('success', $this->getTranslations()['role_deleted']);
    }
}
