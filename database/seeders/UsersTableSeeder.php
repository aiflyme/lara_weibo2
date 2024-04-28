<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();

        $user = User::find(1);
        $user->name = 'Ivy';
        $user->email = 'ivy@qq.com';
        $user->password = bcrypt('11111111');
        $user->save();

    }
}
