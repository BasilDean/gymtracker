<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Services\TranslationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{

    protected TranslationService $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Menu::class);
        $menus = Menu::paginate(10);

        $menus->getCollection()->transform(function ($menu) {
            return $this->translationService->transform($menu, 'title');
        });

        return Inertia::render('Menu/Index', ['menus' => $menus, 'translations_menus' => $this->getTranslations()]);
    }

    private function getTranslations()
    {
        return Lang::get('menus');
    }

    public function create(): Response
    {
        $this->authorize('create', Menu::class);
        return Inertia::render('Menu/Create', ['translations_menus' => $this->getTranslations(), 'menu_placements' => config('menu_placements')]);
    }

    public function store(MenuRequest $request): RedirectResponse
    {
        $this->authorize('create', Menu::class);
        $attribute = $request->validated();
        $slug = Str::lower(Str::slug($attribute['title']['en']));
        $menu = new Menu();
        $menu->fill($attribute);
        $menu->slug = $slug;
        $menu->order = $menu->order ?? 500;
        $menu->save();
        return redirect()->route('menu.edit', $menu->slug)->with('success', $this->getTranslations()['item_created']);
    }

    public function edit($slug): Response
    {
        $menu = Menu::where('slug', $slug)->with(['menuItems' => function ($query) {
            $query->orderBy('order')->orderBy('id');
        }])->firstOrFail();
        $this->authorize('update', $menu);


        $menuItems = $menu->menuItems->transform(function ($menuItem) {
            return $this->translationService->transform($menuItem, 'title');
        });
        return Inertia::render('Menu/Edit', ['menu' => $menu, 'translations_menus' => $this->getTranslations(), 'menu_placements' => config('menu_placements')]);
    }

    public function update(MenuRequest $request, $id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);
        $this->authorize('update', $menu);
        $attributes = $request->validated();
        $slug = Str::lower(Str::slug($attributes['title']['en']));
        $menu->fill($attributes);
        $menu->slug = $slug;
        $menu->order = $menu->order ?? 500;
        $menu->save();
        return redirect()->route('menu.edit', $menu->slug)->with('success', $this->getTranslations()['item_updated']);
    }

    public function destroy($id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);
        $this->authorize('delete', $menu);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', $this->getTranslations()['item_deleted']);
    }
}
