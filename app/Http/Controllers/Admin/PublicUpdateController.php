<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicUpdate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicUpdateController extends Controller
{
    public function index(): View
    {
        $updates = PublicUpdate::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.updates.index', compact('updates'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ta' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content_en' => 'required|string',
            'content_ta' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        PublicUpdate::create([
            'title_en' => $request->title_en,
            'title_ta' => $request->title_ta,
            'category' => $request->category,
            'content_en' => $request->content_en,
            'content_ta' => $request->content_ta,
            'published_at' => $request->published_at ?? now(),
            'is_active' => true,
        ]);

        return redirect()->route('admin.updates.index')->with('success', 'Public news/update published successfully.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $update = PublicUpdate::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ta' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content_en' => 'required|string',
            'content_ta' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $update->update([
            'title_en' => $request->title_en,
            'title_ta' => $request->title_ta,
            'category' => $request->category,
            'content_en' => $request->content_en,
            'content_ta' => $request->content_ta,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.updates.index')->with('success', 'Public update modified successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $update = PublicUpdate::findOrFail($id);
        $update->delete();

        return redirect()->route('admin.updates.index')->with('success', 'News update deleted.');
    }
}
