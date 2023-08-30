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
        $input = $request->all();
        $user = $createNewUser->create($input);

        $user->save();

        return redirect('/login');
    }
}
