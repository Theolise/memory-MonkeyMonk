<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required'
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->save();

        return response($user->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function getUsers()
    {
        return response(User::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function getUserByName()
    {
    }
}