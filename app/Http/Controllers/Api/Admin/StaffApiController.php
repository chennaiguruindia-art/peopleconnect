<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffApiController extends Controller
{
    /**
     * List all staff officers and administrators.
     */
    public function index(): JsonResponse
    {
        $staff = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['staff', 'admin', 'super_admin', 'nodal_officer']);
            })
            ->withCount('assignedComplaints')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $staff,
        ]);
    }

    /**
     * Create a new staff officer.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10|unique:users,mobile',
            'password' => 'required|string|min:6',
            'designation' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'role_name' => 'nullable|in:staff,admin,nodal_officer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $roleName = $request->role_name ?? 'staff';
        $role = Role::where('name', $roleName)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower(trim($request->email)),
            'mobile' => trim($request->mobile),
            'password' => Hash::make($request->password),
            'role_id' => $role?->id,
            'designation' => $request->designation,
            'department' => $request->department,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Staff officer registered successfully.',
            'data' => $user->load('role'),
        ], 201);
    }

    /**
     * Update an existing staff officer.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Staff member not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'email' => "sometimes|required|email|unique:users,email,{$id}",
            'mobile' => "sometimes|required|digits:10|unique:users,mobile,{$id}",
            'password' => 'nullable|string|min:6',
            'designation' => 'sometimes|required|string|max:100',
            'department' => 'sometimes|required|string|max:100',
            'role_name' => 'nullable|in:staff,admin,nodal_officer',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $updateData = $request->only(['name', 'email', 'mobile', 'designation', 'department', 'is_active']);

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->filled('role_name')) {
            $role = Role::where('name', $request->role_name)->first();
            if ($role) {
                $updateData['role_id'] = $role->id;
            }
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Staff member details updated successfully.',
            'data' => $user->fresh('role'),
        ]);
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Staff member not found.',
            ], 404);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Staff status updated to ' . ($user->is_active ? 'Active' : 'Deactivated'),
            'data' => $user,
        ]);
    }
}
