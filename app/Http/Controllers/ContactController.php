<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: a hidden "website" field that humans never see. If it's filled,
        // it's a bot — pretend everything is fine but store nothing.
        if (filled($request->input('website'))) {
            return back()->with('success', 'Ви благодариме! Вашата порака е испратена — ќе ве контактираме наскоро.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:60'],
            'email' => ['nullable', 'email', 'max:255'],
            'event_type' => ['required', 'string', 'max:120'],
            'event_date' => ['nullable', 'date'],
            'guests' => ['nullable', 'integer', 'min:1', 'max:100000'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        ContactSubmission::create($data);

        return back()->with('success', 'Ви благодариме! Вашата порака е испратена — ќе ве контактираме наскоро.');
    }
}
