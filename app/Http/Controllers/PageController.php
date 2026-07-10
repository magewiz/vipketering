<?php

namespace App\Http\Controllers;

use App\Models\EquipmentItem;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\Page;
use App\Support\ImageOptimizer;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('Home', [
            'page' => $this->page('home'),
            'gallery' => $this->gallery('home-food'),
        ]);
    }

    public function about(): Response
    {
        return Inertia::render('About', [
            'page' => $this->page('about'),
        ]);
    }

    public function menia(): Response
    {
        return Inertia::render('Menia', [
            'page' => $this->page('menia'),
            'menus' => Menu::where('is_published', true)
                ->orderBy('sort_order')->get()
                ->groupBy('group'),
            'gallery' => $this->gallery('menia'),
        ]);
    }

    public function oprema(): Response
    {
        return Inertia::render('Oprema', [
            'page' => $this->page('oprema'),
            'equipment' => EquipmentItem::where('is_published', true)
                ->orderBy('sort_order')->get(),
            'gallery' => $this->gallery('oprema'),
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Contact', [
            'page' => $this->page('contact'),
        ]);
    }

    private function page(string $slug): Page
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        // Offer the mobile "@960" hero variant via srcset when it exists on
        // disk (images:optimize / upload generates it for wide images).
        $content = $page->content;
        if ($srcset = ImageOptimizer::srcset($content['hero']['image'] ?? null)) {
            $content['hero']['image_srcset'] = $srcset;
            $page->content = $content;
        }

        return $page;
    }

    private function gallery(string $collection)
    {
        return GalleryImage::where('collection', $collection)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get(['src', 'alt', 'caption', 'aspect']);
    }
}
