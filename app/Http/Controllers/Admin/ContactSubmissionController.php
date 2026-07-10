<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactSubmissionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Contacts/Index', [
            'submissions' => ContactSubmission::orderByDesc('created_at')->get(),
            'unreadCount' => ContactSubmission::where('is_read', false)->count(),
        ]);
    }

    public function update(Request $request, ContactSubmission $contact): RedirectResponse
    {
        $data = $request->validate([
            'is_read' => ['required', 'boolean'],
        ]);

        $contact->update($data);

        return back()->with('success', 'Пораката е ажурирана.');
    }

    public function destroy(ContactSubmission $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Пораката е избришана.');
    }
}
