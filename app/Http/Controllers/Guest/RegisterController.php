<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request, CreateNewUser $createNewUser)
    {
        $input = $request->all(); // Ambil data input dari request

        // Panggil method create dengan data input
        $user = $createNewUser->create($input);

        // Simpan user ke dalam database
        $user->password = Hash::make($user->password); // Hash password
        $user->save();

        // Lakukan tindakan lain, misalnya, alihkan pengguna ke halaman tertentu

        // Contoh alihkan pengguna ke halaman beranda
        return redirect('/login');
    }
}
