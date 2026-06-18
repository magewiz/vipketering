<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Store an uploaded image on the public disk and return its URL path.
     * Used by the admin ImageField for every replaceable image on the site.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:8192'],
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return response()->json([
            'src' => '/storage/'.$path,
        ]);
    }
}
