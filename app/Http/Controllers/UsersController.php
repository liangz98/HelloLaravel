<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;


class UsersController extends Controller
{
    public function __construct()
    {
        // 仅登录用户允许访问的跳转
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy']
        ]);

        // 仅客人允许访问的跳转
        $this->middleware('guest', [
            'only' => ['login', 'addUser']
        ]);
    }

    /*
     * 登录
     */
    public function login()
    {
        return view('users.login');
    }

    /*
     * 查看用户信息
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $user = new User;
        // $user -> name = 'liangz98';
        // $user -> email = 'liangz98@qq.com';
        return view('users.userView', compact('user'));
    }

    /*
     * 注册
     */
    public function addUser()
    {
        return view('users.addUser');
    }

    /*
     * 保存注册
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('user.show', [$user]);
    }

    /*
     * 编辑
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /*
     * 保存编辑
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:3'
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('user.show', $id);
    }

    /*
     * 用户列表
     * 查询时加上 paginate 可实现分布功能
     * 页面配合上 {!! $users->render() !!} 来使用
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /*
     * 删除用户
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);
        $user->delete();

        session()->flash('success', '成功删除用户！');
        return redirect()->back();
    }

    public function confirmEmail()
    {

        return;
    }
}
