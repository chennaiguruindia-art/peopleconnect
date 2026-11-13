<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = ComplaintCategory::withCount('complaints')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string|unique:complaint_categories,code',
            'name_en' => 'required|string|max:150',
            'name_ta' => 'required|string|max:150',
            'department_name_en' => 'required|string|max:200',
            'department_name_ta' => 'required|string|max:200',
            'description_en' => 'nullable|string',
            'description_ta' => 'nullable|string',
            'icon' => 'nullable|string',
            'sla_days' => 'required|integer|min:1',
        ]);

        ComplaintCategory::create([
            'code' => $request->code,
            'name_en' => $request->name_en,
            'name_ta' => $request->name_ta,
            'department_name_en' => $request->department_name_en,
            'department_name_ta' => $request->department_name_ta,
            'description_en' => $request->description_en,
            'description_ta' => $request->description_ta,
            'icon' => $request->icon ?? 'bi-exclamation-triangle',
            'sla_days' => $request->sla_days,
            'is_active' => true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Complaint category added successfully.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = ComplaintCategory::findOrFail($id);

        $request->validate([
            'name_en' => 'required|string|max:150',
            'name_ta' => 'required|string|max:150',
            'department_name_en' => 'required|string|max:200',
            'department_name_ta' => 'required|string|max:200',
            'sla_days' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $category->update([
            'name_en' => $request->name_en,
            'name_ta' => $request->name_ta,
            'department_name_en' => $request->department_name_en,
            'department_name_ta' => $request->department_name_ta,
            'description_en' => $request->description_en,
            'description_ta' => $request->description_ta,
            'icon' => $request->icon ?? $category->icon,
            'sla_days' => $request->sla_days,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
}
