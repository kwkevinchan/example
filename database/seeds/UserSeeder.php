<?php

use Illuminate\Database\Seeder;
use App\Entites\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kevin1',
            'email' => 'kwkevin.chan@gmail.com',
            'gender' => '男',
            'birthday' => '20190726',
            'comment' => 'comment1',
        ]);
        User::create([
            'name' => 'Kevin2',
            'email' => 'kwkevin.chan@gmail.com',
            'gender' => '女',
            'birthday' => '2019-07-27',
            'comment' => 'comment2',
        ]);
        User::create([
            'name' => 'Kevin3',
            'email' => 'kwkevin.chan@gmail.com',
            'gender' => '男',
            'birthday' => '20190728',
            'comment' => 'comment3',
        ]);

    }
}
