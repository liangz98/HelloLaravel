<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * times 和 make 方法是由 FactoryBuilder 类 提供的 API。
     * times 接受一个参数用于指定要创建的模型数量，
     * make 方法调用后将为模型创建一个 集合。
     *
     * insert 方法来将生成假用户列表数据批量插入到数据库中。
     * 最后对第一位用户的信息进行了更新，方便后面我们使用此账号登录。
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'LiangZ';
        $user->email = 'liangz98@qq.com';
        $user->password = bcrypt('123');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
