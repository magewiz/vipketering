<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response { return Inertia::render('Home'); }
    public function about(): Response { return Inertia::render('About'); }
    public function menia(): Response { return Inertia::render('Menia'); }
    public function oprema(): Response { return Inertia::render('Oprema'); }
    public function contact(): Response { return Inertia::render('Contact'); }
}
