<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(): View
    {
        $staff = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['admin', 'super_admin', 'staff', 'nodal_officer']);
            })
            ->withCount('assignedComplaints')
            ->get();

        $roles = Role::whereIn('name', ['admin', 'staff'])->get();

        return view('admin.staff.index', compact('staff', 'roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|regex:/^[6-9]\d{9}$/',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'department' => 'required|string|max:150',
            'designation' => 'required|string|max:150',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'department' => $request->department,
            'designation' => $request->designation,
            'is_active' => true,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member registered successfully.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|regex:/^[6-9]\d{9}$/',
            'role_id' => 'required|exists:roles,id',
            'department' => 'required|string|max:150',
            'designation' => 'required|string|max:150',
            'password' => 'nullable|string|min:6',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role_id' => $request->role_id,
            'department' => $request->department,
            'designation' => $request->designation,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member details updated.');
    }
}
