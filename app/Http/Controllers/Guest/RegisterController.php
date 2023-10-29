<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use App\Models\DataUser;

class RegisterController extends Controller
{
    public function register(Request $request, CreateNewUser $createNewUser)
    {
        $input = $request->all();
        $user = $createNewUser->create($input);
    
        $user->save();
    
        $userId = $user->getKey();
    
        $dataUser = new DataUser();
        $dataUser->user_id = $userId;
        $dataUser->save();
    
        return redirect('/login');
    }    
}
