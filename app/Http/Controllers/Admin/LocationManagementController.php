<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\Taluk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocationManagementController extends Controller
{
    public function index(Request $request): View
    {
        $district = District::first();
        $divisions = RevenueDivision::withCount('taluks')->get();
        $taluks = Taluk::with(['revenueDivision', 'revenueVillages'])->withCount('revenueVillages')->get();

        $selectedTalukId = $request->get('taluk_id', $taluks->first()?->id);
        $villages = RevenueVillage::where('taluk_id', $selectedTalukId)->paginate(15);

        return view('admin.locations.index', compact('district', 'divisions', 'taluks', 'villages', 'selectedTalukId'));
    }

    public function create(): View
    {
        $divisions = RevenueDivision::all();
        $taluks = Taluk::all();
        return view('admin.locations.create', compact('divisions', 'taluks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'taluk_id' => 'required|exists:taluks,id',
            'firka' => 'nullable|string|max:100',
            'code' => 'nullable|string|max:50',
            'name_en' => 'required|string|max:150',
            'name_ta' => 'required|string|max:150',
        ]);

        RevenueVillage::create([
            'taluk_id' => $request->taluk_id,
            'firka' => $request->firka,
            'code' => $request->code ?? ('RV-' . strtoupper(substr($request->name_en, 0, 3)) . '-' . rand(10, 99)),
            'name_en' => $request->name_en,
            'name_ta' => $request->name_ta,
            'is_active' => true,
        ]);

        return redirect()->route('admin.locations.index', ['taluk_id' => $request->taluk_id])
            ->with('success', 'Revenue village added successfully.');
    }

    public function edit(int $id): View
    {
        $village = RevenueVillage::findOrFail($id);
        $taluks = Taluk::all();
        return view('admin.locations.edit', compact('village', 'taluks'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $village = RevenueVillage::findOrFail($id);

        $request->validate([
            'taluk_id' => 'required|exists:taluks,id',
            'firka' => 'nullable|string|max:100',
            'code' => 'nullable|string|max:50',
            'name_en' => 'required|string|max:150',
            'name_ta' => 'required|string|max:150',
            'is_active' => 'nullable|boolean',
        ]);

        $village->update([
            'taluk_id' => $request->taluk_id,
            'firka' => $request->firka,
            'code' => $request->code,
            'name_en' => $request->name_en,
            'name_ta' => $request->name_ta,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.locations.index', ['taluk_id' => $village->taluk_id])
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $village = RevenueVillage::findOrFail($id);
        $talukId = $village->taluk_id;
        $village->delete();

        return redirect()->route('admin.locations.index', ['taluk_id' => $talukId])
            ->with('success', 'Location record deleted successfully.');
    }
}
