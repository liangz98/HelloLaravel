<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

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

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.userView', compact('user'));
    }

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
}
