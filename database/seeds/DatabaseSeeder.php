<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // 调用 call 方法来指定要运行假数据填充的文件。
         $this->call('UsersTableSeeder');

        Model::reguard();
    }
}
