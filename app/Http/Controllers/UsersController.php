<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;
use Mail;


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
            'name' => 'required|max:50',    // required 来验证是否为空
            // email 邮箱格式的验证
            // unique 唯一性验证，这里是针对于数据表 users 做验证。
            // min 和 max 来限制所填写的最小长度和最大长度
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:4'    // confirmed 密码匹配验证
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 注册成功后直接登录并中转个人页面
        /*Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('user.show', [$user]);*/

        // 注册成功后发送Email进行确认并回到首页
        $this->sendConfirmEmailTo($user);
        session()->flash('success', '验证邮件已发送到您的注册邮箱，请注意查收！');
        return redirect('/');
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

    /*
     * 发送Email
     */
    protected function sendConfirmEmailTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'liangz98@qq.com';
        $name = 'LiangZ';
        $to = $user->email;
        $subject = "感谢注册 SEA LAND！请确认您的邮箱！";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
           $message->from($from, $name)->to($to)->subject($subject);
        });
    }
    
    /*
     * 处理Email确认
     */
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail(); // firstOrFail 方法用来取出第一个用户,
                                                                        // 查询不到指定用户时将返回一个 404 响应

        $user -> activated = true;
        $user -> activation_token = null;
        $user -> save();

        Auth::login($user);
        session()->flash('success', '恭喜您，激活成功！');
        return redirect()->route('user.show', [$user]);
    }
}
