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
        // $user = User::findOrFail($id);
        $user = new User;
        $user -> name = 'liangz98';
        $user -> email = 'liangz98@qq.com';
        return view('users.userView', compact('user'));
    }

    /*
        Save
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.userView', [$user]);
    }
}
