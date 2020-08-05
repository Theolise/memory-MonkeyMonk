<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required'
        ]);

        $userExist = User::where('username', $request->input('username'))->first();

        if ($userExist) {
            return response($userExist->jsonSerialize(), Response::HTTP_OK);
        } else {
            $user = new User();
            $user->username = $request->input('username');
            $user->save();

            return response($user->jsonSerialize(), Response::HTTP_CREATED);
        }
    }

    public function getUsers()
    {
        return response(User::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function getUserByName()
    {
    }

    public function updateScore(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $user->score = $request->input('score');
        $user->save();

        return response($user->jsonSerialize(), Response::HTTP_OK);
    }
}