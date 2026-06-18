<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    /** Collections shown in the admin, with friendly labels. */
    public const COLLECTIONS = [
        'home-food' => 'Почетна — галерија храна',
        'menia' => 'Мениа — галерија',
        'oprema' => 'Опрема — галерија',
    ];

    public function index(Request $request): Response
    {
        $collection = $request->query('collection', 'home-food');
        if (! array_key_exists($collection, self::COLLECTIONS)) {
            $collection = 'home-food';
        }

        return Inertia::render('Admin/Gallery/Index', [
            'collections' => collect(self::COLLECTIONS)->map(fn ($label, $key) => [
                'key' => $key,
                'label' => $label,
            ])->values(),
            'current' => $collection,
            'images' => GalleryImage::where('collection', $collection)
                ->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'collection' => ['required', 'string', 'in:'.implode(',', array_keys(self::COLLECTIONS))],
            'src' => ['required', 'string', 'max:2048'],
            'alt' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'aspect' => ['nullable', 'string', 'max:20'],
        ]);
        $data['sort_order'] = (int) (GalleryImage::where('collection', $data['collection'])->max('sort_order') + 1);
        $data['is_published'] = true;

        GalleryImage::create($data);

        return back()->with('success', 'Сликата е додадена.');
    }

    public function update(Request $request, GalleryImage $image): RedirectResponse
    {
        $data = $request->validate([
            'src' => ['required', 'string', 'max:2048'],
            'alt' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'aspect' => ['nullable', 'string', 'max:20'],
            'is_published' => ['boolean'],
        ]);

        $image->update($data);

        return back()->with('success', 'Сликата е зачувана.');
    }

    public function destroy(GalleryImage $image): RedirectResponse
    {
        $image->delete();

        return back()->with('success', 'Сликата е избришана.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate(['ids' => ['required', 'array']]);
        foreach ($request->input('ids') as $order => $id) {
            GalleryImage::where('id', $id)->update(['sort_order' => $order]);
        }

        return back();
    }
}
