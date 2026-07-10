<?php

namespace App\Http\Controllers;

use App\Models\EquipmentItem;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $pages = Page::whereIn('slug', ['home', 'about', 'menia', 'oprema', 'contact'])
            ->get()->keyBy('slug');

        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => $this->lastmod(
                    $pages->get('home')?->updated_at,
                    GalleryImage::where('collection', 'home-food')->max('updated_at'),
                ),
            ],
            [
                'loc' => route('about'),
                'lastmod' => $this->lastmod($pages->get('about')?->updated_at),
            ],
            [
                'loc' => route('menia'),
                'lastmod' => $this->lastmod(
                    $pages->get('menia')?->updated_at,
                    Menu::max('updated_at'),
                    GalleryImage::where('collection', 'menia')->max('updated_at'),
                ),
            ],
            [
                'loc' => route('oprema'),
                'lastmod' => $this->lastmod(
                    $pages->get('oprema')?->updated_at,
                    EquipmentItem::max('updated_at'),
                    GalleryImage::where('collection', 'oprema')->max('updated_at'),
                ),
            ],
            [
                'loc' => route('contact'),
                'lastmod' => $this->lastmod($pages->get('contact')?->updated_at),
            ],
        ];

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function lastmod(mixed ...$timestamps): ?string
    {
        $max = collect($timestamps)
            ->filter()
            ->map(fn ($ts) => Carbon::parse($ts))
            ->max();

        return $max?->toAtomString();
    }
}
