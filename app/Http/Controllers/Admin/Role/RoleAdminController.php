<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAdminController extends Controller
{
    /**
     * Display a listing of roles
     */
    public function index()
    {
        $roles = Role::with(['permissions', 'users'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $permissions = Permission::all();
        
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for editing role (AJAX for modal)
     */
    public function edit(Role $role)
    {
        // Pastikan selalu return JSON untuk AJAX request
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return response()->json([
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                'guard_name' => $role->guard_name
            ],
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        try {
            $role = Role::create(['name' => $validated['name']]);
            
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->get();
                $role->syncPermissions($permissions);
            }

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil ditambahkan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        try {
            $role->update(['name' => $validated['name']]);
            
            if (isset($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->get();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil diupdate!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        try {
            // Cek apakah role sedang digunakan
            $usersCount = $role->users()->count();
            
            if ($usersCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => "Role tidak dapat dihapus karena masih digunakan oleh {$usersCount} user!"
                ], 422);
            }

            // Hapus role
            $roleName = $role->name;
            $role->delete();

            return response()->json([
                'success' => true,
                'message' => "Role '{$roleName}' berhasil dihapus!"
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error deleting role: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus role: ' . $e->getMessage()
            ], 500);
        }
    }
}