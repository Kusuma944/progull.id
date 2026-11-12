<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Daftar pengguna, dengan pencarian nama atau email.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Blokir atau aktifkan kembali akun customer.
     */
    public function toggle(Request $request, int $user)
    {
        $target = User::findOrFail($user);

        if ($target->id === $request->user()->id) {
            return back()->withErrors(['user' => 'Kamu tidak bisa memblokir akunmu sendiri.']);
        }

        if ($target->isAdmin()) {
            return back()->withErrors(['user' => 'Akun admin tidak dapat diblokir.']);
        }

        $target->update(['is_active' => ! $target->is_active]);

        return back()->with('success', $target->is_active
            ? "Akun {$target->name} diaktifkan kembali."
            : "Akun {$target->name} diblokir.");
    }
}
