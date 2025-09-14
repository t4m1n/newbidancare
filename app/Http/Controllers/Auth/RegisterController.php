<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman form registrasi.
     */
    public function showRegistrationForm()
    {
        $roles = Role::whereIn('id', [5, 6])->get();
        return view('auth.register', compact('roles'));
    }

    /**
     * Menangani proses registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required',
            'role.*' => 'exists:roles,id',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Berikan role
        $user->roles()->sync($request->role);

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman yang diinginkan
        return redirect()->route('dashboard');
    }
}
