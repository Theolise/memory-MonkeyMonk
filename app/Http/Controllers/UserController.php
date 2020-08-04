<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function createUser()
    {
        $user = new User();
        $crud->save();

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