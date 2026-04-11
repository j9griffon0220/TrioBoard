<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Thread;
use App\Models\Post;

class RealMemberSeeder extends Seeder
{
    /**
     * リアル用メンバーデータ
     */
    public function run() : void
    {
        $members = config('member.members');

        foreach($members as $member){
            User::updateOrCreate(
                ['email' => $member['email']],
                [
                    'name' => $member['name'],
                    'password' => Hash::make($member['password']),
                    'role' => Role::Member->value,
                    'is_active' => true,
                ]
            );
        }
    }
}

