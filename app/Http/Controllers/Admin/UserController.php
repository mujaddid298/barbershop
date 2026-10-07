<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users        = User::orderBy('name')->get();
        $admins       = $users->where('role', 'admin');
        $regularUsers = $users->where('role', 'user');

        return view('pages.admin.pelanggan.pelanggan', compact('users', 'admins', 'regularUsers'));
    }

    public function create()
    {
        return view('pages.admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'nohp'                  => ['nullable', 'string', 'max:20'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'role'                  => ['required', Rule::in(['admin', 'user'])],
            'status'                => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.datauser')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('pages.admin.pelanggan.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nohp'                  => ['nullable', 'string', 'max:20'],
            'password'              => ['nullable', 'string', 'min:8', 'confirmed'],
            'role'                  => ['required', Rule::in(['admin', 'user'])],
            'status'                => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.datauser')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.datauser')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}