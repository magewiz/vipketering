<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Menus/Index', [
            'menus' => Menu::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Menus/Edit', [
            'menu' => new Menu([
                'group' => 'shvedska',
                'group_label' => 'Шведска маса',
                'price_unit' => 'ден.',
                'price_per' => '/ особа',
                'dishes' => [],
                'included' => ['Чинии', 'Чаши (вода, виски, ракија, пиво итн.)', 'Есцајг', 'Чаршафи за маси'],
                'is_published' => true,
            ]),
        ]);
    }

    public function edit(Menu $menu): Response
    {
        return Inertia::render('Admin/Menus/Edit', ['menu' => $menu]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['sort_order'] = (int) (Menu::max('sort_order') + 1);
        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Менито е креирано.');
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $menu->id);
        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Менито е зачувано.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return back()->with('success', 'Менито е избришано.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate(['ids' => ['required', 'array']]);
        foreach ($request->input('ids') as $order => $id) {
            Menu::where('id', $id)->update(['sort_order' => $order]);
        }

        return back();
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'group' => ['required', 'in:shvedska,svecheni'],
            'group_label' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:50'],
            'price_unit' => ['nullable', 'string', 'max:50'],
            'price_per' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:500'],
            'dishes' => ['nullable', 'array'],
            'dishes.*.name' => ['required', 'string', 'max:255'],
            'dishes.*.detail' => ['nullable', 'string', 'max:1000'],
            'included' => ['nullable', 'array'],
            'included.*' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
        ]);

        $data['dishes'] = array_values($data['dishes'] ?? []);
        $data['included'] = array_values(array_filter($data['included'] ?? [], fn ($v) => filled($v)));

        return $data;
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'meni';
        $slug = $base;
        $i = 2;
        while (Menu::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
