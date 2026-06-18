<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EquipmentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Equipment/Index', [
            'items' => EquipmentItem::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['sort_order'] = (int) (EquipmentItem::max('sort_order') + 1);
        EquipmentItem::create($data);

        return back()->with('success', 'Ставката е додадена.');
    }

    public function update(Request $request, EquipmentItem $equipment): RedirectResponse
    {
        $equipment->update($this->validateData($request));

        return back()->with('success', 'Ставката е зачувана.');
    }

    public function destroy(EquipmentItem $equipment): RedirectResponse
    {
        $equipment->delete();

        return back()->with('success', 'Ставката е избришана.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate(['ids' => ['required', 'array']]);
        foreach ($request->input('ids') as $order => $id) {
            EquipmentItem::where('id', $id)->update(['sort_order' => $order]);
        }

        return back();
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:500'],
            'price' => ['nullable', 'string', 'max:50'],
            'is_published' => ['boolean'],
        ]);
    }
}
