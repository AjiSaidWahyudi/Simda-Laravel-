<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserControlController extends Controller
{
    public function settings() {
        $user = auth()->user();
        return view('user_control.settings', [
            'pageTitle' => 'Pengaturan Akun',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Pengaturan Akun'],
            ],
        ], compact('user'));
    }

    public function kelola_akun() {
        $users = User::all();
        return view('user_control.kelola_akun', [
            'pageTitle' => 'Kelola Akun',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Kelola Akun'],
            ],
        ], compact('users'));
    }

    public function kelola_akses() {
        $roles = Role::all();
        return view('user_control.kelola_akses', [
            'pageTitle' => 'Kelola Akses',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => route('home')],
                ['label' => 'Kelola Akses'],
            ],
        ], compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('kelola_akses')->with('success', 'Role berhasil ditambahkan!');
    }
}
