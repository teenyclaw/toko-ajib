<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('settings.users', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role'     => 'required|in:admin,kasir',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => $validated['role'],
        ]);

        return back()->with('success', 'Akun ' . $validated['name'] . ' berhasil dibuat.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role'  => 'required|in:admin,kasir',
        ]);

        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()
                ->withInput($request->only(['name', 'email', 'role']))
                ->with('_panel', 'edit')
                ->with('_user_id', $user->id)
                ->with('error', 'Anda tidak bisa menurunkan role akun yang sedang login.');
        }

        if ($user->role === 'admin' && $validated['role'] === 'kasir') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()
                    ->withInput($request->only(['name', 'email', 'role']))
                    ->with('_panel', 'edit')
                    ->with('_user_id', $user->id)
                    ->with('error', 'Minimal harus ada satu admin.');
            }
        }

        $user->update($validated);

        return back()->with('success', 'Data ' . $user->name . ' diperbarui.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->update(['password' => $validated['password']]);

        return back()->with('success', 'Password ' . $user->name . ' berhasil diubah.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()->with('error', 'Tidak bisa menghapus admin terakhir.');
            }
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', 'Akun ' . $name . ' dihapus.');
    }
}
