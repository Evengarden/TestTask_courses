<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Pete',
            'last_name' => ' Houston',
            'email' => 'petehouston@mail.ru',
            'password' => '123secret',
            'is_admin' => false,
        ]);
        User::create([
            'first_name' => 'Taylor',
            'last_name' => ' Otwell',
            'email' => 'taylorotwell@mail.ru',
            'password' => 'greatsecret',
            'is_admin' => true,
        ]);
    }
}
