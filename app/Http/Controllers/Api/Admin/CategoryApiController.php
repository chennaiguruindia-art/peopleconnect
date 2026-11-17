<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryApiController extends Controller
{
    /**
     * List all categories (both active and inactive for admin).
     */
    public function index(): JsonResponse
    {
        $categories = ComplaintCategory::withCount('complaints')
            ->orderBy('name_en')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Create a new category.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:100',
            'name_ta' => 'required|string|max:100',
            'department_name_en' => 'required|string|max:150',
            'department_name_ta' => 'nullable|string|max:150',
            'sla_days' => 'required|integer|min:1|max:365',
            'icon' => 'nullable|string|max:50',
            'description_en' => 'nullable|string|max:500',
            'description_ta' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $code = Str::slug($request->name_en);
        if (ComplaintCategory::where('code', $code)->exists()) {
            $code .= '-' . rand(10, 99);
        }

        $category = ComplaintCategory::create([
            'code' => $code,
            'name_en' => $request->name_en,
            'name_ta' => $request->name_ta,
            'department_name_en' => $request->department_name_en,
            'department_name_ta' => $request->department_name_ta ?? $request->department_name_en,
            'sla_days' => $request->sla_days,
            'icon' => $request->icon ?? 'bi-folder',
            'description_en' => $request->description_en,
            'description_ta' => $request->description_ta,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => $category,
        ], 201);
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $category = ComplaintCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name_en' => 'sometimes|required|string|max:100',
            'name_ta' => 'sometimes|required|string|max:100',
            'department_name_en' => 'sometimes|required|string|max:150',
            'department_name_ta' => 'nullable|string|max:150',
            'sla_days' => 'sometimes|required|integer|min:1|max:365',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $category->update($request->only([
            'name_en',
            'name_ta',
            'department_name_en',
            'department_name_ta',
            'sla_days',
            'icon',
            'description_en',
            'description_ta',
            'is_active',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data' => $category,
        ]);
    }

    /**
     * Toggle active state or delete.
     */
    public function destroy(int $id): JsonResponse
    {
        $category = ComplaintCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category status updated to ' . ($category->is_active ? 'Active' : 'Inactive'),
            'data' => $category,
        ]);
    }
}
