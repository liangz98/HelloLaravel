<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function addUser()
    {
        return view('users.addUser');
    }

    public function login()
    {
        return view('users.login');
    }
}
