<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ImageOptimizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Store an uploaded image on the public disk and return its URL path.
     * Used by the admin ImageField for every replaceable image on the site.
     * Uploads are automatically downscaled/recompressed and get a WebP sibling.
     */
    public function store(Request $request, ImageOptimizer $optimizer): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:8192'],
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        $optimizer->optimize(Storage::disk('public')->path($path));

        return response()->json([
            'src' => '/storage/'.$path,
        ]);
    }
}
