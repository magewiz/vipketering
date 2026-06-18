<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'pages' => Page::count(),
                'menus' => Menu::count(),
                'equipment' => EquipmentItem::count(),
                'images' => GalleryImage::count(),
            ],
            'pages' => Page::orderBy('id')->get(['slug', 'title']),
        ]);
    }
}
