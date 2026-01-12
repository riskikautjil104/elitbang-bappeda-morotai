<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        $opds = Opd::orderBy('nama_opd')->get();
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'opds', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $role = $validated['role'];
        unset($validated['role']); 

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->assignRole($role);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $role = $validated['role'];
        unset($validated['role']); // Remove role from validated data

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->syncRoles([$role]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
