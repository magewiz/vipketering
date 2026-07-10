<?php

namespace App\Http\Controllers;

use App\Models\EquipmentItem;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Support\ImageOptimizer;
use App\Support\StructuredData;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        $page = $this->page('home');

        return $this->withSeo(Inertia::render('Home', [
            'page' => $page,
            'gallery' => $this->gallery('home-food'),
        ]), $page, breadcrumbs: false);
    }

    public function about(): Response
    {
        $page = $this->page('about');

        return $this->withSeo(Inertia::render('About', [
            'page' => $page,
        ]), $page);
    }

    public function menia(): Response
    {
        $page = $this->page('menia');
        $menus = Menu::where('is_published', true)
            ->orderBy('sort_order')->get();

        return $this->withSeo(Inertia::render('Menia', [
            'page' => $page,
            'menus' => $menus->groupBy('group'),
            'gallery' => $this->gallery('menia'),
        ]), $page, [
            StructuredData::menuList(
                $menus,
                route('menia'),
                data_get($page->content, 'hero.image') ?: SiteSetting::current()->logo,
            ),
        ]);
    }

    public function oprema(): Response
    {
        $page = $this->page('oprema');

        return $this->withSeo(Inertia::render('Oprema', [
            'page' => $page,
            'equipment' => EquipmentItem::where('is_published', true)
                ->orderBy('sort_order')->get(),
            'gallery' => $this->gallery('oprema'),
        ]), $page);
    }

    public function contact(): Response
    {
        $page = $this->page('contact');

        return $this->withSeo(Inertia::render('Contact', [
            'page' => $page,
        ]), $page);
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

    /**
     * Attach the SEO view data (meta description + JSON-LD blocks) that
     * app.blade.php renders on full page loads.
     */
    private function withSeo(Response $response, Page $page, array $extraSchemas = [], bool $breadcrumbs = true): Response
    {
        $jsonLd = [StructuredData::business(SiteSetting::current())];

        if ($breadcrumbs) {
            $jsonLd[] = StructuredData::breadcrumbs([
                ['name' => 'Почетна', 'url' => route('home')],
                ['name' => $page->title, 'url' => url()->current()],
            ]);
        }

        return $response->withViewData([
            'metaDescription' => $page->meta_description,
            'jsonLd' => array_merge($jsonLd, $extraSchemas),
        ]);
    }
}
