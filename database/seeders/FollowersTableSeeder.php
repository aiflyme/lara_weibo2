<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //去掉ID为1的用户组
        $followers = $users->slice(1);
        $followers_ids = $followers->pluck('id')->toArray();

        //关注这些用户
        $user->follow($followers_ids);

        //所有用户关注1
        foreach ($followers as $follower){
            $follower->follow(1);
        }

    }
}
